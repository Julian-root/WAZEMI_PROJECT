<div style="padding-right:350px;padding-left:350px;" class="pt-3">
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/user.png') }}"
                    alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">{{ Auth::user()->nom }}  {{ Auth::user()->prenom }}</h3>
            <p class="text-muted text-center">{{ Auth::user()->allRoleNames }}</p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Email</b> <p class="float-right">{{Auth::user()->email }}</p>
                </li>
                <li class="list-group-item">
                    <b>Sexe</b> <p class="float-right">{{Auth::user()->sexe }}</p>
                </li>
                <li class="list-group-item">
                    <b>Telephone</b> <p class="float-right">{{Auth::user()->numeroTelephone }}</p>
                </li>
            </ul>
            {{-- <a href="#" class="btn btn-primary btn-block"><b>Modifier</b></a> --}}
            <button class="btn btn-primary btn-block" wire:click.prevent="goToEditUser('{{Auth::user()->id }}')">Modifier</button>
        </div>

    </div>
</div>