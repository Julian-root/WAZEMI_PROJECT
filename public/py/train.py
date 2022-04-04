from surprise import SVD, accuracy
from surprise import Dataset, Reader
from surprise.model_selection.split import train_test_split

import argparse
import pandas as pd
import joblib
from sqlalchemy import create_engine

# Read arguments from cli
parser = argparse.ArgumentParser()
parser.add_argument('database', type=str, help='The database url')
parser.add_argument('--table', required=True, type=str, help='The name of the table to read into dataframe')
parser.add_argument('--users-col', type=str, default='users_id', help='The name of the column representing the users id')
parser.add_argument('--items-col', type=str, default='items_id', help='The name of the column representing the items id')
parser.add_argument('--rates-col', type=str, default='ratings', help='The name of the column representing the ratings')
parser.add_argument('--min-rate', type=int, default=1, help='Minimun possible rate')
parser.add_argument('--max-rate', type=int, default=5, help='Maximum possible rate')
parser.add_argument(
    '--test-size',
    type=float,
    help='The size of the test dataset to use. All the dataset will be used for training if this argument is not supplied'
)
parser.add_argument('--save-path', type=str, help='The path where to save the trained model')
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
data = pd.read_sql_table(args['table'], create_engine(args['database']))

# preprocessing the data
reader = Reader(rating_scale=(args['min_rate'], args['max_rate']))
train = Dataset.load_from_df(data[[args['users_col'], args['items_col'], args['rates_col']]], reader)

if args['test_size'] is not None:
    train, test = train_test_split(train, test_size=args['test_size'], random_state=args['seed'])
else:
    train = train.build_full_trainset()

# initial model
algo = SVD(random_state = args['seed'])
algo.fit(train)

if args['save_path'] is not None:
    joblib.dump(algo, args['save_path'])

if args['test_size'] is not None:
    pred = algo.test(test)
    # evaluate the rmse result of the prediction and ground thuth
    print(f'test rmse: {accuracy.rmse(pred)}')