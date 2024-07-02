<?php
require_once('db.php');

$id = $_GET['id'];
$query = "SELECT* FROM dress
            WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
$data = mysqli_fetch_assoc($result);

if ($rows == 0) {
    echo "<script>alert('Data Id Not Found')</script>";
    echo "<script>window.location.href='read.php'</script>";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <div class="p-5 bg-light rounded-3">
            <h2 class="judul"> Update Barang</h2>
            <br><br>
            <form action="update.php?id=<?php echo $data['id'] ?> " method="post">
                <div class="mb-3">
                    <label for="barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="barang" placeholder="Gamis" name="barang" value="<?php echo $data['barang'] ?>">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" rows="3" placeholder="Deskripsi dan spesifikasi barang" name="keterangan"><?php echo $data['keterangan']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" step="1" class="form-control" id="harga" placeholder="120000" name="harga" value="<?php echo $data['harga'] ?>">
                </div>
                <div class="mb-3">
                    <label for="ukuran">Ukuran Baju</label>
                    <select for="ukuran" class="form-select" aria-label="Default select example" id="ukuran" name="ukuran" ]?>">
                        <option value="M" <?php if ($data['ukuran'] == 'M') echo "selected" ?>>M</option>
                        <option value="L" <?php if ($data['ukuran'] == 'L') echo "selected" ?>>L</option>
                        <option value="XL" <?php if ($data['ukuran'] == 'XL') echo "selected" ?>>XL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" step="1" class="form-control" id="stok" placeholder="2" name="stok" value=<?php echo $data['stok'] ?>>
                </div>

                <button type="submit" class="btn btn-secondary">SUBMIT</button>
            </form>

        </div>

</body>

</html>