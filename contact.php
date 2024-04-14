<?php

include 'connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   header('location:login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Retrieve form data
   $name = $_POST['name'];
   $email = $_POST['email'];
   $number = $_POST['number'];
   $message = $_POST['msg'];

   // Insert the contact information into the database
   $query = "INSERT INTO contact (name, email, number, message) VALUES (:name, :email, :number, :message)";
   $statement = $conn->prepare($query);
   $statement->bindParam(':name', $name);
   $statement->bindParam(':email', $email);
   $statement->bindParam(':number', $number);
   $statement->bindParam(':message', $message);

   if ($statement->execute()) {
      // Contact information successfully saved
      echo "Thank you! Your message has been sent.";
   } else {
      // Failed to save contact information
      echo "An error occurred. Please try again.";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <header class="header">

      <section class="flex">

         <a href="home.html" class="logo">FYP Mastermind Hub</a>

         <form action="search_page.php" method="post" class="search-form">
            <input type="text" name="search_box" required placeholder="search chapters..." maxlength="100">
            <button type="submit" class="fas fa-search"></button>
         </form>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
         </div>

         <?php
         include('profile-component.php')
         ?>

      </section>

   </header>

   <div class="side-bar">

      <div id="close-btn">
         <i class="fas fa-times"></i>
      </div>

      <?php
      include('user-profile.php')
      ?>

      <?php
      include('nav.php')
      ?>

   </div>

   <section class="contact">

   <h1 class="heading">How to use the system ?</h1>

      <div class="row">

         <div class="image">
            <img src="images/Ai hub.png" alt="">
            <img src="images/Courses.png" alt="">
            <img src="images/Lecturer.png" alt="">
         </div>
      </div>

      <div class="box-container">

         <div class="box">
            <i class="fas fa-phone"></i>
            <h3>phone number</h3>
            <a href="tel:0189731023">0189731023</a>
            <a href="tel:+603 9206 9700">+603 9206 9700</a>
            <a href="tel:+603 9283 7186">+603 9283 7186</a>
         </div>

         <div class="box">
            <i class="fas fa-envelope"></i>
            <h3>email address</h3>
            <a href="mailto:syafiqahhanis23@gmail.com">syafiqahhanis23@gmail.com</a>
            <a href="mailto:marketing@uptm.edu.my">marketing@uptm.edu.my</a>
            <a href="mailto:uptm@gmail.com">uptm@gmail.com</a>
         </div>

         <div class="box">
            <i class="fas fa-map-marker-alt"></i>
            <h3>office address</h3>
            <a href="#">Universiti Poly-Tech Malaysia, Jalan 6/91, Taman Shamelin Perkasa, 56100 Cheras, Kuala Lumpur</a>
         </div>

      </div>

   </section>














   <footer class="footer">

      &copy; copyright @ 2024 by <span>Hanis Syafiqah</span> | all rights reserved!

   </footer>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>


</body>

</html>