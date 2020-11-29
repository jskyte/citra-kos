<?php
include 'components/config.php';
ob_start();
session_start();
if (!isset($_SESSION['idUser'])) {
  header("location:login.php");
}

$query = mysqli_query($connection, "SELECT * FROM data_print_kuitansi JOIN jenispembayaran ON (jenispembayaran.idPembayaran = data_print_kuitansi.idPembayaran)");

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
                <div class="card-header">
                  <a class="btn btn-primary ctm-responsive-btn" href="addprintkuitansi.php">Add Data Print Kuitansi</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 5px"></th>
                        <th style="width: 20px">Nomor Kamar</th>
                        <th style="width: 20px">Nama</th>
                        <th style="width: 20px">Pembayaran</th>
                        <th>Harga</th>
                        <th>Tanggal Kuitansi</th>
                        <th>Category Tempat</th>
                        <th>Tanggal Bayar</th>
                        <th>Action</th>
                        <th>Approval</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($row = mysqli_fetch_array($query)) {
                          $harga = number_format($row["Harga"], 0, ",", "."); ?>
                          <tr>
                            <td>
                              <?php if ($row['Tgl_Byr'] == '0000-00-00') { ?>
                                <input type="checkbox" name="selectedData[]" value="<?php echo $row['No_Kamar'] . ' | ' . $row['Nama'] . ' | ' . $harga ?>">
                              <?php } else { ?>
                                <p>-</p>
                              <?php } ?>
                            </td>
                            <td><?php echo $row['No_Kamar'] ?></td>
                            <td><?php echo $row['Nama'] ?></td>
                            <td><?php echo $row['jenisPemb'] ?></td>
                            <td>Rp. <?php echo $harga ?></td>
                            <td><?php echo $row['Tgl_Kui'] ?></td>
                            <td><?php echo $row['Category_Tempat'] ?></td>
                            <td><?php echo $row['Tgl_Byr'] ?></td>
                            <td>
                              <a href="updatedeleteprintkuitansi.php?nokamar=<?php echo $row['No_Kamar'] ?>"><i class="fas fa-edit"></i></a> |
                              <a href="updatedeleteprintkuitansi.php?nokamarhapus=<?php echo $row['No_Kamar'] ?>" onclick="return confirm ('Apakah Anda Yakin?')"><i class="fas fa-trash"></i></a>
                            </td>
                            <td>
                              <?php if ($row['Tgl_Byr'] == '0000-00-00') { ?>
                                <a href="approvehistory.php?approveid=<?php echo $row['No_Kamar'] ?>" class="btn btn-warning" style="display: block">Approve</a>
                              <?php } else { ?>
                                <small class="badge badge-primary">Approved</small>
                              <?php } ?>
                            </td>
                          </tr>
                        <?php } ?>
                      <?php } ?>
                  </table>
                </div>
                <!-- /.card-body -->
                <button id="button1" class="btn btn-warning ctm-responsive-btn" data-toggle="modal" data-target="#modal-confirm">Approve</button>
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
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Konfirmasi</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

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
        $.each($("input[name='selectedData']:checked"), function() {
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