<?php 
    include 'components/config.php';

    $approveid = $_GET['approveid'];

    mysqli_query($connection, "UPDATE data_print_kuitansi SET Tgl_Approve = NOW() WHERE No_Kamar = '$approveid'");

    $query = mysqli_query($connection, "SELECT * FROM data_print_kuitansi WHERE No_Kamar = '$approveid'");
    $data = mysqli_fetch_array($query);
    $NoKamar = $data['No_Kamar'];
    $Nama = $data['Nama'];
    $Pembayaran = $data['idPembayaran'];
    $Harga = $data['Harga'];
    $TglKui = $data['Tgl_Kui'];
    $Category = $data['Category_Tempat'];
    $TglApp = $data[''];
    $TglByr = $data['Tgl_Byr'];

    mysqli_query($connection, "INSERT INTO hstry_data_print_kuitansi VALUES ('$NoKamar', '$Nama', '$Pembayaran', '$Harga', '$TglKui', '$Category', '$TglByr', SYSDATE())");


    header("location:printkuitansi.php");

?>