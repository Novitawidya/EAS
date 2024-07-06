<?php
require_once('db.php');

session_start();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM dress";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$rows = mysqli_num_rows($result);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login_form.php');
    exit();
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_image = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $product_size = $_POST['product_size'];
    $product_price = $_POST['product_price'];
    $quantity = 1; 

    $check_cart_query = "SELECT * FROM chart WHERE barang='$product_name'";
    $check_cart_result = mysqli_query($conn, $check_cart_query);

    if (mysqli_num_rows($check_cart_result) > 0) {
        $update_quantity_query = "UPDATE chart SET jumlah=jumlah + 1, total=harga * jumlah WHERE barang='$product_name'";
        mysqli_query($conn, $update_quantity_query);
    } else {
        $add_to_cart_query = "INSERT INTO chart (image, barang, ukuran, harga, jumlah, total) VALUES ('$product_image', '$product_name', '$product_size', '$product_price', '$quantity', '$product_price')";
        mysqli_query($conn, $add_to_cart_query);
    }

    $_SESSION['message'] = 'Barang Telah Masuk Ke Keranjang';
    header('Location: produk.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Dreamwealy</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">

    <style>
        #subjudul {
            font-family: Verdana;
            font-size: 30px;
            font-weight: bold;
            font-style: italic;
            margin-bottom: 0;
            margin-bottom: 10px;
        }
        body {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand">DREAMWEARLY</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="home.php" class="nav-item nav-link">Home</a>
                    <a href="produk.php" class="nav-item nav-link active">Product</a>
                    <a href="cart.php" class="nav-item nav-link">Cart</a>
                    <?php if (isset($_SESSION['admin_name']) || isset($_SESSION['user_name'])): ?>
                        <a href="?logout=true" class="nav-item nav-link">Logout</a>
                    <?php else: ?>
                        <a href="login_form.php" class="nav-item nav-link">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        <div class="p-5 my-4 bg-light rounded-3 text-center">
            <div id="subjudul">
                Koleksi Kami
                <br>
                <br>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php for ($index = 0; $index < $rows; $index++) { ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="uploaded/<?php echo $data[$index]['image']; ?>" class="card-img-top" alt="Product Image" width="150" height="300">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data[$index]['barang']; ?></h5>
                                <!-- <p class="card-text"><?php echo $data[$index]['keterangan']; ?></p> -->
                                <div class="card-footer bg-transparent border-0">
                                    <p class="text-muted">Ukuran: <?php echo $data[$index]['ukuran']; ?></p>
                                    <p class="card-text">Harga : <?php echo $data[$index]['harga']; ?></p>
                                    <a href="detail.php?id=<?php echo $data[$index]['id']; ?>" class="btn btn-dark">Detail Produk &raquo;</a>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="product_id" value="<?php echo $data[$index]['id']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $data[$index]['image']; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo $data[$index]['barang']; ?>">
                                        <input type="hidden" name="product_size" value="<?php echo $data[$index]['ukuran']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $data[$index]['harga']; ?>">
                                        <input type="submit" class="btn btn-dark" value="add to cart" name="add_to_cart">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <footer>
            <div class="row">
                <div class="col-md-6">
                    <p>Copyright &copy; 2024 dreamwearly.co</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="https://instagram.com">Instagram: @dreamwearly.co</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
