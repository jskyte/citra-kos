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

$queryfasilitas = mysqli_query($connection, "SELECT * FROM jenispembayaran");

if (isset($_POST['submit'])) {
    // $noKamar = $_REQUEST["inputNoKamar"];
    $nama = $_REQUEST["inputNama"];
    $harga = $_REQUEST["inputHarga"];
    $formatharga = number_format($harga, 0, ",", ".");
    $hargaBefore = $row["Harga"];
    $formathargaBefore = number_format($hargaBefore, 0, ",", ".");
    $fasilitasBefore = $row["jenisPemb"];
    $idPembayaran = $_REQUEST["inputFasilitas"];
    $tglKejadian = $_REQUEST["inputTanggalKejadian"];
    $categoryTempat = $row["Category_Tempat"];

    $queryFasil = mysqli_query($connection, "SELECT * FROM jenispembayaran WHERE idPembayaran = '$idPembayaran'");
    $fetchFasil = mysqli_fetch_array($queryFasil);
    $jenisFasilitas = $fetchFasil['jenisPemb'];

    mysqli_query($connection, "UPDATE d_masterkamarcpy SET Nama = '$nama', Tgl_Kui = '$tglKejadian', Harga = '$harga', idPembayaran = '$idPembayaran' WHERE No_Kamar = '$getNoKamar'");

    mysqli_query($connection, "INSERT INTO c_laporanklrmsk VALUES('', '$getNoKamar', '$nama', '$harga', '$idPembayaran', '$tglKejadian', '$categoryTempat', NOW(), '$idUser', 'MASUK', 'Perubahan Harga dari Rp. $formathargaBefore menjadi Rp. $formatharga dan Perubahan Fasilitas dari $fasilitasBefore menjadi $jenisFasilitas')");

    mysqli_query($connection, "INSERT INTO e_loguser VALUES('', '$getNoKamar', '$nama', '$harga', '$idPembayaran', '$tglKejadian', '$categoryTempat', NOW(), '$idUser', 'MASUK', 'Perubahan Harga dari Rp. $formathargaBefore menjadi Rp. $formatharga dan Perubahan Fasilitas dari $fasilitasBefore menjadi $jenisFasilitas')");

    header('location:laporandatamasuk.php');
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
                                    <h3 class="card-title">Tambahkan Penghuni Baru</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" method="POST">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="nama">Nama Penghuni</label>
                                            <input type="text" class="form-control" id="nama" name="inputNama" placeholder="Masukkan Nama Penghuni">
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggalkejadian">Tanggal Masuk</label>
                                            <input type="date" class="form-control" id="tanggalkejadian" name="inputTanggalKejadian" placeholder="Masukkan Tanggal Masuk">
                                        </div>

                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="number" class="form-control" id="harga" name="inputHarga"  value="<?php echo $row['Harga'] ?>" placeholder="Harga Sebelumnya: Rp. <?php echo $harga ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="categoryTempat" name="inputcategoryTempat" value="<?php echo $row['Category_Tempat'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="fasilitas">Fasilitas</label>
                                            <select name="inputFasilitas" class="form-control" id="fasilitas">
                                                <option value="<?php echo $row['idPembayaran']?>">Fasilitas Sebelumnya: <?php echo $row['jenisPemb']?></option>
                                                <?php if (mysqli_num_rows($queryfasilitas) > 0) { ?>
                                                    <?php while ($row = mysqli_fetch_array($queryfasilitas)) { ?>
                                                        <option value="<?php echo $row["idPembayaran"] ?>">
                                                            <?php echo $row["jenisPemb"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="noKamar">No. Kamar</label>
                                            <input type="text" class="form-control" id="noKamar" name="inputNoKamar" value="<?php echo $getNoKamar ?>" disabled>
                                        </div>

                                        


                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" name="submit" style="display:block">Kumpul</button>
                                            <a href="addpenghunibaru.php" class="btn btn-warning" style="display:block; margin-top: 20px">Kembali Pilih Kamar</a>
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