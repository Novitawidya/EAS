<?php

@include 'confirm.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO users(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <style>
        body {
            background-color: #f0f0f0;
        }
        .form-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            padding-bottom: 60px;
            background: #eee;
        }
        .form-container form {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0,0,0.1);
            background-color: #fff;
            text-align: center;
            width: 500px;
        }
        .form-container form h3 {
            font-size: 30px;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: #333;
        }
        .form-container form input,
        .form-container form select {
            width: 95%;
            padding: 10px 15px;
            font-size: 17px;
            margin: 8px 0;
            color: black;
            border-radius: 5px;
        }
        .form-container form select option {
            background: #fff;
        }
        .form-container form .form-btn {
            background: #fbd0d9;
            color: crimson;
            text-transform: capitalize;
            font-size: 20px;
        }
        .form-container form .form-btn:hover {
            background: crimson;
            color: #fff;
        }
        .form-container form p {
            margin-top: 10px;
            font-size: 20px;
        }
        .form-container form a {
            margin-top: 10px;
            font-size: 20px;
            color: crimson;
        }
        .form-container form .error-msg {
            margin: 10px 0;
            background: crimson;
            color: #fff;
            border-radius: 5px;
            font-size: 20px;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

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
