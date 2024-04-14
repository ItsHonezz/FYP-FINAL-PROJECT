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
   <title>video playlist</title>

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
            <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
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

   <section class="playlist-details">

      <h1 class="heading">playlist details</h1>

      <?php
      // Include the database connection script

      // Check if the playlist_id is provided in the URL
      if (isset($_GET['playlist_id'])) {
         $playlist_id = $_GET['playlist_id'];

         // Query to fetch the playlist based on the playlist_id
         $query = "SELECT playlist.*, tutors.*
              FROM playlist
              LEFT JOIN tutors ON playlist.tutor_id = tutors.id
              WHERE playlist.id = :playlist_id";

         try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':playlist_id', $playlist_id);
            $stmt->execute();
            $playlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if any playlist items were found
            if ($playlist) {
               foreach ($playlist as $item) {
      ?>

                  <div class="row">
                     <div class="column">

                        <div class="thumb">
                           <img src="<?php echo "BackEnd/uploaded_files/" . $item['thumb']; ?>" alt="">
                        </div>
                     </div>
                     <div class="column">
                        <div class="tutor">
                           <img src="<?php echo "BackEnd/uploaded_files/" . $item['image']; ?>" alt="">
                           <div>
                              <h3><?php echo $item['name']; ?></h3>
                              <span><?php echo $item['date']; ?></span>
                           </div>
                        </div>

                        <div class="details">
                           <h3><?php echo $item['title']; ?></h3>
                           <p><?php echo $item['description']; ?></p>
                           <a href="teacher_profile.php?tutor_id=<?php echo $item['tutor_id']; ?>" class="inline-btn">view profile</a>
                        </div>
                     </div>
                  </div>

      <?php
               }
            } else {
               echo "No playlist items found.";
            }
         } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
         }
      } else {
         // Handle case when playlist_id is not provided in the URL
         echo "No playlist ID provided.";
      }
      ?>





   </section>

   <section class="playlist-videos">

      <h1 class="heading">playlist videos</h1>

      <div class="box-container">

         <?php
         // Include the database connection script

         // Check if the playlist_id is provided in the URL
         if (isset($_GET['playlist_id'])) {
            $playlist_id = $_GET['playlist_id'];

            // Query to fetch data from the 'content' table based on playlist_id
            $query = "SELECT c.id AS content_ID, c.title AS titleContent, c.description, c.video, c.thumb, c.status, c.date, c.pdf1, c.doc1, c.doc2
          FROM content c
          INNER JOIN playlist p ON p.id = c.playlist_id
          WHERE p.id = :playlist_id";


            try {
               $stmt = $conn->prepare($query);
               $stmt->execute([':playlist_id' => $playlist_id]); // Pass parameter directly to execute()
               $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

               // Check if any data is found
               if ($result) {
                  foreach ($result as $row) {
                     if ($row['status'] === 'active') {
         ?>
                        <a class="box" href="<?php echo "watch-video.php?content_id=" .  $row['content_ID']; ?>">
                           <i class="fas fa-play"></i>
                           <img src="<?php echo "BackEnd/uploaded_files/" .  $row['thumb']; ?>" alt="">
                           <h3><?php echo $row['titleContent']; ?></h3>
                        </a>
         <?php
                     }
                  }
               } else {
                  echo "No data found for the provided playlist ID.";
               }
            } catch (PDOException $e) {
               echo "Error: " . $e->getMessage();
            }
         } else {
            // Handle case when playlist_id is not provided in the URL
            echo "No playlist ID provided.";
         }
         ?>



      </div>
   </section>
   <section class="playlist-videos">

      <h1 class="heading">playlist Files</h1>
      <div class="box-container">
         <?php
         $hasFiles = false;
         foreach ($result as $document) {
            if (!empty($document['pdf1']) || !empty($document['doc1']) || !empty($document['doc2'])) {
               $hasFiles = true;
               break;
            }
         }
         ?>

         <?php if ($hasFiles) : ?>
                           
               <div class="box-container">
                  <?php foreach ($result as $item) : ?>
                     <?php if ($item['status'] === 'active') : ?>
                        <?php if (!empty($item['pdf1']) || !empty($item['doc1']) || !empty($item['doc2'])) : ?>
                           <a class="box" href="<?php echo "document.php?content_id=" .  $item['content_ID']; ?>">
                              <i class="fas fa-file"></i>
                              <img src="uploaded_files/image.png" alt="">
                              <h3><?php echo $item['titleContent']; ?></h3>
                           </a>
                        <?php endif; ?>
                     <?php endif; ?>
                  <?php endforeach; ?>
               </div>            
         <?php endif; ?>


   </section>













   <footer class="footer">

      &copy; copyright @ 2024 by <span>Hanis Syafiqah</span> | all rights reserved!

   </footer>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>


</body>

</html>