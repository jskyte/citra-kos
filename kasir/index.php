<?php
include 'components/config.php';
ob_start();
session_start();
if (!isset($_SESSION['idUser'])) {
  header("location:login.php");
}

$idUser = $_SESSION['idUser'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Citra Kos</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" href="assets/css/custom.style.css">
  <style>
    section {
      padding-top: 4rem;
      padding-bottom: 5rem;
      background-color: #f1f4fa;
    }

    .wrap {
      display: flex;
      background: white;
      padding: 1rem 1rem 1rem 1rem;
      border-radius: 0.5rem;
      box-shadow: 7px 7px 30px -5px rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
    }

    a {
      color: #000;
      text-decoration: none;
    }

    a:hover {
      text-decoration: none;
    }

    .wrap:hover {
      background: linear-gradient(135deg, #6394ff 0%, #0a193b 100%);
      color: white;
    }

    .ico-wrap {
      margin: auto;
    }

    .mbr-iconfont {
      font-size: 4.5rem !important;
      color: #313131;
      margin: 1rem;
      padding-right: 1rem;
    }

    .vcenter {
      margin: auto;
    }

    .mbr-section-title3 {
      text-align: left;
    }

    h2 {
      margin-top: 0.5rem;
      margin-bottom: 0.5rem;
    }

    .display-5 {
      font-family: 'Source Sans Pro', sans-serif;
      font-size: 1.4rem;
    }

    .mbr-bold {
      font-weight: 700;
    }

    p {
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
      line-height: 25px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
  <div class="wrapper">

    <?php include 'components/navbar.php' ?>

    <?php include 'components/sidebar.php' ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Selamat Datang, <b> <?php echo $_SESSION['namaUser']?> </b>!</h1>
            </div><!-- /.col -->
          
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row mbr-justify-content-center">

            <div class="col-lg-6 mbr-col-md-10">
              <a href="datakamar.php">
                <div class="wrap">
                  <div class="ico-wrap">
                    <span class="mbr-iconfont fa-file-invoice-dollar fa"></span>
                  </div>
                  <div class="text-wrap vcenter">
                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5"><span> Kuitansi Kamar</span></h2>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
              <a href="laporandatamasuk.php">
                <div class="wrap">
                  <div class="ico-wrap">
                    <span class="mbr-iconfont fa-sign-in-alt fa"></span>
                  </div>
                  <div class="text-wrap vcenter">
                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">
                      <span>Penghuni Masuk</span>
                    </h2>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
              <a href="laporandatakeluar.php">
                <div class="wrap">
                  <div class="ico-wrap">
                    <span class="mbr-iconfont fa-sign-out-alt fa"></span>
                  </div>
                  <div class="text-wrap vcenter">
                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5"> <span>Penghuni Keluar</span></h2>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-6 mbr-col-md-10">
              <a href="historytagihan.php">
                <div class="wrap">
                  <div class="ico-wrap">
                    <span class="mbr-iconfont fa-history fa"></span>
                  </div>
                  <div class="text-wrap vcenter">
                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">
                      <span>Aktivitas Kasir</span>
                    </h2>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="assets/js/datatable.js"></script>

</body>

</html>
<?php
mysqli_close($connection);
ob_end_flush();
?>