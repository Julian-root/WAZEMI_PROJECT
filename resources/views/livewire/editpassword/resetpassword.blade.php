{{-- style="padding-right:350px;padding-left:350px;" --}}
<div class="pt-3">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-key fa-2x"></i> Rénitialisation de mot de passe</h3>
    </div>
    <div class="card-body">
      {{-- <ul>
        <li>
          <a href="" class="btn btn-link" wire:click.prevent="confirmPwdReset()">
            Rénitialiser
            <span>(par défaut: "password ")</span>
          </a>
        </li>
      </ul> --}}
      <div id="accordion">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title flex-grow-1">
                <a  data-parent="#accordion" href="#" wire:click.prevent="confirmPwdReset()"  aria-expanded="true">
                  Rénitialiser
            <span>(mot de passe par défaut: "password ")</span>
                </a>
                </h4>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

