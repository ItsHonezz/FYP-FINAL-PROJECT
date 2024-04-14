<?php

include 'connect.php';
session_start();

if (isset($_POST['submit'])) {

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if ($select_user->rowCount() > 0) {
      setcookie('user_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
      header('Location: home.php');
   } else {
      $message[] = 'incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body style="padding-left: 0; margin-top:100px;">

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message form">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

<style>
  .center {
    text-align: center;
  }
</style>

   <section class="form-container">

      <form action="" method="post" enctype="multipart/form-data" class="login">
         <h3>welcome back!</h3>
         <p>your email <span>*</span></p>
         <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
         <p>your password <span>*</span></p>
         <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
         <div class="center">
            <p class="link">Don't have an account? <a href="register.php">Register now</a></p>
            <p class="link">Sign in as <a href="BackEnd/admin/login.php">Admin</a></p>
         </div>
         <input type="submit" name="submit" value="login now" class="btn">
      </form>

   </section>


   <!-- custom js file link  -->
   <script src="js/script.js"></script>


</body>

</html>