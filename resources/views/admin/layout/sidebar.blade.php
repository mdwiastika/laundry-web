<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Outlet {{ $outlet_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @if (Auth::check())

          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
          @else
          <a href="#" class="d-block">Guest</a>
          @endif
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @if (Auth::check())
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ $title == 'Dashboard' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if (in_array(auth()->user()->role, ['admin', 'kasir']))
          <li class="nav-item {{ $active == 'datamaster' ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ $active == 'datamaster' ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            @if (auth()->user()->role == 'admin')
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('user.index') }}" class="nav-link {{ $title == 'Table User' ? 'active' : '' }}">
                    <i class="fas fa-users nav-icon ml-3"></i>
                    <p>Table User</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('outlet.index') }}" class="nav-link {{ $title == 'Table Outlet' ? 'active' : '' }}">
                    <i class="fas fa-store-alt nav-icon ml-3"></i>
                    <p>Table Outlet</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('paket.index') }}" class="nav-link {{ $title == 'Table Paket' ? 'active' : '' }}">
                    <i class="fas fa-boxes nav-icon ml-3"></i>
                    <p>Table Paket</p>
                  </a>
                </li>
              </ul>
            @endif
            @if (in_array(auth()->user()->role, ['admin', 'kasir']))
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('member.index') }}" class="nav-link {{ $title == 'Table Member' ? 'active' : '' }}">
                  <i class="far fa-credit-card nav-icon ml-3"></i>
                  <p>Table Member</p>
                </a>
              </li>
            </ul>
            @endif
          </li>
          @endif
          <li class="nav-item {{ $active == 'Laporan' ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ $active == 'Laporan' ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @if (in_array(auth()->user()->role, ['admin', 'kasir']))
                <li class="nav-item">
                    <a href="{{ route('transaksi.index') }}" class="nav-link {{ $title == 'Table Transaksi' ? 'active' : '' }}">
                        <i class="fas fa-money-bill-alt nav-icon ml-3" style="fill: white"></i>
                      <p>Table Transaksi</p>
                    </a>
                  </li>
                @endif
              <li class="nav-item">
                <a href="{{ route('laporan') }}" class="nav-link {{ $title == 'Laporan Pembelian' ? 'active' : '' }}">
                    <i class="fas fa-folder-open ml-3"></i>
                  <p>Laporan Pembelian</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link btn-dark btn-outline-dark" style="border: none; text-align: left">
                <i class="nav-icon fas fa-sign-out-alt text-white-50"></i>
                <p class="text-white-50">
                  Logout
                </p>
                </button>
              </form>
          </li>
        </ul>
        @endif
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
