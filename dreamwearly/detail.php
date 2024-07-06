<?php
require_once('db.php');

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$query = "SELECT * FROM dress WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Detail Produk</title>

    <style>

        body{
            background-color: #f0f0f0;
                }
        .judul{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            margin-left: 100px;
        }
        .keterangan{
            font-family: Arial, Helvetica, sans-serif;
            padding: 100px;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <img src="uploaded/<?php echo $data['image'] ; ?>" alt="Product Image" class="img-fluid" >
            </div>
            <div class="col-md-6">
                <div class="judul"><h1><?php echo $data['barang']; ?></h1></div>
               <div class="keterangan"> <p><?php echo $data['keterangan']; ?></p>
                <p>Ukuran: <?php echo $data['ukuran']; ?></p>
                <p>Harga: <?php echo $data['harga']; ?></p>
                <a href="produk.php" class="btn btn-primary">Kembali ke Produk</a>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
