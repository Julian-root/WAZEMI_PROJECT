
<div class="row p-4 pt-5">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
          <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Listes des commandes</h3>

          <div class="card-tools d-flex align-items-center">
            <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="goToChoiceCommand()"><i class="fas fa-user-plus"></i>Nouvel commande</a>
            
            <div class="input-group input-group-md" style="width: 250px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th style="width: 15%;" class="text-center">Chauffeur</th>
                <th style="width: 20%;" class="text-center">Transport</th>
                <th style="width: 20%;" class="tex t-center">N° Plaque</th>
                <th style="width: 10%;" class="text-center">Distance</th>
                <th style="width: 20%;" class="text-center">Prix</th>
                <th style="width: 15%;" class="text-center">Status</th>
                <th style="width: 20%;" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($commandes as $commande)    
              <tr>
                <td> {{$commande->conducteur }} </td>
                <td> {{$commande->transport }} </td>
                <td> {{$commande->plaque }} </td>
                <td> {{$commande->distance }} </td>
                <td> {{$commande->prix }} </td>
                <td>
                  @if($commande->status === "enAttente")
                   <span class="badge badge-secondary">{{$commande->status }}...</span>
                  @endif
                  @if($commande->status === "enCours")
                   <span class="badge badge-primary">{{$commande->status }}...</span>
                  @endif
                  @if($commande->status === "Valide")
                   <span class="badge badge-success">{{$commande->status }}</span>
                  @endif
                  </td>
                <td> 
                  @if($commande->status === "enAttente")
                  <button class="btn btn-link" wire:click.prevent="acceptCommande('{{$commande->id }}')"><i
                    class="far fa-edit"></i>Accepter</button>
                  @endif

                  <button class="btn btn-link" wire:click.prevent="confirmDelete('{{ $commande->id }}')"><i
                    class="far fa-trash-alt"></i>Annuler</button>

                    
                </td>
                
              </tr>
            @endforeach  
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="float-right">{{ $commandes->links() }}</div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>

