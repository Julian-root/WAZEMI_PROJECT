
<div class="row p-4 pt-5">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Listes des commandes</h3>

        <div class="card-tools d-flex align-items-center">
          <a class="btn btn-link text-white mr-4 d-block" href="{{ route('client.commande.commandes') }}"><i class="fas fa-user-plus"></i>Nouvel commande</a>
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
            @forelse ($commandes as $commande)    
              <tr>
                <td style="width: 15%;" class="text-center"> {{$commande->conducteur }} </td>
                <td style="width: 20%;" class="text-center"> {{$commande->transport }} </td>
                <td style="width: 20%;" class="text-center"> {{$commande->plaque }}  </td>
                <td style="width: 10%;" class="text-center"> {{$commande->distance }}</td>
                <td style="width: 20%;" class="text-center"> {{$commande->prix }}</td>
                <td style="width: 15%;" class="text-center">
                  @if($commande->status === "enAttente")
                   <span class="badge badge-secondary">{{$commande->status }}...</span>
                  @endif
                  @if($commande->status === "enCours")
                   <span class="badge badge-primary">{{$commande->status }}...</span>
                  @endif
                  @if($commande->status === "Valide")
                   <span class="badge badge-success">{{$commande->status }}</span>
                  @endif
                  @if($commande->status === "Termine")
                   <span class="badge badge-info">{{$commande->status }}</span>
                  @endif
                  </td>
                <td style="width: 20%;" class="text-center"> 

                  @if( ($commande->status === "enAttente") && ((new DateTimeImmutable($commande->dateDepart, timezone: new DateTimeZone('Africa/Porto-Novo')) > $currentTime)) )
                  <button class="btn btn-link" wire:click.prevent="acceptCommande('{{$commande->id }}')"><i
                    class="far fa-edit"></i>Accepter</button>
                  @endif

                  @if(new DateTimeImmutable($commande->dateDepart, timezone: new DateTimeZone('Africa/Porto-Novo')) > $currentTime)
                  <button class="btn btn-link" wire:click.prevent="confirmDelete('{{ $commande->id }}')"><i
                    class="far fa-trash-alt"></i>Annuler </button>
                  @endif

                  @if( (new DateTimeImmutable($commande->dateDepart, timezone: new DateTimeZone('Africa/Porto-Novo')) < $currentTime) && ( ($commande->status == "enAttente") || ($commande->status == "enCours") ) )
                  <button class="btn btn-link" wire:click.prevent="confirmDelete('{{ $commande->id }}')"><i
                    class="far fa-trash-alt"></i>Annuler </button>
                  @endif   
                    
                  @if ( (new DateTimeImmutable($commande->dateDepart, timezone: new DateTimeZone('Africa/Porto-Novo')) < $currentTime) && ($commande->status == "Termine") )
                    <button class="btn btn-link" wire:click.prevent="ratingCommand('{{ $commande->id }}')"><i
                      class="far fa-trash-alt"></i>Noter</button>
                  @endif 

                  @if ( new DateTimeImmutable($commande->dateDepart, timezone: new DateTimeZone('Africa/Porto-Novo')) < $currentTime )
                    @if( ( $commande->client_course_end == 0) && ($commande->status == "Valide") )
                      <button class="btn btn-link" wire:click.prevent="endCommand('{{ $commande->id }}')"><i
                          class="far fa-trash-alt"></i>Terminé </button>
                    @endif
                  @endif
                </td> 
              </tr>
            @empty
              <tr>
                  <td colspan="12">
                      <div class="alert alert-danger">
                          <h5><i class="icon fas fa-ban"></i> Information!</h5>
                          Aucune donnée trouvée par rapport aux éléments de recherche entrés.
                      </div>
                  </td>
              </tr>  
            @endforelse  
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