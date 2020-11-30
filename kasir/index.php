<?php
include 'components/config.php';
ob_start();
session_start();
if (!isset($_SESSION['idUser'])) {
  header("location:login.php");
}

$idUser = $_SESSION['idUser'];

$query = mysqli_query($connection, "SELECT * FROM
data_print_kuitansi d JOIN lokasikerjauser l ON (l.lokasiKos = d.Category_Tempat)
JOIN jenispembayaran j ON (d.idPembayaran = j.idPembayaran)
WHERE l.idUser = '$idUser'");


if (isset($_POST['submit'])) {
  $checkbox = $_POST['selectedData'];
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

    mysqli_query($connection, "UPDATE data_print_kuitansi SET Tgl_Approve = SYSDATE() WHERE No_Kamar = '$checkbox[$i]'");
    mysqli_query($connection, "INSERT INTO hstry_data_print_kuitansi VALUES ('$NoKamar', '$Nama', '$Pembayaran', '$Harga', '$TglKui', '$Category', '$TglByr', SYSDATE())");

    header('location:printkuitansi.php');
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
              <h1 class="m-0 text-dark">Data Print Kuitansi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Data Print Kuitansi</li>
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
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="width: 5px">No.</th>
                          <th style="width: 5px"></th>
                          <th style="width: 20px">Nomor Kamar</th>
                          <th style="width: 20px">Nama</th>
                          <th>Harga</th>
                          <th>Tanggal Kuitansi</th>
                          <th>Category Tempat</th>
                          <th>Tanggal Bayar</th>
                          <th>Action</th>
                          <th>Approval</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($query) > 0) {
                          $nomor = 1 ?>
                          <?php while ($row = mysqli_fetch_array($query)) {
                            $harga = number_format($row["Harga"], 0, ",", ".");
                          ?>
                            <tr>
                              <td><?php echo $nomor ?></td>
                              <td>
                                <?php
                                if ($row['Tgl_Byr'] == '0000-00-00' && $row['Tgl_Approve'] == '0000-00-00') { ?>
                                  -
                                <?php } else if ($row['Tgl_Byr'] != '0000-00-00' && $row['Tgl_Approve'] == '0000-00-00') { ?>
                                  <input type="checkbox" name="selectedData[]" value="<?php echo $row['No_Kamar'] ?>">
                                <?php } else if ($row['Tgl_Byr'] != '0000-00-00' && $row['Tgl_Approve'] != '0000-00-00') { ?>
                                  -
                                <?php } ?>
                              </td>
                              <td><?php echo $row['No_Kamar'] ?></td>
                              <td><?php echo $row['Nama'] ?></td>
                              <td>Rp. <?php echo $harga ?></td>
                              <td><?php echo $row['Tgl_Kui'] ?></td>
                              <td><?php echo $row['Category_Tempat'] ?></td>
                              <td><?php echo $row['Tgl_Byr'] ?></td>
                              <td>
                                <a href="updatedeleteprintkuitansi.php?nokamar=<?php echo $row['No_Kamar'] ?>"><i class="fas fa-edit"></i></a> |
                                <a href="updatedeleteprintkuitansi.php?nokamarhapus=<?php echo $row['No_Kamar'] ?>" onclick="return confirm ('Apakah Anda Yakin?')"><i class="fas fa-trash"></i></a>
                              </td>
                              <td>
                                <?php
                                if ($row['Tgl_Byr'] == '0000-00-00' && $row['Tgl_Approve'] == '0000-00-00') { ?>
                                  <small class="badge badge-warning">Waiting for Payment</small>
                                <?php } else if ($row['Tgl_Byr'] != '0000-00-00' && $row['Tgl_Approve'] == '0000-00-00') { ?>
                                  <a href="approvehistory.php?approveid=<?php echo $row['No_Kamar'] ?>" class="btn btn-primary" style="display: block">Approve</a>
                                <?php } else if ($row['Tgl_Byr'] != '0000-00-00' && $row['Tgl_Approve'] != '0000-00-00') { ?>
                                  <small class="badge badge-success">Approved</small>
                                <?php } ?>
                              </td>
                            </tr>
                          <?php $nomor++;
                          }  ?>
                        <?php } ?>
                    </table>

                </div>
                <button type="button" id="button1" class="btn btn-primary" data-toggle="modal" data-target="#modal-confirm" style="display:block">Approve</button>

                <div class="modal fade" id="modal-confirm">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Kuitansi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p id="checkid"></p>
                        <!-- <div class="card-body table-responsive p-0">
                          <table class="table table-bordered text-nowrap">
                            <thead>
                              <tr>
                                <th>No. Kamar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>B Extra</td>
                                <td>Jamal</td>
                                <td>Rp. 425.000</td>
                              </tr>
                            </tbody>
                          </table>
                        </div> -->
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Konfirmasi</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
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
    $(document).ready(function() {
      $("#button1").click(function() {
        var p = $("#modal-confirm #checkid");
        $(p).html("Anda Telah Memilih:");
        $.each($("input[name='selectedData[]']:checked"), function() {
          $(p).html($(p).html() + '<br>' + $(this).val());
        });
      });
    });
  </script>
</body>

</html>
<?php
mysqli_close($connection);
ob_end_flush();
?>