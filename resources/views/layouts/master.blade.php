<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="fr">

<x-header />

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <x-topnav />

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home')}} " class="brand-link">
        <img src="{{ asset('img/hero.png') }}" style="width: 35px; height:30px;" class="img-circle" alt="User Image">
        <span class="brand-text font-weight-bold" style="font-size: 1.2em;"><b
            style="font-weight:bold;" >WAZEMI</b></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          @if ( Auth::user()->imageUrl != "" || Auth::user()->imageUrl != null )
          <div class="image">
            <img src="{{ asset('storage/'.Auth::user()->imageUrl) }}" class="img-circle elevation-2" alt="User Image">
          </div>
          @else
              @if(Auth::user()->sexe === "F")
                  <img src="{{ asset('img/woman.png') }}" width="24px" alt="">
              @endif    
              @if(Auth::user()->sexe === "H")
                  <div class="image">
                    <img src="{{ asset('img/man.png') }}" class="img-circle elevation-2" alt="User Image">
                  </div>
              @endif
          @endif
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</a>
          </div>
        </div>



        <x-menu />
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          @yield('content')
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <x-sidebar />
    <x-footer />
    @livewireScripts


</body>

</html>