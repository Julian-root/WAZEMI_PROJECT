<div wire:ignore.self>

    
<div class="row p-4 pt-5">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Listes des commandes</h3>

        <div class="card-tools d-flex align-items-center">
          
          <div class="input-group input-group-md" style="width: 250px;">
            <select  id="filtreStatut" wire:model="filtreStatut" class="form-control">
                <option value=""></option>
                <option value="enCours">En Cours</option>
                <option value="Valide">Valide</option>
                <option value="Termine">Terminé</option>
            </select>

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
              <th style="width: 15%;" class="text-center">Client</th>
              <th style="width: 10%;" class="text-center">Distance</th>
              <th style="width: 20%;" class="text-center">Prix</th>
              <th style="width: 20%;" class="text-center">Date Depart</th>
              <th style="width: 15%;" class="text-center">Status</th>
              <th style="width: 15%;" class="text-center">Note</th>
              <th style="width: 20%;" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($commandes as $commande)  
              @if ( ((new DateTimeImmutable($commande->dateDepart, timezone: new DateTimeZone('Africa/Porto-Novo')) > $currentTime) && ( ($commande->status == "Valide") || ($commande->status == "enCours")))  ||  ((new DateTimeImmutable($commande->dateDepart, timezone: new DateTimeZone('Africa/Porto-Novo')) < $currentTime) && ( ($commande->status == "Valide") || ($commande->status == "Termine"))) )
                  <tr>
                    <td style="width: 15%;" class="text-center"> {{$commande->client }} </td>
                    <td style="width: 10%;" class="text-center"> {{$commande->distance }} </td>
                    <td style="width: 20%;" class="text-center"> {{$commande->prix }}</td>
                    <td style="width: 20%;" class="text-center"> {{$commande->dateDepart }} </td>
                    <td style="width: 15%;" class="text-center"> 
                        @if($commande->status === "enCours")
                        <span class="badge badge-primary">{{$commande->status }}...</span>
                        @endif
                        @if($commande->status === "Valide")
                        <span class="badge badge-success">{{$commande->status }} </span>
                        @endif
                        @if($commande->status === "Termine")
                        <span class="badge badge-info">{{$commande->status }}</span>
                        @endif
                    </td>
                    <td style="width: 15%;" class="text-center"> {{$commande->note }}/5</td>
                    <td style="width: 20%;" class="text-center"> 
                    
                      <!-- @if( ($commande->status === "enCours") && ((new DateTimeImmutable($commande->dateDepart, timezone: new DateTimeZone('Africa/Porto-Novo')) > $currentTime)) )
                        <button class="btn btn-link" wire:click.prevent="acceptCommande('{{$commande->id }}')"><i
                          class="far fa-edit"></i>Accepter</button>
                      @endif

                      @if ( new DateTimeImmutable($commande->dateDepart, timezone: new DateTimeZone('Africa/Porto-Novo')) < $currentTime )
                        @if( ( $commande->driver_course_end == 0) && ($commande->status == "Valide") )
                        <button class="btn btn-link" wire:click.prevent="endCommand('{{ $commande->id }}')"><i
                          class="far fa-trash-alt"></i>Terminé </button>
                        @endif
                      @endif -->

                      <button class="btn btn-link" wire:click.prevent="roadCommand('{{ $commande->id }}')"><i
                              class="far fa-trash-alt"></i>See Road</button>

                    </td>
                  </tr>
              @endif     
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









     
</div>
@include("livewire.planning.alert")