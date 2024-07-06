<?php

@include 'confirm.php';

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $flat = mysqli_real_escape_string($conn, $_POST['flat']);
   $street = mysqli_real_escape_string($conn, $_POST['street']);
   $city = mysqli_real_escape_string($conn, $_POST['city']);
   $state = mysqli_real_escape_string($conn, $_POST['state']);
   $country = mysqli_real_escape_string($conn, $_POST['country']);
   $pin_code = mysqli_real_escape_string($conn, $_POST['pin_code']);

   $cart_query = mysqli_query($conn, "SELECT * FROM `chart`");
   $price_total = 0;
   $product_name = [];

   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['barang'] .' ('. $product_item['jumlah'] .') ';
         $product_price = $product_item['harga'] * $product_item['jumlah'];
         $price_total += $product_price;
      }
   }

   $total_product = implode(', ', $product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders` (name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES ('$name', '$number', '$email', '$method', '$flat', '$street', '$city', '$state', '$country', '$pin_code', '$total_product', '$price_total')");

   if($detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>Thank You for Shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> Total: Rp".number_format($price_total, 0, ',', '.')." </span>
         </div>
         <div class='customer-details'>
            <p>Nama Lengkap: <span>".$name."</span></p>
            <p>Nomor Telepon: <span>".$number."</span></p>
            <p>Email: <span>".$email."</span></p>
            <p>Alamat: <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span></p>
            <p>Metode Pembayaran: <span>".$method."</span></p>
            <p>(*Proses Pemesanan Selesai*)</p>
         </div>
         <a href='produk.php' class='btn'>Continue shopping</a>
      </div>
      </div>
      ";

      mysqli_query($conn, "DELETE FROM `chart`");
   } else {
      echo "Failed to place the order: " . mysqli_error($conn);
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
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
            background-color: #f0f0f0;
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
         font-size: 30px;
         background-color: burlywood;
         padding: 10px;
         text-align: center;
         border-radius: 10px;
         margin-bottom: 20px;
      }
      .checkout-form form{
   padding:2rem;
   border-radius: .5rem;
   background-color: var(--bg-color);
}

.checkout-form form .flex{
   display: flex;
   flex-wrap: wrap;
   gap:1.5rem;
}

.checkout-form form .flex .inputBox{
   flex:1 1 40rem;
}

.checkout-form form .flex .inputBox span{
   font-size: 20px;
   color:var(--black);
}

.checkout-form form .flex .inputBox input,
.checkout-form form .flex .inputBox select{
   width: 100%;
   background-color: var(--white);
   font-size: 20px;
   color:var(--black);
   border-radius: .5rem;
   margin:1rem 0;
   padding:5px 10px;
   text-transform: none;
   border:var(--border);
}

.display-order{
   max-width: 50rem;
   background-color: var(--white);
   border-radius: .5rem;
   text-align: center;
   padding:1.5rem;
   margin:0 auto;
   margin-bottom: 2rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
}

.display-order span{
   display: inline-block;
   border-radius: .5rem;
   background-color: var(--bg-color);
   padding:.5rem 1.5rem;
   font-size: 20px;
   color:var(--black);
   margin:.5rem;
}

.display-order span.grand-total{
   width: 90%;
   background-color: var(--red);
   color:var(--white);
   padding:1rem;
   margin-top: 1rem;
}

.order-message-container{
   position: fixed;
   top:0; left:0;
   height: 100vh;
   overflow-y: scroll;
   overflow-x: hidden;
   padding:2rem;
   display: flex;
   align-items: center;
   justify-content: center;
   z-index: 1100;
   background-color: var(--dark-bg);
   width: 100%;
}

.order-message-container::-webkit-scrollbar{
   width: 1rem;
}

.order-message-container::-webkit-scrollbar-track{
   background-color: var(--dark-bg);
}

.order-message-container::-webkit-scrollbar-thumb{
   background-color: var(--blue);
}

.order-message-container .message-container{
   width: 50rem;
   background-color: var(--white);
   border-radius: .5rem;
   padding:2rem;
   text-align: center;
}

.order-message-container .message-container h3{
   font-size: 2.5rem;
   color:var(--black);
}

.order-message-container .message-container .order-detail{
   background-color: var(--bg-color);
   border-radius: .5rem;
   padding:1rem;
   margin:1rem 0;
}

.order-message-container .message-container .order-detail span{
   background-color: var(--white);
   border-radius: .5rem;
   color:var(--black);
   font-size: 2rem;
   display: inline-block;
   padding:1rem 1.5rem;
   margin:1rem;
}

.order-message-container .message-container .order-detail span.total{
   display: block;
   background: var(--red);
   color:var(--white);
}

.order-message-container .message-container .customer-details{
   margin:1.5rem 0;
}

.order-message-container .message-container .customer-details p{
   padding:1rem 0;
   font-size: 20px;
   color:var(--black);
}

.order-message-container .message-container .customer-details p span{
   color:var(--blue);
   padding:0 .5rem;
   text-transform: none;
}


   </style>
</head>
<body>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">Lengkapi Data Pesanan</h1>

   <form action="" method="post">

      <div class="display-order">
         <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `chart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
               $total_price = $fetch_cart['harga'] * $fetch_cart['jumlah'];
               $grand_total += $total_price;
         ?>
         <span><?= htmlspecialchars($fetch_cart['barang']); ?> (<?= htmlspecialchars($fetch_cart['jumlah']); ?>)</span>
         <?php
            }
         } else {
            echo "<div class='display-order'><span>Your cart is empty!</span></div>";
         }
         ?>
         <span class="grand-total">Grand total: Rp<?= number_format($grand_total, 0, ',', '.'); ?></span>
      </div>

      <div class="flex">
         <div class="inputBox">
            <span>Nama Lengkap</span>
            <input type="text" placeholder="Enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>Nomor Telepon</span>
            <input type="number" placeholder="Enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>Email</span>
            <input type="email" placeholder="Enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>Metode Pembayaran</span>
            <select name="method">
               <option value="cash on delivery" selected>Cash on Delivery</option>
               <option value="credit card">Credit card</option>
            </select>
         </div>
         <div class="inputBox">
            <span>No Rumah</span>
            <input type="text" placeholder="no. 2" name="flat" required>
         </div>
         <div class="inputBox">
            <span>Jalan</span>
            <input type="text" placeholder="Jl. Merpati" name="street" required>
         </div>
         <div class="inputBox">
            <span>Kota/Kabupaten</span>
            <input type="text" placeholder="Kota Surabaya" name="city" required>
         </div>
         <div class="inputBox">
            <span>Provinsi</span>
            <input type="text" placeholder="Jawa Timur" name="state" required>
         </div>
         <div class="inputBox">
            <span>Negara</span>
            <input type="text" placeholder="Indonesia" name="country" required>
         </div>
         <div class="inputBox">
            <span>Pin Code</span>
            <input type="text" placeholder="12345" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="Order now" name="order_btn" class="btn">
   </form>

</section>

</div>

</body>
</html>
