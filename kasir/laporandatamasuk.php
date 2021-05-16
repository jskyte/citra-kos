<?php 
    include 'components/config.php';
    ob_start();
    session_start();
    if (!isset($_SESSION['idUser'])) {
      header("location:login.php");
    }

    $idUser = $_SESSION['idUser'];

    $query = mysqli_query($connection, "SELECT * FROM c_laporanklrmsk c JOIN jenispembayaran j ON (c.idPembayaran = j.idPembayaran) WHERE status = 'MASUK' AND idUser = '$idUser'");

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

</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="wrapper">

  <?php include 'components/navbar.php'?>

  <?php include 'components/sidebar.php'?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Penghuni Masuk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Penghuni Masuk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-header">
                  <a class="btn btn-primary ctm-responsive-btn" href="addpenghunibaru.php">Tambah Penghuni Baru</a> <br>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h4 style="text-align:center">Daftar Orang Masuk</h4>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th style="width: 20px">Nomor Kamar</th>
                    <th style="width: 20px">Nama</th>
                    <th>Harga</th>
                    <th>Pembayaran</th>
                    <th>Tanggal Masuk</th>
                    <th>Category Tempat</th>
                    <th>Keterangan</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(mysqli_num_rows($query) > 0) { ?>
                        <?php while($row = mysqli_fetch_array($query)) {  
                          $Harga = number_format($row['Harga'], 0, ",", ".");
                          ?>
                            <tr>
                                <td><?php echo $row['No_Kamar']?></td>
                                <td><?php echo $row['Nama']?></td>
                                <td>Rp. <?php echo $Harga?></td>
                                <td><?php echo $row['jenisPemb']?></td>
                                <td><?php echo $row['Tgl_Kejadian']?></td>
                                <td><?php echo $row['Category_Tempat']?></td>
                                <td><?php echo $row['keterangan']?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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