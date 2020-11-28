<?php 
    include 'components/config.php';

    $query = mysqli_query($connection, "SELECT * FROM user");

    if(isset($_POST['submit'])) {
        $idUser = $_REQUEST["editIdUser"];
        $namaUser = $_REQUEST["editNamaUser"];
        $pinUser = $_REQUEST["editPinUser"];
        $roleUser = $_REQUEST["editRoleUser"];

        mysqli_query($connection, "UPDATE user SET namaUser = '$namaUser', pinUser = '$pinUser', roleUser = '$roleUser' WHERE idUser = '$idUser'");
        header("location:user.php");
    } 
    else if (isset($_GET["iduserhapus"])) {
        $idUser = $_GET["iduserhapus"];
        mysqli_query($connection, "DELETE FROM user WHERE idUser = '$idUser'");
        header("location:user.php");
    }

    $idUser = $_GET["iduser"];
    $edit = mysqli_query($connection, "SELECT * FROM user WHERE idUser = '$idUser'");
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
                    <label for="namaUser">Nama User</label>
                    <input type="text" class="form-control" id="namaUser" name="editNamaUser" value="<?php echo $row_edit['namaUser'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="pinUser">PIN User</label>
                    <input type="number" class="form-control" id="pinUser" name="editPinUser" value="<?php echo $row_edit['pinUser'] ?>">
                  </div>
                  <div class="form-group">
                    <div class="form-group">
                        <label>Role User</label>
                        <select class="form-control" name="editRoleUser" value="<?php echo $row_edit['roleUser'] ?>"> 
                          <option value="Owner">Owner</option>
                          <option value="Kasir">Kasir</option>
                        </select>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  <input type="hidden" name="editIdUser" value="<?php echo $row_edit["idUser"]?>">
                  <a href="user.php" class="btn btn-warning" style="margin-left: 20px">Cancel</a>
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
