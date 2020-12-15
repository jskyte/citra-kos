<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Welcome, <?php echo $_SESSION['namaUser']?></span>
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
               <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <p>
                Pengelolaan Kuitansi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="datakamar.php" class="nav-link">
                  <i class="fas fa-file-invoice-dollar nav-icon"></i>
                  <p>Kuitansi Kamar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporandatamasuk.php" class="nav-link">
                  <i class="fas fa-sign-in-alt nav-icon"></i>
                  <p>Penghuni Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporandatakeluar.php" class="nav-link">
                  <i class="fas fa-sign-out-alt nav-icon"></i>
                  <p>Penghuni Keluar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="historytagihan.php" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Aktivitas Kasir</p>
                </a>
              </li>
            </ul>
          </li>

          
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>