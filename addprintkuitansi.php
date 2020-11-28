<?php 
    include 'components/config.php';

    $query = mysqli_query($connection, "SELECT * FROM jenispembayaran");
    $query2 = mysqli_query($connection, "SELECT * FROM lokasiproperti");

    if(isset($_POST['submit'])) {
        $noKamar = $_REQUEST["inputNoKamar"];
        $nama = $_REQUEST["inputNama"];
        $jenisPembayaran = $_REQUEST["inputJenisPembayaran"];
        $harga = $_REQUEST["inputHarga"];
        $tglKuitansi = $_REQUEST["inputTglKuitansi"];
        $categoryTempat = $_REQUEST["inputCategoryTempat"];

        mysqli_query($connection, "INSERT INTO data_print_kuitansi VALUES ('$noKamar', '$nama', '$jenisPembayaran', '$harga', '$tglKuitansi', '$categoryTempat', '')");
        header("location:printkuitansi.php");
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

  <?php include 'components/navbar.php'?>
  <?php include 'components/sidebar.php'?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Kuitansi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Kuitansi</li>
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
                <h3 class="card-title">Tambahkan Data Kuitansi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" autocomplete="off">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nokamar">Nomor Kamar</label>
                    <input type="text" class="form-control" id="nokamar" name="inputNoKamar" placeholder="Enter Nomor Kamar">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="inputNama" placeholder="Enter Nama">
                  </div>
                  <div class="form-group">
                    <label for="jenispembayaran">Jenis Pembayaran</label>
                    <select name="inputJenisPembayaran" class="form-control" id="jenispembayaran">
                      <option value="NULL">Pilih Jenis Pembayaran</option>
                      <?php if (mysqli_num_rows($query) > 0) {?>
                      <?php while($row = mysqli_fetch_array($query)) {?>
                        <option value="<?php echo $row["jenisPemb"]?>">
                        <?php echo $row["jenisPemb"];?>
                        </option>
                      <?php }?>
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="inputHarga" placeholder="Enter Harga">
                  </div>
                  <div class="form-group">
                    <label for="tglkuitansi">Tanggal Kuitansi</label>
                    <input type="date" class="form-control" id="tglkuitansi" name="inputTglKuitansi" placeholder="Enter Tanggal Kuitansi">
                  </div>
                  <div class="form-group">
                    <label for="categorytempat">Category Tempat</label>
                    <select name="inputCategoryTempat" class="form-control" id="categorytempat">
                      <option value="NULL">Pilih Tempat</option>
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
