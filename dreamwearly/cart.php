<?php

@include 'confirm.php';
require_once('db.php');

session_start();

if (!$conn) {
   die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['update_update_btn'])) {
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `chart` SET jumlah = '$update_value', total = harga * '$update_value' WHERE id = '$update_id'");
   if ($update_quantity_query) {
      header('location:cart.php');
   } else {
      echo "Failed to update quantity: " . mysqli_error($conn);
   }
}

if (isset($_GET['remove'])) {
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `chart` WHERE id = '$remove_id'");
   header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `chart`");
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shopping Cart</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <script src="js/script.js"></script>

   <style>
      :root {
         --red: tomato;
         --orange: #A0522D;
         --black: #333;
         --white: #fff;
         --bg-color: #eee;
         --dark-bg: rgba(0, 0, 0, .7);
         --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
         --border: .1rem solid #999;
      }

      body {
         background-color: #D3D3D3;
         margin: 0;
         padding: 0;
         font-family: Arial, sans-serif;
      }

      .container {
         margin: 50px auto;
         padding: 20px;
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .heading {
         font-size: 24px;
         background-color: burlywood;
         padding: 10px;
         text-align: center;
         border-radius: 10px;
         margin-bottom: 20px;
      }

      .shopping-cart table {
         width: 100%;
         border-collapse: collapse;
      }

      .shopping-cart table thead th {
         padding: 1rem;
         font-size: 1.2rem;
         color: var(--white);
         background-color: var(--black);
         text-align: center;
      }

      .shopping-cart table tr td {
         border-bottom: var(--border);
         padding: 0.5rem;
         font-size: 1rem;
         color: var(--black);
         text-align: center;
      }

      .shopping-cart table input[type="number"] {
         border: var(--border);
         padding: 0.5rem;
         font-size: 1rem;
         color: var(--black);
         width: 50px;
         text-align: center;
      }

      .shopping-cart table input[type="submit"] {
         padding: 0.3rem 0.5rem;
         cursor: pointer;
         font-size: 1rem;
         background-color: #CD853F;
         color: var(--white);
         border: none;
         border-radius: 5px;
      }

      .shopping-cart table input[type="submit"]:hover {
         background-color: var(--black);
      }

      .shopping-cart .checkout-btn {
         text-align: center;
         margin-top: 1rem;
      }

      .shopping-cart .checkout-btn a {
         display: inline-block;
         padding: 0.5rem 1rem;
         background-color: var(--orange);
         color: var(--white);
         font-size: 1rem;
         border-radius: 5px;
         text-decoration: none;
      }

      .shopping-cart .checkout-btn a.disabled {
         pointer-events: none;
         opacity: .5;
         user-select: none;
         background-color: var(--red);
      }

      .shopping-cart .option-btn {
         padding: 0.5rem 1rem;
         background-color: var(--orange);
         color: var(--white);
         text-decoration: none;
         border-radius: 5px;
         display: inline-block;
         margin-top: 10px;
      }

      .shopping-cart .delete-btn {
         padding: 0.3rem 0.5rem;
         background-color: var(--red);
         color: var(--white);
         text-decoration: none;
         border-radius: 5px;
      }

      .text-center {
         text-align: center;
      }
   </style>

</head>

<body>

   <div class="container">
      <section class="shopping-cart">
         <h1 class="heading">Shopping Cart</h1>
         <table>
            <thead>
               <th>Gambar</th>
               <th>Barang</th>
               <th>Harga</th>
               <th>Jumlah</th>
               <th>Harga Total</th>
               <th>Action</th>
            </thead>
            <tbody>
               <?php
               $select_cart = mysqli_query($conn, "SELECT * FROM `chart`");
               $grand_total = 0;
               if (mysqli_num_rows($select_cart) > 0) {
                  while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                     $harga = is_numeric($fetch_cart['harga']) ? $fetch_cart['harga'] : 0;
                     $jumlah = is_numeric($fetch_cart['jumlah']) ? $fetch_cart['jumlah'] : 0;
                     $sub_total = $harga * $jumlah;
               ?>
                     <tr>
                        <td><img src="uploaded/<?php echo htmlspecialchars($fetch_cart['image']); ?>" height="100" alt=""></td>
                        <td><?php echo htmlspecialchars($fetch_cart['barang']); ?></td>
                        <td>Rp<?php echo number_format($harga, 0, ',', '.'); ?>/-</td>
                        <td>
                           <form action="" method="post">
                              <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                              <input type="number" name="update_quantity" min="1" value="<?php echo $jumlah; ?>">
                              <input type="submit" value="Update" name="update_update_btn">
                           </form>
                        </td>
                        <td>Rp<?php echo number_format($sub_total, 0, ',', '.'); ?>/-</td>
                        <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"><i class="fas fa-trash"></i> Remove</a></td>
                     </tr>
               <?php
                     $grand_total += $sub_total;
                  }
               } else {
                  echo '<tr><td colspan="6" class="text-center">No items in cart</td></tr>';
               }
               ?>
               <tr class="table-bottom">
                  <td><a href="produk.php" class="option-btn" style="margin-top: 0;">Continue Shopping</a></td>
                  <td colspan="3">Grand Total</td>
                  <td>Rp<?php echo number_format($grand_total, 0, ',', '.'); ?>/-</td>
                  <td><a href="cart.php?delete_all" onclick="return confirm('Apakah Anda Ingin Menghapus Semuanya?');" class="delete-btn"><i class="fas fa-trash"></i> Delete</a></td>
               </tr>
            </tbody>
         </table>
         <div class="checkout-btn">
            <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
         </div>
      </section>

   </div>


      <footer>
            <div class="row">
                <div class="col-md-6">
                    <p>Copyright &copy; 2024 dreamwearly.co</p>
                </div>
            </div>
        </footer>

</body>

</html>
