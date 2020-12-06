<?php
include 'components/config.php';
ob_start();
session_start();
if (!isset($_SESSION['idUser'])) {
    header("location:login.php");
}

$idUser = $_SESSION['idUser'];
$getNoKamar = $_GET['nokamar'];

$query = mysqli_query($connection, "SELECT * 
FROM d_masterkamarcpy d JOIN lokasikerjauser l ON (l.lokasiKos = d.Category_Tempat)
JOIN jenispembayaran p ON (p.idPembayaran = d.idPembayaran)
WHERE No_Kamar = '$getNoKamar'");
$row = mysqli_fetch_array($query);
$harga = number_format($row["Harga"], 0, ",", ".");

if (isset($_POST['submit'])) {
    // $noKamar = $_REQUEST["inputNoKamar"];
    $nama = $row["Nama"];
    $harga = $row["Harga"];
    $idPembayaran = $_REQUEST["inputFasilitas"];
    $tglKejadian = $_REQUEST["inputTanggalKejadian"];
    $categoryTempat = $_REQUEST["inputcategoryTempat"];

    mysqli_query($connection, "UPDATE d_masterkamarcpy SET Nama = '' WHERE No_Kamar = '$getNoKamar'");

    mysqli_query($connection, "INSERT INTO c_laporanklrmsk VALUES('', '$getNoKamar', '$nama', '$harga', '$idPembayaran', '$tglKejadian', '$categoryTempat', NOW(), '$idUser', 'KELUAR', '')");

    mysqli_query($connection, "INSERT INTO e_loguser VALUES('', '$getNoKamar', '$nama', '$harga', '$idPembayaran', '$tglKejadian', '$categoryTempat', NOW(), '$idUser', 'KELUAR', '')");

    header('location:laporandatakeluar.php');
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
                            <h1 class="m-0 text-dark">Penghuni Keluar</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="datakamar.php">Home</a></li>
                                <li class="breadcrumb-item active">Penghuni Keluar</li>
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
                                    <h3 class="card-title">Data Penghuni Keluar</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" method="POST">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="tanggalkejadian">Tanggal Keluar</label>
                                            <input type="date" class="form-control" id="tanggalkejadian" name="inputTanggalKejadian" placeholder="Masukkan Tanggal Keluar">
                                        </div>

                                        <div class="form-group">
                                            <label for="nama">Nama Penghuni</label>
                                            <input type="text" class="form-control" id="nama" name="inputNama" value="<?php echo $row['Nama'] ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="noKamar">No. Kamar</label>
                                            <input type="text" class="form-control" id="noKamar" name="inputNoKamar" value="<?php echo $getNoKamar ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="hidden" class="form-control" id="harga" name="inputHarga" value="<?php echo $row['Harga'] ?>" disabled>
                                            <input type="text" class="form-control" id="harga" name="tampilHarga" value="Rp. <?php echo $harga ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="categoryTempat">Tempat</label>
                                            <input type="hidden" class="form-control" id="categoryTempat" name="inputcategoryTempat" value="<?php echo $row['Category_Tempat'] ?>">
                                            <input type="text" class="form-control" id="categoryTempat" name="tampilcategoryTempat" value="<?php echo $row['Category_Tempat'] ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="fasilitas">Fasilitas</label>
                                            <input type="hidden" class="form-control" id="fasilitas" name="inputFasilitas" value="<?php echo $row['idPembayaran'] ?>">
                                            <input type="text" class="form-control" id="fasilitas" name="tampilFasilitas" value="<?php echo $row['jenisPemb'] ?>" disabled>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" name="submit">Kumpul</button>
                                            <a href="addpenghunikeluar.php" class="btn btn-warning" style="margin-left: 20px">Kembali</a>
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