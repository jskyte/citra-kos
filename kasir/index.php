<?php
include 'components/config.php';
ob_start();
session_start();
if (!isset($_SESSION['idUser'])) {
  header("location:login.php");
}

$idUser = $_SESSION['idUser'];

$query = mysqli_query($connection, "SELECT * FROM
data_print_kuitansi d JOIN lokasikerjauser l ON (l.lokasiKos = d.Category_Tempat)
JOIN jenispembayaran j ON (d.idPembayaran = j.idPembayaran)
WHERE l.idUser = '$idUser' ORDER BY d.No_Kamar");

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
              <h1 class="m-0 text-dark">Kuitansi Yang Tersedia</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Kuitansi Yang Tersedia</li>
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
                  <form role="form" enctype="multipart/form-data" method="POST" action="confirmkuitansi.php">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="font-size: 3.8vw">
                      <thead>
                        <tr>
                          <th style="width:30px"></th>
                          <th >Nomor Kamar</th>
                          <th >Nama</th>
                          <th>Harga</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($query) > 0) {
                          $nomor = 1 ?>
                          <?php while ($row = mysqli_fetch_array($query)) {
                            $harga = number_format($row["Harga"], 0, ",", ".");
                            $noKam = $row['No_Kamar'];
                            $queryvalid = mysqli_query($connection, "SELECT No_Kamar FROM hstry_data_tagihan WHERE No_Kamar = '$noKam'");
                            $fetchvalid = mysqli_fetch_array($queryvalid);
                          ?>
                            <tr>

                              <td>
                                <?php if(isset($fetchvalid['No_Kamar'])) { ?>
                                  <i class="fas fa-check"></i>
                                <?php } else {?>
                                <input type="checkbox" name="selectedData[]" value="<?php echo $row['No_Kamar'] ?>">
                                <?php }?>                     
                     
                              </td>
                              <td><?php echo $row['No_Kamar'] ?></td>
                              <td><?php echo $row['Nama'] ?></td>
                              <td>Rp. <?php echo $harga ?></td>
                            </tr>
                          <?php $nomor++;
                          }  ?>
                        <?php } ?>
                    </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="display: block">PILIH</button>
                </form>
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