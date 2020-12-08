<?php
include 'components/config.php';
ob_start();
session_start();
if (!isset($_SESSION['idUser'])) {
  header("location:login.php");
}

$idUser = $_SESSION['idUser'];

$query = mysqli_query($connection, "SELECT Tgl_Submit, COUNT(No_Kamar) as jumlahTagihan
FROM e_loguser
WHERE status = 'TAGIHAN'
and idUser = '$idUser'
GROUP BY Tgl_Submit
ORDER BY Tgl_Submit DESC");

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

    <?php include 'components/navbar.php' ?>

    <?php include 'components/sidebar.php' ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">History Print Kuitansi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="datakamar.php">Home</a></li>
                <li class="breadcrumb-item active">History Print Kuitansi</li>
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
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="accordion">
                    <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                    <?php if (mysqli_num_rows($query) > 0) {
                      $nomor = 1; ?>
                      <?php while ($row = mysqli_fetch_array($query)) {
                        $phpdate = strtotime($row['Tgl_Submit']);
                        $tglSubmit = $row['Tgl_Submit'];
                        $mysqldate = date('d-m-Y', $phpdate);
                        $mysqlhour =  date('H:i', $phpdate);
                        $byDate = mysqli_query($connection, "SELECT * FROM e_loguser 
                        JOIN jenispembayaran ON (jenispembayaran.idPembayaran = e_loguser.idPembayaran) 
                        WHERE idUser = '$idUser' 
                        AND e_loguser.Tgl_Submit = '$tglSubmit'
                        AND e_loguser.status = 'TAGIHAN'") ?>
                        <div class="card card-primary">
                          <div class="card-header" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $nomor ?>">
                            <h4 class="card-title">
                              <a>
                                Tanggal: <b><?php echo $mysqldate ?></b>
                              </a> <br>
                              <a>
                                Jam: <b><?php echo $mysqlhour ?></b>
                              </a>
                            </h4>
                          </div>
                          <div id="collapse<?php echo $nomor ?>" class="panel-collapse collapse in">
                            <div class="card-body table-responsive p-0">
                              <table class="table table-hover text-nowrap">
                                <thead>
                                  <tr>
                                    <th>No. Kamar</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Fasilitas</th>
                                    <th>Tanggal Kuitansi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php if (mysqli_num_rows($byDate) > 0) { ?>
                                    <?php while ($rowD = mysqli_fetch_array($byDate)) {
                                      $Harga = number_format($rowD['Harga'], 0, ",", "."); ?>
                                      <tr>
                                        <td><?php echo $rowD['No_Kamar'] ?></td>
                                        <td><?php echo $rowD['Nama'] ?></td>
                                        <td><?php echo $Harga ?></td>
                                        <td><?php echo $rowD['jenisPemb'] ?></td>
                                        <td><?php echo $rowD['Tgl_Kejadian'] ?></td>
                                      </tr>
                                    <?php } ?>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      <?php $nomor++;
                      } ?>
                    <?php } ?>
                  </div>
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