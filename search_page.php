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

   <section class="courses">

<h1 class="heading">Contents</h1>

<div class="box-container">

    <?php
    if (isset($_POST['search_box'])) {
        $search_query = $_POST['search_box'];
        // Prepare the query to search for content based on title
        $content_query = "SELECT t.*, c.id AS content_id, c.title AS content_title, c.description, c.video, c.thumb, c.status, c.date, p.title AS playlist_title
                    FROM tutors t 
                    INNER JOIN content c ON t.id = c.tutor_id
                    LEFT JOIN playlist p ON c.playlist_id = p.id
                    WHERE c.title LIKE :search_query";

        $search_contents = $conn->prepare($content_query);
        $search_contents->execute(array(':search_query' => "%$search_query%"));

        if ($search_contents->rowCount() > 0) {
            while ($row = $search_contents->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <div class="box">
                    <div class="tutor">
                        <img src="<?php echo "BackEnd/uploaded_files/" . $row['image']; ?>" alt="">
                        <div class="info">
                            <h3><?php echo $row['name']; ?></h3>
                            <span><?php echo $row['date']; ?></span>
                        </div>
                    </div>
                    <div class="thumb">
                        <img src="<?php echo "BackEnd/uploaded_files/" . $row['thumb']; ?>" alt="">
                        <span><?php echo $row['playlist_title']; ?></span>
                    </div>
                    <h3 class="title"><?php echo $row['content_title']; ?></h3>
                    <a href="watch-video.php?content_id=<?php echo $row['content_id']; ?>" class="inline-btn">Watch Video</a>
                </div>
                <?php
            }
        } else {
            echo '<p>No contents found!</p>';
        }
    } else {
        echo '<p>Please enter a search query!</p>';
    }
    ?>

</div>

</section>

<section class="courses">

<h1 class="heading">Playlists</h1>

<div class="box-container">

    <?php
    if (isset($_POST['search_box'])) {
        $search_query = $_POST['search_box'];
        // Prepare the query to search for playlists based on title
        $playlist_query = "SELECT t.*, p.id AS playlist_id, p.title AS playlist_title, p.date AS playlist_date, p.thumb
                    FROM tutors t 
                    INNER JOIN playlist p ON t.id = p.tutor_id
                    WHERE p.title LIKE :search_query";

        $search_playlists = $conn->prepare($playlist_query);
        $search_playlists->execute(array(':search_query' => "%$search_query%"));

        if ($search_playlists->rowCount() > 0) {
            while ($row = $search_playlists->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <div class="box">
                    <div class="tutor">
                        <img src="<?php echo "BackEnd/uploaded_files/" . $row['image']; ?>" alt="">
                        <div class="info">
                            <h3><?php echo $row['name']; ?></h3>
                            <span><?php echo $row['playlist_date']; ?></span>
                        </div>
                    </div>
                    <div class="thumb">
                        <!-- Place appropriate thumbnail for playlist -->
                        <img src="<?php echo "BackEnd/uploaded_files/" . $row['thumb']; ?>" alt="">
                    </div>
                    <h3 class="title"><?php echo $row['playlist_title']; ?></h3>
                    <a href="playlist.php?playlist_id=<?php echo $row['playlist_id']; ?>" class="inline-btn">View Playlist</a>
                </div>
                <?php
            }
        } else {
            echo '<p>No playlists found!</p>';
        }
    } else {
        echo '<p>Please enter a search query!</p>';
    }
    ?>

</div>

</section>





   <footer class="footer">

      &copy; copyright @ 2024 by <span>Hanis Syafiqah</span> | all rights reserved!

   </footer>

   <!-- custom js file link  -->

</body>

</html>