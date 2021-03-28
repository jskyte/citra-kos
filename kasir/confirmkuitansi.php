<?php
include 'components/config.php';
ob_start();
session_start();
if (!isset($_SESSION['idUser'])) {
    header("location:login.php");
}

$selectedData = $_POST['selectedData'];

$i = 0;
$subTotal = 0;



if (isset($_POST['submit'])) {
    $checkbox = $_POST['checkboxData'];
    $Harga = $_REQUEST['hargaKamar'];
    $Pembayaran = $_REQUEST['inputJenisPemb'];
    $idUser = $_SESSION['idUser'];
    $AlasanPerubahan = $_REQUEST['alasanPerubahan'];
    for ($i = 0; $i < sizeof($checkbox); $i++) {

        $querycheck = mysqli_query($connection, "SELECT * FROM b_data_print_kuitansi WHERE id_Kui = '$checkbox[$i]'");
        $data = mysqli_fetch_array($querycheck);
        $NoKamar = $data['No_Kamar'];
        $Nama = $data['Nama'];
        $HargaBefore = $data['Harga'];
        $TglKui = $data['Tgl_Kui'];
        $Category = $data['Category_Tempat'];


        $tz = 'Asia/Jakarta';
        $dt = new DateTime("now", new DateTimeZone($tz));
        $timestampwib = $dt->format('Y-m-d G:i:s');

        if ($HargaBefore == $Harga[$i]) {
            $Keterangan = 'Tidak ada perubahan harga';
        } else {
            $Keterangan = 'Perubahan harga dari Rp. ' . $HargaBefore . ' menjadi Rp. ' . $Harga[$i];
        }

        if ($AlasanPerubahan[$i] == "") {
            $Alasan = $AlasanPerubahan[$i];
        } else {
            $Alasan = ", " . $AlasanPerubahan[$i];
        }

        mysqli_query($connection, "INSERT INTO c_laporansetorankasir VALUES ('', '$NoKamar', '$Nama', '$Harga[$i]', '$Pembayaran[$i]', '$TglKui', '$Category', '$timestampwib', '$idUser', '$Keterangan $Alasan')");
        mysqli_query($connection, "INSERT INTO e_loguser VALUES ('', '$NoKamar', '$Nama', '$Harga[$i]', '$Pembayaran[$i]', '$TglKui', '$Category', '$timestampwib', '$idUser', 'TAGIHAN', '$Keterangan $Alasan')");

        header('location:historytagihan.php');
    }
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
                            <h1 class="m-0 text-dark">Konfirmasi Kuitansi</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="datakamar.php">Home</a></li>
                                <li class="breadcrumb-item active">Konfirmasi Kuitansi</li>
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
                                    <form role="form" enctype="multipart/form-data" method="POST">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="display:none"></th>
                                                        <th style="display:none">No. </th>
                                                        <th style="width: 10px">Kamar</th>
                                                        <th>Nama</th>
                                                        <th>Harga</th>
                                                        <th>Pembayaran</th>
                                                        <th>Tanggal Kuitansi</th>
                                                        <th>Category Tempat</th>
                                                        <th>Alasan Perubahan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1;
                                                    while ($i < sizeof($selectedData)) {
                                                        $query = mysqli_query($connection, "SELECT * FROM b_data_print_kuitansi JOIN jenispembayaran ON (b_data_print_kuitansi.idPembayaran = jenispembayaran.idPembayaran) WHERE id_Kui = '$selectedData[$i]'");
                                                        $queryfasilitas = mysqli_query($connection, "SELECT * FROM jenispembayaran WHERE idPembayaran != (SELECT idPembayaran FROM b_data_print_kuitansi WHERE id_Kui = '$selectedData[$i]')");

                                                        $fetchData = mysqli_fetch_array($query);
                                                        $index = $fetchData['id_Kui'];
                                                        $Nama = $fetchData['Nama'];
                                                        $Harga = $fetchData['Harga'];
                                                        $NoKamar = $fetchData['No_Kamar'];
                                                        $IdPembayaran = $fetchData['idPembayaran'];
                                                        $Pembayaran = $fetchData['jenisPemb'];
                                                        $TglKui = $fetchData['Tgl_Kui'];
                                                        $CategoryTemp = $fetchData['Category_Tempat'];
                                                        $fHarga = number_format($Harga, 0, ",", ".");
                                                        $subTotal += $Harga;
                                                        $fSubTotal = number_format($subTotal, 0, ",", ".");

                                                    ?>
                                                        <tr>
                                                            <td style="display:none"><input type="checkbox" name="checkboxData[]" value="<?php echo $index ?>" checked></td>
                                                            <td style="display:none"><?php echo $nomor ?></td>
                                                            <td><?php echo $NoKamar ?></td>
                                                            <td><?php echo $Nama ?></td>
                                                            <!-- <td>Rp. <?php echo $fHarga ?></td> -->
                                                            <td><sup style="color: red">*</sup>Rp.<input type="number" name="hargaKamar[]" value="<?php echo $Harga ?>" style="border-top: none; border-left: none; border-right: none; width: 100px" /></td>
                                                            <td>
                                                               
                                                                    <div class="form-group">

                                                                        <select name="inputJenisPemb[]" class="form-control" id="jenisPemb" style="width:200px">
                                                                            <option value="<?php echo $IdPembayaran ?>"><?php echo $Pembayaran ?></option>
                                                                            <?php if (mysqli_num_rows($queryfasilitas) > 0) { ?>
                                                                                <?php while ($row = mysqli_fetch_array($queryfasilitas)) { ?>
                                                                                    <option value="<?php echo $row["idPembayaran"] ?>">
                                                                                        <?php echo $row["jenisPemb"]; ?>
                                                                                    </option>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                             
                                                            </td>
                                                            <td><?php echo $TglKui ?></td>
                                                            <td><?php echo $CategoryTemp ?></td>
                                                            <td><input type="text" name="alasanPerubahan[]" value="" style="border-top: none; border-left: none; border-right: none" /></td>

                                                        </tr>
                                                    <?php $nomor++;
                                                        $i++;
                                                    }  ?>
                                                    <tr>
                                                        <td style="display:none"></td>
                                                        <td style="display:none"></td>
                                                        <td></td>
                                                        <td><b>Total:</b> </td>
                                                        <td>Rp. <input name="sum" type="text" value="<?php echo $fSubTotal ?>" style="border:none" disabled /></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                            </table>
                                            <small style="color: red">*</small> <small>Harga dapat diubah</small>
                                        </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit" style="display: block">Konfirmasi</button>
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
    <script>
        //Get a list of input fields to sum
        var elements = document.getElementsByName("hargaKamar[]");
        var element_array = Array.prototype.slice.call(elements);

        //Assign the keyup event handler
        for (var i = 0; i < element_array.length; i++) {
            element_array[i].addEventListener("keyup", sum_values);
        }

        //Function to sum the values and assign it to the last input field
        function sum_values() {
            var sum = 0;
            for (var i = 0; i < element_array.length; i++) {
                sum += parseInt(element_array[i].value, 10);
            }
            document.getElementsByName("sum")[0].value = sum;
        }
    </script>

</body>

</html>
<?php
mysqli_close($connection);
ob_end_flush();
?>