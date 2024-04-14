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
   <title>lecturer</title>

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

   <section class="teachers">

      <h1 class="heading">expert lecturer</h1>

      <form action="" method="post" class="search-tutor">
         <input type="text" name="search_box" placeholder="search tutors..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_tutor"></button>
      </form>

      <div class="box-container">

         <div class="box offer">
            <h3>Become A Tutor</h3>
            <p>Unlock the opportunity to make a difference and share your knowledge by joining us as a tutor today!</p>
            <a href="BackEnd/admin/register.php" class="inline-btn">get started</a>
         </div>



         <?php
         try {
            // Fetch data from the tutors table
            $query = "SELECT * FROM tutors";
            $statement = $conn->query($query);
            $tutors = $statement->fetchAll(PDO::FETCH_ASSOC);



            foreach ($tutors as $tutor) {

               $tutor_id = $tutor['id']; // Get the tutor ID
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
         ?>
               <div class="box">
                  <div class="tutor">
                     <img src="<?php echo "BackEnd/uploaded_files/" . $tutor['image']; ?>" style="width: fit;; object-fit:cover;" alt="">
                     <div>
                        <h3><?php echo $tutor['name']; ?></h3>
                        <span><?php echo $tutor['profession']; ?></span>
                     </div>
                  </div>
                  <p>total playlists : <span><?php echo count($playlists); ?></span></p>
                  <p>total videos : <span><?php echo count($videos); ?></span></p>
                  <p>total likes : <span><?php echo count($likes); ?></span></p>
                  <a href="teacher_profile.php?tutor_id=<?php echo $tutor['id']; ?>" class="inline-btn">view profile</a>
               </div>
         <?php
            }
         } catch (PDOException $e) {
            // Handle database query errors
            exit('Error fetching data from database: ' . $e->getMessage());
         }
         ?>
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