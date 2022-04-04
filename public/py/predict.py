import argparse
import pandas as pd
import joblib
from sqlalchemy import create_engine, MetaData, Table, Column, Integer, Float

# Read arguments from cli
parser = argparse.ArgumentParser()
parser.add_argument('--database', required=True, type=str, help='The database url')
parser.add_argument('--predictions-table', required=True, type=str, help='The name of the table where to save predictions')
parser.add_argument('--sql-query', required=True, type=str, help='An sql query to read into the dataframe')
parser.add_argument('--model', required=True, type=str, help='The trained model path')
parser.add_argument('--users-col', type=str, default='users_id', help='The name of the column representing the users id')
parser.add_argument('--items-col', type=str, default='items_id', help='The name of the column representing the items id')
parser.add_argument('--rates-col', type=str, default='ratings', help='The name of the column representing the ratings')
parser.add_argument('--min-rate', type=int, default=1, help='Minimun possible rate')
parser.add_argument('--max-rate', type=int, default=5, help='Maximum possible rate')
parser.add_argument('--seed', type=int, help='The seed to use for random operations')
args = vars(parser.parse_args())

# Load the data
'''
rating dataframe will look like this
| user_id | item_id | rating          |
|---------|---------|-----------------|
| 1       | 1       | 5               |
| ...     | ...     | ...             |
| n       | m       | 3               |
'''
# data = pd.read_csv(args['path'])
print('ok1')
print(args['database'])
data = pd.read_sql(args['sql_query'], create_engine(args['database']))
print('ok2')

# initial model
algo = joblib.load(args['model'])

with create_engine(args['database']).connect() as conn:
    metadata = MetaData(conn)
    metadata.reflect(conn)

    table = metadata.tables.get(args['predictions_table'])

    if table is None:
        table = Table(
            args['predictions_table'],
            metadata,
            Column('id', Integer, primary_key=True),
            Column(args["users_col"], Integer),
            Column(args["items_col"], Integer),
            Column(args["rates_col"], Float)
        )

        metadata.create_all(conn)
        
    for i, row in data.iterrows():
        uid = row[args['users_col']]
        iid = row[args['items_col']]
        est = algo.predict(uid=uid, iid=iid).est
        
        del_op = table.delete().where((table.c[args['users_col']] == uid) and (table.c[args['items_col']] == iid))
        ins_op = table.insert().values({'id': i, args['users_col']: uid, args['items_col']: iid, args['rates_col']: est})

        conn.execute(del_op)
        conn.execute(ins_op)