  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="/assets/img/DigiTek.png" alt="Digitek" class="brand-image " style="opacity: .8">
      <span class="brand-text font-weight-light">Perpustakaan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminLTE') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <p class="fw-bold">{{   auth()->user()->name }} </p>
          </a>
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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            @if (auth()->user()->hasRole('super_admin'))
            <a href="/super-admin/sekolah" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Sekolah
              </p>
            </a>
            @endif
          </li>
          @if (auth()->user()->hasRole('super_admin'))
          <li class="nav-item">
            <a href="/super-admin/admin" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Buku
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              @if (auth()->user()->hasRole('super_admin'))
              <a href="/super-admin/buku" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Daftar buku
                </p>
              </a>
              @endif
              @if (auth()->user()->hasRole('admin'))
              <a href="/admin/buku" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Daftar buku
                </p>
              </a>
              @endif
              </li>
              <li class="nav-item">
              @if (auth()->user()->hasRole('super_admin'))
              <a href="/super-admin/jenis-buku" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Daftar Jenis Buku
                </p>
              </a>
              @endif
              @if (auth()->user()->hasRole('admin'))
              <a href="/admin/jenis-buku" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Daftar Jenis Buku
                </p>
              </a>
              @endif
              </li>
              <li class="nav-item">
              @if (auth()->user()->hasRole('super_admin'))
              <a href="/super-admin/tipe-buku" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Daftar tipe buku
                </p>
              </a>
              @endif
              @if (auth()->user()->hasRole('admin'))
              <a href="/admin/tipe-buku" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Daftar tipe buku
                </p>
              </a>
              @endif
              </li>
              <li class="nav-item">
              @if (auth()->user()->hasRole('super_admin'))
              <a href="/super-admin/lokasi-buku" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Daftar lokasi buku
                </p>
              </a>
              @endif
              @if (auth()->user()->hasRole('admin'))
              <a href="/admin/lokasi-buku" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Daftar lokasi buku
                </p>
              </a>
              @endif
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Peminjaman
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                @if (auth()->user()->hasRole('super_admin'))
                <a href="/super-admin/member" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Daftar member
                  </p>
                </a>
                @endif
                @if (auth()->user()->hasRole('admin'))
                <a href="/admin/member" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Daftar member
                  </p>
                </a>
                @endif
              </li>
              <li class="nav-item">
                @if (auth()->user()->hasRole('super_admin'))
                <a href="/super-admin/peminjaman" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Daftar peminjaman
                  </p>
                </a>
                @endif
                @if (auth()->user()->hasRole('admin'))
                <a href="/admin/peminjaman" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Daftar peminjaman
                  </p>
                </a>
                @endif
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>