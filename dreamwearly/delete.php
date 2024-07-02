<?php
require_once('db.php');

$id = $_GET['id'];
$image = $_GET['image'];

$query ="DELETE FROM dress
WHERE id= '$id'";

mysqli_query($conn, $query);

unlink('uploaded/'.$image);

echo "<script>alert('Proses Delete Barang Berhasil')</script>";
echo"<script>window.location.href='read.php'</script>";

?>