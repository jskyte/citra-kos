<?php
include 'components/config.php';
ob_start();
session_start();
if (!isset($_SESSION['idUser'])) {
  header("location:login.php");
}

$query = mysqli_query($connection, "SELECT * FROM user");
$query2 = mysqli_query($connection, "SELECT * FROM lokasiproperti");

if (isset($_POST['submit'])) {
  $idUser = $_REQUEST["inputIdUser"];
  $lokasiKerja = $_REQUEST["inputLokasiKerja"];

  mysqli_query($connection, "INSERT INTO lokasikerjauser VALUES ('$idUser', '$lokasiKerja')");
  header("location:kerjauser.php");
}

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
              <h1 class="m-0 text-dark">Lokasi Kerja User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Lokasi Kerja User</li>
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
                  <h3 class="card-title">Tambahkan Lokasi Kerja User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST">
                  <div class="card-body">

                    <div class="form-group">
                      <label for="iduser">ID User</label>
                      <select name="inputIdUser" class="form-control" id="iduser">
                        <option value="NULL">Pilih User</option>
                        <?php if (mysqli_num_rows($query) > 0) { ?>
                          <?php while ($row = mysqli_fetch_array($query)) { ?>
                            <option value="<?php echo $row["idUser"] ?>">
                              <?php echo $row["namaUser"]; ?>
                            </option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="lokasikerja">Lokasi Kerja</label>
                      <select name="inputLokasiKerja" class="form-control" id="lokasikerja">
                        <option value="NULL">Pilih Lokasi Kerja</option>
                        <?php if (mysqli_num_rows($query2) > 0) { ?>
                          <?php while ($row = mysqli_fetch_array($query2)) { ?>
                            <option value="<?php echo $row["lokasiKos"] ?>">
                              <?php echo $row["lokasiKos"]; ?>
                            </option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      <a href="kerjauser.php" class="btn btn-warning" style="margin-left: 20px">Cancel</a>
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