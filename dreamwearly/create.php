<?php
require_once('db.php');

$barang = $_POST['barang'];
$keterangan = $_POST['keterangan'];
$harga = $_POST['harga'];
$kategori = $_POST['kategori'];
$stok = $_POST['stok'];

$image = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

move_uploaded_file($_FILES['image']['tmp_name'], 'uploded/' . 'image');

$query = "INSERT INTO dress (barang, keterangan, harga, kategory, stok, image)
VALUES ('$barang', '$keterangan', '$harga', '$kategori', '$stok', '$image')";

mysqli_query($conn, $query);

echo "<script>alert('Proses Tambah Barang Berhasil')</script>";
echo"<script>window.location.href='read.php'</script>";
