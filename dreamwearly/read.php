<?php
require_once('db.php');

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM dress";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$rows = mysqli_num_rows($result);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Halaman Admin</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        body{
            background-color:  #f0f0f0;
        }
    </style>
    
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">

            <a class="navbar-brand">DREAMWEARLY</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="read.php" class="nav-item nav-link active">Admin</a>
                    <a href="home.php" class="nav-item nav-link ">Home</a>
                    <a href="produk.php" class="nav-item nav-link">Product</a>
                    <a href="logout.php" class="nav-item nav-link">Logout</a>
                </div>
            </div>
    </nav>
    <br>
    <div class="container">
        <h2 class="heading">Persediaan Barang</h2>
        <div class="p-5 bg-light rounded-3">

            <a href="create_form.php" class="btn btn-secondary">Tambah Stok Barang</a>
            <br>
            <table class="table">
                <div class="p-1 bg-light rounded-3">
                    <thead>

                        <tr>
                            <th scope="col">NAMA BARANG</th>
                            <th scope="col">KETERANGAN</th>
                            <th scope="col">HARGA</th>
                            <th scope="col">UKURAN</th>
                            <th scope="col">STOK</th>
                            <th scope="col">GAMBAR</th>
                            <th scope="col">TINDAKAN</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        for ($index = 0; $index < $rows; $index++) {
                        ?>

                            <tr>
                                <td><?php echo $data[$index]['barang'] ?></td>
                                <td><?php echo $data[$index]['keterangan'] ?></td>
                                <td><?php echo $data[$index]['harga'] ?></td>
                                <td><?php echo $data[$index]['ukuran'] ?></td>
                                <td><?php echo $data[$index]['stok'] ?></td>
                                <td> <img src="uploaded/<?php echo $data[$index]['image']; ?>" class="img-thumbnail" width="100" height="100"></td>
                                <td>
                                    <a href="update_form.php?id=<?php echo $data[$index]['id'] ?>">
                                        <button type="button" class="btn btn-warning">Ubah Data</button>
                                    </a>
                                    <a href="delete.php?id=<?php echo $data[$index]['id'] ?> &image=<?php echo $data[$index]['image'] ?>">
                                        <button type="button" class="btn btn-danger">Hapus Data</button>
                                    </a>

                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
            </table>
        </div>

        <footer>
            <div class="row">
                <!-- kolom 1 -->
                <div class="col-md-6">
                    <p>Copyright &copy; 2024 dreamwearly.co</p>
                </div>
                <!-- kolom 2 -->
                <div class="col-md-6 text-md-end">
                    <a href="https://instagram.com">Instagram : @dreamwearly.co</a>
                </div>
            </div>
        </footer>
</body>

</html>