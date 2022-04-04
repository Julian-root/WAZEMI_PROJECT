{{-- superadmin --}} 
@can("conducteur")    
<li class="nav-item {{ setMenuClass('conducteur.current.', 'menu-open') }}">
      <a href="#" class="nav-link {{ setMenuClass('conducteur.current.', 'active') }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Tableau de bord
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('conducteur.current.view') }}" class="nav-link {{ setMenuActive('conducteur.current.view') }}">
            <i class="nav-icon fas fa-swatchbook"></i>
            <p>Localisation</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('conducteur.planning.commande') }}" class="nav-link {{ setMenuActive('conducteur.planning.commande') }}">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Commandes </p>
          </a>
        </li>
      </ul>
</li> 

    {{-- <li class="nav-header">LOCATION</li>
    <li class="nav-item">
        <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-users"></i>
            <p>
            Gestion des clients
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
            Gestion des locations
            </p>
        </a>
    </li> --}}
@endcan    