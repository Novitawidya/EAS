<?php

@include 'confirm.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:read.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:home.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

<style>
   body{
      background-color: #f0f0f0;
   }
   .form-container{
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      padding-bottom: 60px;
      background: #eee;
   }
   .form-container form{
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 5px 10px rgba(0,0,0.1);
      background-color: #fff;
      text-align: center;
      width: 500px;
   }
   .form-container form h3{
      font-size: 30px;
      text-transform: uppercase;
      margin-bottom: 10px;
      color: #333;
   }
   .form-container form input,
   .form-container form select{
      width: 95%;
      padding: 10px 15px;
      font-size: 17px;
      margin: 8px 0;
      color: black;
      border-radius: 5px ;
   }
   .form-container form select option{
   background: #fff;
   }
   .form-container form .form-btn{
   background: #fbd0d9;
   color: crimson;
   text-transform: capitalize;
   font-size: 20px;
   }
   .form-container form.form-btn:hover{
      background: crimson;
      color: #fff;
   }
   .form-container form p{
      margin-top: 10px;
      font-size: 20px;
   }
   .form-container form a{
      margin-top: 10px;
      font-size: 20px;
      color: crimson;
   }

      </style>   

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
            if (isset($_SESSION['error'])) {
                echo '<span class="error-msg">'.$_SESSION['error'].'</span>';
                unset($_SESSION['error']);
            }
            ?>

      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      </select>
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="index.php">register now</a></p>
   </form>

</div>


<footer>
            <div class="row">
                <div class="col-md-6" >
                    <p>Copyright &copy; 2024 dreamwearly.co</p>
                </div>
        </footer>

</body>
</html>