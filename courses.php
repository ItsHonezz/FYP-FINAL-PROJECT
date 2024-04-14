<?php

include 'connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>courses</title>

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

   <section class="courses">

      <h1 class="heading">our chapters</h1>

      <div class="box-container">



         <?php
         $query = "SELECT c.*, p.title, t.name as tutor_name, t.image as tutor_image, c.title AS content_title, c.id AS content_id
          FROM content c
          INNER JOIN playlist p ON c.playlist_id = p.id
          INNER JOIN tutors t ON c.tutor_id = t.id
          WHERE c.status = 'active' AND p.status = 'active'";

         try {
            $stmt = $conn->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if any rows are returned
            if ($rows) {
               foreach ($rows as $row) {
         ?>
                  <div class="box">
                     <div class="tutor">
                        <img src="<?php echo "BackEnd/uploaded_files/" . $row['tutor_image']; ?>" alt="">
                        <div class="info">
                           <h3><?php echo $row['tutor_name']; ?></h3>
                           <span><?php echo $row['date']; ?></span>
                        </div>
                     </div>
                     <div class="thumb">
                        <img src="<?php echo "BackEnd/uploaded_files/" .  $row['thumb']; ?>" alt="">
                        <span><?php echo $row['title']; ?></span>
                     </div>
                     <!-- <?php "BackEnd/uploaded_files/" . $row['video']; ?> -->
                     <h3 class="title"><?php echo $row['content_title']; ?></h3>
                     <a href="watch-video.php?content_id=<?php echo $row['content_id']; ?>" class="inline-btn">Watch Video</a>
                  </div>
         <?php
               }
            }
         } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
         }
         ?>


      </div>

   </section>














   <footer class="footer">

      &copy; copyright @ 2024 by <span>Hanis Syafiqah</span> | all rights reserved!

   </footer>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>


</body>

</html>