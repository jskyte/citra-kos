<?php 

  include "components/config.php";

  ob_start();
  session_start();
  if(isset($_SESSION['idUser'])) {
    header("location:index.php");
  }

  if(isset($_POST['submit'])) {
    $idUser = $_POST['loginIdUser'];
    $pinUser = $_POST['loginPin'];
    $sql_login = mysqli_query($connection, "SELECT * FROM user WHERE idUser = '$idUser' AND pinUser = '$pinUser'");
  
  
    if(mysqli_num_rows($sql_login) > 0) {
      $row_admin = mysqli_fetch_assoc($sql_login);

        if($row_admin['roleUser'] == 'Owner') {
            $_SESSION['idUser'] = $row_admin["idUser"];
            $_SESSION['namaUser'] = $row_admin["namaUser"];
            $_SESSION['roleUser'] = $row_admin["roleUser"];
            header("location:index.php");
        }
        else if($row_admin['roleUser'] == 'Kasir') {
            $_SESSION['idUser'] = $row_admin["idUser"];
            $_SESSION['namaUser'] = $row_admin["namaUser"];
            $_SESSION['roleUser'] = $row_admin["roleUser"];
            header("location:kasir/index.php");
        }

    }

    
  else {
  $message = "Username and/or Password incorrect.\\nTry again.";
  echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Citra Kos | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Citra</b>Kos</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="loginIdUser">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"  placeholder="PIN" name="loginPin">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->



    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

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