<?php

include 'connect.php';

if (isset($_POST['submit'])) {

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['c_pass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id() . '.' . $ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'BackEnd/uploaded_files/' . $rename;

   $select_tutor = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_tutor->execute([$email]);

   if ($select_tutor->rowCount() > 0) {
      $message[] = 'email already taken!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'confirm passowrd not matched!';
      } else {
         $insert_tutor = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
         $insert_tutor->execute([$id, $name, $email, $cpass, $rename]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new user registered! please login now';
         header('Location: login.php');
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body style="padding-left: 0;">

   <section class="form-container">

      <form action="" method="post" enctype="multipart/form-data">
         <h3>register now</h3>
         <p>your name <span>*</span></p>
         <input type="text" name="name" placeholder="enter your name" required maxlength="50" class="box">
         <p>your email <span>*</span></p>
         <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
         <p>your password <span>*</span></p>
         <input type="password" name="pass" placeholder="enter your password" required maxlength="20" class="box">
         <p>confirm password <span>*</span></p>
         <input type="password" name="c_pass" placeholder="confirm your password" required maxlength="20" class="box">
         <p>select profile <span>*</span></p>
         <input type="file" name="image" accept="image/*" required class="box">
         <input type="submit" value="register new" name="submit" class="btn">
      </form>

   </section>


   <!-- custom js file link  -->
   <script src="js/script.js"></script>


</body>

</html>