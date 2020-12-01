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
  for ($i = 0; $i < sizeof($checkbox); $i++) {
    mysqli_query($connection, "UPDATE data_print_kuitansi SET Tgl_Byr = NOW() WHERE No_Kamar = '$checkbox[$i]'");

    $querycheck = mysqli_query($connection, "SELECT * FROM data_print_kuitansi WHERE No_Kamar = '$checkbox[$i]'");
    $data = mysqli_fetch_array($querycheck);
    $NoKamar = $data['No_Kamar'];
    $Nama = $data['Nama'];
    $Pembayaran = $data['idPembayaran'];
    $Harga = $data['Harga'];
    $TglKui = $data['Tgl_Kui'];
    $Category = $data['Category_Tempat'];
    $TglApp = $data[''];
    $TglByr = $data['Tgl_Byr'];

    mysqli_query($connection, "UPDATE data_print_kuitansi SET Tgl_Byr = SYSDATE() WHERE No_Kamar = '$checkbox[$i]'");

    header('location:index.php');
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
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="display:none"></th>
                                                    <th style="width: 10px">No. </th>
                                                    <th>Nomor Kamar</th>
                                                    <th>Nama</th>
                                                    <th>Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $nomor = 1;
                                                while ($i < sizeof($selectedData)) {
                                                    $query = mysqli_query($connection, "SELECT * FROM data_print_kuitansi WHERE No_Kamar = '$selectedData[$i]'");

                                                    $fetchData = mysqli_fetch_array($query);
                                                    $Nama = $fetchData['Nama'];
                                                    $Harga = $fetchData['Harga'];
                                                    $NoKamar = $fetchData['No_Kamar'];
                                                    $fHarga = number_format($Harga, 0, ",", ".");
                                                    $subTotal += $Harga;
                                                    $fSubTotal = number_format($subTotal, 0, ",", ".");

                                                ?>
                                                    <tr>
                                                        <td style="display:none"><input type="checkbox" name="checkboxData[]" value="<?php echo $NoKamar ?>" checked></td>
                                                        <td><?php echo $nomor ?></td>
                                                        <td><?php echo $NoKamar ?></td>
                                                        <td><?php echo $Nama ?></td>
                                                        <td>Rp. <?php echo $fHarga ?></td>
                                                    </tr>
                                                <?php $nomor++;
                                                    $i++;
                                                }  ?>
                                                    <tr>
                                                        <td style="display:none"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="float:right"><b>Total:</b> </td>
                                                        <td>Rp. <?php echo $fSubTotal?></td>
                                                    </tr>
                                        </table>

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
</body>

</html>
<?php
mysqli_close($connection);
ob_end_flush();
?>