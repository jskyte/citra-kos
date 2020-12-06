<?php
include 'components/config.php';
ob_start();
session_start();
if (!isset($_SESSION['idUser'])) {
  header("location:login.php");
}

$idUser = $_SESSION['idUser'];
$noKamar = $_GET['nokamar'];

$query = mysqli_query($connection, "SELECT * 
FROM d_masterkamarcpy d JOIN lokasikerjauser l ON (l.lokasiKos = d.Category_Tempat)
WHERE d.Nama = '' AND l.idUser = '$idUser'");

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
              <h1 class="m-0 text-dark">Tambah Penghuni Baru</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="datakamar.php">Home</a></li>
                <li class="breadcrumb-item active">Tambah Penghuni Baru</li>
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
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Nomor Kamar: <b> <?php echo $noKamar?> </b></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST">
                  <div class="card-body">

                    <div class="form-group">
                      <label for="perubahan">Apakah ada perubahan Harga atau Fasilitas?</label>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <!-- <button type="submit" class="btn btn-primary" name="submit">Ada</button> -->
                      <a href="detailpenghunichange.php?nokamar=<?php echo $noKamar ?>" class="btn btn-primary" style="display:block; margin-bottom: 10px">Ada</a>
                      <a href="detailpenghuni.php?nokamar=<?php echo $noKamar ?>" class="btn btn-warning" style="display:block; margin-bottom: 10px">Tidak Ada</a>
                      <a href="addpenghunibaru.php" class="btn btn-danger" style="display:block">Kembali</a>
                    </div>
                </form>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>

<?php
mysqli_close($connection);
ob_end_flush();
?>