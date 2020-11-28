<?php 
    include 'components/config.php';

    $query = mysqli_query($connection, "SELECT * FROM user");
    $query2 = mysqli_query($connection, "SELECT * FROM lokasiproperti");

    if(isset($_POST['submit'])) {
        $idUserId = $_REQUEST["editIdUserId"];
        $lokasiKosId = $_REQUEST["editLokasiKosId"];

        $idUser = $_REQUEST["editIdUser"];
        $lokasiKos = $_REQUEST["editLokasiKos"];

        mysqli_query($connection, "UPDATE lokasikerjauser SET idUser = '$idUser', lokasiKos = '$lokasiKos' WHERE idUser = '$idUserId' AND lokasiKos = '$lokasiKosId'");
        header("location:kerjauser.php");
    } 
    else if (isset($_GET["iduserhapus"])) {
        $idUser = $_GET["iduserhapus"];
        $lokasiKos = $_GET["lokasikoshapus"];
        mysqli_query($connection, "DELETE FROM lokasikerjauser WHERE idUser = '$idUser' AND lokasiKos = '$lokasiKos'");
        header("location:kerjauser.php");
    }

    $idUser = $_GET["iduser"];
    $lokasiKos = $_GET["lokasikos"];
    $edit = mysqli_query($connection, "SELECT * FROM lokasikerjauser JOIN user ON (user.IdUser = lokasikerjauser.idUser) WHERE lokasikerjauser.idUser = '$idUser' AND lokasikerjauser.lokasiKos = '$lokasiKos'");
    $row_edit = mysqli_fetch_array($edit);

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

  <?php include 'components/navbar.php'?>
  <?php include 'components/sidebar.php'?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Manajemen User</li>
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
                <h3 class="card-title">Ubah Data User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="card-body">

                <div class="form-group">
                  <label for="editiduser">User</label>
                  <select name="editIdUser" class="form-control" id="editiduser">
                    <option value="<?php echo $row_edit['idUser'] ?>"><?php echo $row_edit['namaUser'] ?></option>
                      <?php if (mysqli_num_rows($query) > 0) {?>
                        <?php while($row = mysqli_fetch_array($query)) {?>
                          <option value="<?php echo $row["idUser"]?>">
                            <?php echo $row["namaUser"];?>
                          </option>
                        <?php }?>
                      <?php }?>
                  </select>
                  </div>
                
                  <div class="form-group">
                  <label for="editlokasikerja">Lokasi Kerja User</label>
                  <select name="editLokasiKos" class="form-control" id="editlokasikerja">
                    <option value="<?php echo $row_edit['lokasiKos'] ?>"><?php echo $row_edit['lokasiKos'] ?></option>
                      <?php if (mysqli_num_rows($query2) > 0) {?>
                        <?php while($row = mysqli_fetch_array($query2)) {?>
                          <option value="<?php echo $row["lokasiKos"]?>">
                            <?php echo $row["lokasiKos"];?>
                          </option>
                        <?php }?>
                      <?php }?>
                  </select>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  <input type="hidden" name="editIdUserId" value="<?php echo $row_edit["idUser"]?>">
                  <input type="hidden" name="editLokasiKosId" value="<?php echo $row_edit["lokasiKos"]?>">
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
