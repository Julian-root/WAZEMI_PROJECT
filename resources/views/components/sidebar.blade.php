 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="bg-dark">
      <div class="card-body bg-dark box-profile">
        <div class="text-center">
          @if ( Auth::user()->imageUrl != "" || Auth::user()->imageUrl != null )
          <img class="profile-user-img img-fluid img-circle"
          src="{{ asset('storage/'.Auth::user()->imageUrl) }}"
          alt="User profile picture">
          @else
              @if(Auth::user()->sexe === "F")
                      <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/woman.png') }}" alt="User profile picture">
                  @endif    
                  @if(Auth::user()->sexe === "H")
                      <div class="image">
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/man.png') }}" alt="User profile picture">
                      </div>
              @endif
          @endif
        </div>

        <h3 class="profile-username text-center ellipsis">{{ Auth::user()->nom }}  {{ Auth::user()->prenom }}</h3>

        
        <p class="text-muted text-center">{{ Auth::user()->allRoleNames }}</p>

        <ul class="list-group bg-dark mb-3">
          <li class="list-group-item">
            {{-- can client --}}
            @can("client")
            <a href="{{ route('client.editpassword.password') }}" class="d-flex align-items-center">
              <i class="fa fa-user pr-2"></i>
              <b>Mot de passe</b> 
            </a>
            @endcan
            {{-- can conducteur --}}
            @can("conducteur")
            <a href="{{ route('conducteur.editionpassword.password') }}" class="d-flex align-items-center">
              <i class="fa fa-user pr-2"></i>
              <b>Mot de passe</b> 
            </a>
            @endcan
          </li>

          <li class="list-group-item">
            {{-- can client --}}
            <!-- @can("client")
            <a href="{{ route('client.edit.profile') }}" class="d-flex align-items-center">
              <i class="fa fa-user pr-2"></i>
              <b>Mon profile</b> 
            </a>
            @endcan -->
            {{-- can conducteur --}}
            @can("conducteur")
            <a href="{{ route('conducteur.edition.profile') }}" class="d-flex align-items-center">
              <i class="fa fa-user pr-2"></i>
              <b>Mon profile</b> 
            </a>
            @endcan
          </li>
        </ul>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-primary btn-block">
          <b>Déconnexion</b>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>

      </div>
      <!-- /.card-body -->
    </div>
  </aside>