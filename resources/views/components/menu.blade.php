<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{ setMenuActive('home') }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Accueil
            </p>
          </a>
        </li>     



    {{-- can client --}}
    @can("client")
    {{-- <li class="nav-item {{ setMenuClass('client.habilitations.', 'menu-open') }}">
      <a href="#" class="nav-link {{ setMenuClass('client.habilitations.', 'active') }}">
        <i class=" nav-icon fas fa-user-shield"></i>
        <p>
          Habilitations
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item ">
          <a
          href="{{ route('client.habilitations.users.index') }}"
          class="nav-link {{ setMenuActive('client.habilitations.users.index') }}"
          >
            <i class=" nav-icon fas fa-users-cog"></i>
            <p>Utilisateurs</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-fingerprint"></i>
            <p>Roles et permissions</p>
          </a>
        </li>
      </ul>
    </li> --}}

    <li class="nav-item {{ setMenuClass('client.commande.', 'menu-open') }}">
      <a href="#" class="nav-link {{ setMenuClass('client.commande.', 'active') }}">
          <i class="nav-icon fas fa-cogs"></i>
          <p>
          Commandes
          <i class="right fas fa-angle-left"></i>
          </p>
      </a>
      <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="{{ route('client.listcommande.commandes') }}"
                  class="nav-link {{ setMenuActive('client.listcommande.commandes') }}">
              <i class="nav-icon far fa-circle"></i>
              <p>Listes</p>
              </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('client.commande.commandes') }}"
            class="nav-link {{ setMenuActive('client.commande.commandes') }}">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>Réserver</p>
              </a>
          </li>
      </ul>
    </li>
    @endcan

    @include("components.conducteurmenu")   
  </ul>
</nav>
<!-- /.sidebar-menu -->