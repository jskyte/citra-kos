<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Citra</b> Kos</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrator</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Pengelolaan Kuitansi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="printkuitansi.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Print Kuitansi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="historykuitansi.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>History Print Kuitansi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="jenispembayaran.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Pembayaran</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Pengelolaan User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manajemen User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="properti.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lokasi Properti</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="kerjauser.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lokasi Kerja User</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>