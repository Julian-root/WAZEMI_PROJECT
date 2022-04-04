<div class="row pt-5">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Formulaire de changement de Mot de passe</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->



      <form role="form" wire:submit.prevent="updateUser()">
        <div class="card-body">
          <div class="d-flex">
            {{-- <input type="hidden" wire:model="editUser.role" value="client"> --}}
            <div class="form-group flex-grow-1 mr-2">
              <label>New Password</label>
              <input id="password" type="password" wire:model="editPassword.password"
                class="form-control @error('editPassword.password') is-invalid @enderror">
              @error("editPassword.password")
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div> 
          </div>
          {{-- <input id="password" placeholder="Mot de passe" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> --}}
          {{-- <input id="password-confirm" placeholder="Confirmer votre mot de passe" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"> --}}
          
          <div class="d-flex">
            <div class="form-group flex-grow-1 mr-2">
              <label>Confirm Password </label>
              <input id="password-confirm" type="password" class="form-control @error('editPassword.password_confirmation') is-invalid @enderror"
                wire:model="editPassword.password_confirmation">
            </div>
          </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footeR">
          <button type="submit" class="btn btn-primary btn-block">Appliquer </button>

        </div>
      </form>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>

{{-- <div class="row pt-5">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i> Changer votre Mot de passe</h3>
      </div>

      <form role="form" wire:submit.prevent="updateUser()">
        <div class="card-body">
          <div class="d-flex">
            <div class="form-group flex-grow-1 mr-2">
              <label>New Password</label>
              <input id="password" placeholder="Mot de passe" type="password"
                class="form-control @error('editPassword.password') is-invalid @enderror" name="password" required
                autocomplete="new-password"  wire:model="editPassword.password">
              @error('editPassword.password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="d-flex">
            <div class="form-group flex-grow-1 mr-2">
              <label>Confirm Password</label>
              <input id="password-confirm" placeholder="Confirmer votre mot de passe" type="password"
                class="form-control" name="password_confirmation" required autocomplete="new-password" wire:model="editPassword.password_confirmation">

            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer mr-5 ml-5">
          <button type="submit" class="btn btn-primary btn-block">Appliquer</button>

        </div>
      </form>
    </div>
  </div>
  <div class="col-md-3"></div>
</div> --}}