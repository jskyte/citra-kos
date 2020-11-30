<?php 
    include 'components/config.php';
    ob_start();
    session_start();
    if (!isset($_SESSION['idUser'])) {
      header("location:login.php");
    }

    
    $query2 = mysqli_query($connection, "SELECT * FROM lokasiproperti");

    if(isset($_POST['submit'])) {
        $noKamar = $_REQUEST["editNoKamar"];
        $nama = $_REQUEST["editNama"];
        $jenisPembayaran = $_REQUEST["editJenisPembayaran"];
        $harga = $_REQUEST["editHarga"];
        $tglKuitansi = $_REQUEST["editTglKuitansi"];
        $categoryTempat = $_REQUEST["editCategoryTempat"];

        mysqli_query($connection, "UPDATE data_print_kuitansi SET Nama = '$nama', Pembayaran = '$jenisPembayaran', Tgl_Kui = '$tglKuitansi', Harga = '$harga', Category_Tempat = '$categoryTempat' WHERE No_Kamar = '$noKamar'");
        header("location:printkuitansi.php");
    } 
    else if (isset($_GET["nokamarhapus"])) {
        $noKamar = $_GET["nokamarhapus"];
        mysqli_query($connection, "DELETE FROM data_print_kuitansi WHERE No_Kamar = '$noKamar'");
        header("location:printkuitansi.php");
    }

    $noKamar = $_GET["nokamar"];
    $edit = mysqli_query($connection, "SELECT * FROM data_print_kuitansi JOIN jenispembayaran ON (jenispembayaran.idPembayaran = data_print_kuitansi.idPembayaran) WHERE No_Kamar = '$noKamar'");
    $row_edit = mysqli_fetch_array($edit);
    $query = mysqli_query($connection, "SELECT * from jenispembayaran WHERE idPembayaran != (SELECT idPembayaran from data_print_kuitansi WHERE No_Kamar = '$noKamar')");
    
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
            <h1 class="m-0 text-dark">Update Data Kuitansi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Update Data Kuitansi</li>
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
                <h3 class="card-title">Ubah Data Kuitansi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="editNama" value="<?php echo $row_edit['Nama'] ?>">
                  </div>
                  <div class="form-group">
                  <label for="editpembayaran">Jenis Pembayaran</label>
                  <select name="editJenisPembayaran" class="form-control" id="editpembayaran">
                    <option value="<?php echo $row_edit['idPembayaran'] ?>"><?php echo $row_edit['jenisPemb'] ?></option>
                      <?php if (mysqli_num_rows($query) > 0) {?>
                        <?php while($row = mysqli_fetch_array($query)) {?>
                          <option value="<?php echo $row["idPembayaran"]?>">
                            <?php echo $row["jenisPemb"];?>
                          </option>
                        <?php }?>
                      <?php }?>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="editHarga" value="<?php echo $row_edit['Harga'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="tglkuitansi">Tanggal Kuitansi</label>
                    <input type="date" class="form-control" id="tglkuitansi" name="editTglKuitansi" value="<?php echo $row_edit['Tgl_Kui'] ?>">
                  </div>
                  <div class="form-group">
                  <label for="editcategorytempat">Category Tempat</label>
                  <select name="editCategoryTempat" class="form-control" id="editcategorytempat">
                    <option value="<?php echo $row_edit['Category_Tempat'] ?>"><?php echo $row_edit['Category_Tempat'] ?></option>
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
                  <input type="hidden" name="editNoKamar" value="<?php echo $row_edit["No_Kamar"]?>">
                  <a href="printkuitansi.php" class="btn btn-warning" style="margin-left: 20px">Cancel</a>
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