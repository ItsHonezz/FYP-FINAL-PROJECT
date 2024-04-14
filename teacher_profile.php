<?php

include 'connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   header('location:login.php');
}

if (isset($_GET['tutor_id'])) {
   $tutor_id = $_GET['tutor_id'];
} else {
   // Handle case where content ID is not provided
   // You can redirect the user or display an error message
   exit('Content ID is missing');
}

$query = "SELECT * FROM tutors WHERE id = '$tutor_id' ";
$statement = $conn->query($query);
$tutors = $statement->fetch(PDO::FETCH_ASSOC);

$tutor_id = $tutors['id']; // Get the tutor ID
$query2 = "SELECT * FROM likes WHERE tutor_id = :tutor_id";
$statement2 = $conn->prepare($query2);
$statement2->bindParam(':tutor_id', $tutor_id);
$statement2->execute();
$likes = $statement2->fetchAll(PDO::FETCH_ASSOC);

$query_playlists = "SELECT * FROM playlist WHERE tutor_id = :tutor_id";
$statement_playlists = $conn->prepare($query_playlists);
$statement_playlists->bindParam(':tutor_id', $tutor_id);
$statement_playlists->execute();
$playlists = $statement_playlists->fetchAll(PDO::FETCH_ASSOC);

// Fetch videos for each tutor
$query_videos = "SELECT * FROM content WHERE tutor_id = :tutor_id";
$statement_videos = $conn->prepare($query_videos);
$statement_videos->bindParam(':tutor_id', $tutor_id);
$statement_videos->execute();
$videos = $statement_videos->fetchAll(PDO::FETCH_ASSOC);

$query_comments = "SELECT * FROM comments WHERE tutor_id = :tutor_id";
$statement_comment = $conn->prepare($query_comments);
$statement_comment->bindParam(':tutor_id', $tutor_id);
$statement_comment->execute();
$comments = $statement_comment->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tutor profile</title>

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

   <section class="teacher-profile">

      <h1 class="heading">profile details</h1>

      <div class="details">
         <div class="tutor">
            <img src="<?php echo "BackEnd/uploaded_files/" . $tutors['image']; ?>" alt="">
            <h3><?php echo $tutors['name']; ?></h3>
            <span><?php echo $tutors['profession']; ?></span>
         </div>
         <div class="flex">
            <p>total playlists : <span><?php echo count($playlists); ?></span></p>
            <p>total videos : <span><?php echo count($videos); ?></span></p>
            <p>total likes : <span><?php echo count($likes); ?></span></p>
            <p>total comments : <span><?php echo count($comments); ?></span></p>
         </div>
      </div>

   </section>

   <section class="courses">

      <h1 class="heading">our chapters</h1>

      <div class="box-container">

         <?php
         // Include the database connection script


         // Query to fetch data from the 'tutors', 'playlist', and 'content' tables
         $query = "SELECT tutors.id AS tutor_id, tutors.name AS tutor_name, tutors.image AS tutor_image, playlist.id AS playlist_id, 
                 playlist.title AS playlist_desc, playlist.thumb, playlist.date, COUNT(content.id) AS video_count
          FROM tutors 
          LEFT JOIN playlist ON tutors.id = playlist.tutor_id
          LEFT JOIN content ON playlist.id = content.playlist_id
          WHERE tutors.id = '$tutor_id'
          GROUP BY playlist.id, tutors.id, tutors.name, tutors.image, playlist.title, playlist.thumb, playlist.date";


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
                        <img src="<?php echo 'BackEnd/uploaded_files/' . $row['thumb']; ?>" alt="">
                        <span><?php echo $row['video_count']; ?> videos</span>
                     </div>
                     <h3 class="title"><?php echo $row['playlist_desc']; ?></h3>
                     <a href="playlist.php?playlist_id=<?php echo $row['playlist_id']; ?>" class="inline-btn">view playlist</a>
                  </div>

         <?php
               }
            } else {
               echo "No content available.";
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