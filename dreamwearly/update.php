<?php
    require_once('db.php');

    $id = $_GET['id'];

    $barang = $_POST['barang'];
    $keterangan = $_POST['keterangan'];
    $harga = $_POST['harga'];
    $ukuran = $_POST['ukuran'];
    $stok = $_POST['stok'];

    $query = "UPDATE dress 
                SET barang='$barang', keterangan= '$keterangan', harga= '$harga', ukuran= '$ukuran', stok= '$stok'
                WHERE id= '$id'";

mysqli_query($conn, $query);

echo "<script>alert('Proses Update Barang Berhasil')</script>";
echo"<script>window.location.href='read.php'</script>";

?>