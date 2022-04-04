<div class="row pt-5">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire d'edition utilisateur</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->



      <form role="form" wire:submit.prevent="updateUser()">
        <div class="card-body">
          <div class="d-flex">
            {{-- <input type="hidden" wire:model="editUser.role" value="client"> --}}
            <div class="form-group flex-grow-1 mr-2">
              <label>Nom</label>
              <input type="text" wire:model="editUser.nom"
                class="form-control @error('editUser.nom') is-invalid @enderror">

              @error("editUser.nom")
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group flex-grow-1">
              <label>Prenom</label>
              <input type="text" wire:model="editUser.prenom"
                class="form-control @error('editUser.prenom') is-invalid @enderror">

              @error("editUser.prenom")
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="d-flex">
            <div class="form-group flex-grow-1 mr-2">
              <label>Telephone </label>
              <input type="text" class="form-control @error('editUser.numeroTelephone') is-invalid @enderror"
                wire:model="editUser.numeroTelephone">
              @error("editUser.numeroTelephone")
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group flex-grow-1 ">
              <label>Adresse e-mail</label>
              <input type="text" class="form-control @error('editUser.email') is-invalid @enderror"
                wire:model="editUser.email">
              @error("editUser.email")
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group">

            <label>Sexe</label>
            <select class="form-control @error('editUser.sexe') is-invalid @enderror" wire:model="editUser.sexe">
              <option value="">---------</option>
              <option value="H">Homme</option>
              <option value="F">Femme</option>
            </select>
            @error("editUser.sexe")
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer mr-5 ml-5">
          <button type="submit" class="btn btn-primary btn-block">Appliquer les modifications</button>

        </div>
      </form>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>