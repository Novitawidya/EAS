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
           <h2 class="judul"> Tambah Barang</h2>
            <br><br>
            <form action="create.php" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="barang" placeholder="Gamis" name="barang">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" rows="3" placeholder="Deskripsi dan spesifikasi barang" name="keterangan"></textarea>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" step="1" class="form-control" id="harga" placeholder="120000" name="harga">
                </div>
                <div class="mb-3">
                    <label for="kategori">Kategori Barang</label>
                    <select for="kategori" class="form-select" aria-label="Default select example" id="kategori" name="kategori">
                        <option selected>Kategori
                        <option value="2">Gamis</option>
                        <option value="3">Blouse</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" step="1" class="form-control" id="stok" placeholder="2" name="stok">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-secondary">SUBMIT</button>
            </form>

        </div>

</body>

</html>