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
   <title>home</title>

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

   <section class="home-grid">

      <h1 class="heading">quick options</h1>

      <div class="box-container">

         <div class="box">
            <h3 class="title">Become A Tutor</h3>
            <p class="tutor">Join us and become a tutor today!</p>
            <a href="lecturer.php" class="inline-btn">get started</a>
         </div>



         <!-- <div class="box">
            <h3 class="title">top categories</h3>
            <div class="flex">
               <a href="#"><i class="fas fa-code"></i><span>development</span></a>
               <a href="#"><i class="fas fa-palette"></i><span>designer</span></a>
               <a href="#"><i class="fas fa-chart-line"></i><span>supervisor</span></a>
               <a href="#"><i class="fas fa-cog"></i><span>lecturer</span></a>
            </div>
         </div>

         <div class="box">
            <h3 class="title">popular topics</h3>
            <div class="flex">
               <a href="#"><i class="fab fa-html5"></i><span>HTML</span></a>
               <a href="#"><i class="fab fa-css3"></i><span>CSS</span></a>
               <a href="#"><i class="fab fa-js"></i><span>javascript</span></a>
               <a href="#"><i class="fab fa-react"></i><span>react</span></a>
               <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>
               <a href="#"><i class="fab fa-bootstrap"></i><span>bootstrap</span></a>
            </div>
         </div> -->

         <!-- <div class="box">
            <h3 class="title">Become A Tutor</h3>
            <p class="tutor">Join us and become a tutor today!</p>
            <a href="lecturer.php" class="inline-btn">get started</a>
         </div> -->

         <div class=""> </div>
         <div class=""> </div>
         <div class=""> </div>

      </div>

   </section>



   <section class="courses">

      <h1 class="heading">our chapters</h1>

      <div class="box-container">

         <?php
         // Include the database connection script

         // Query to fetch data from the 'tutors', 'playlist', and 'content' tables
         $query = "SELECT tutors.id AS tutor_id, tutors.name AS tutor_name, tutors.image AS tutor_image, 
        playlist.id AS playlist_id, playlist.title AS playlist_desc,playlist.status, playlist.thumb, playlist.date, COUNT(content.id) AS video_count
        FROM tutors
        LEFT JOIN playlist ON tutors.id = playlist.tutor_id
        LEFT JOIN content ON playlist.id = content.playlist_id
        GROUP BY playlist.id, tutors.id, tutors.name, tutors.image, playlist.title, playlist.thumb, playlist.date;";

         try {
            $stmt = $conn->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if any rows are returned
            if ($rows) {
               foreach ($rows as $row) {
                  if ($row['status'] === 'active') {
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
                           <img src="<?php echo 'BackEnd/uploaded_files/' . $row['thumb']; ?>" alt="">
                           <span><?php echo $row['video_count']; ?> videos</span>
                        </div>
                        <h3 class="title"><?php echo $row['playlist_desc']; ?></h3>
                        <a href="playlist.php?playlist_id=<?php echo $row['playlist_id']; ?>" class="inline-btn">view playlist</a>
                     </div>

         <?php
                  }
               }
            } else {
               echo "No content available.";
            }
         } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
         }
         ?>



      </div>

      <div class="more-btn">
         <a href="courses.php" class="inline-option-btn">view all chapters</a>
      </div>

   </section>















   <footer class="footer">

      &copy; copyright @ 2024 by <span>Hanis Syafiqah</span> | all rights reserved!

   </footer>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>


</body>

</html>