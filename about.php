<?php

include 'connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   header('location:login.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about us</title>

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

   <section class="about">

   <h1 class="heading">About</h1>

      <div class="row">

         <div class="image">
            <img src="images/about-img.svg" alt="">
         </div>

         <div class="content">
            <h3>why choose us?</h3>
            <p>The reason for selecting the FYP Mastermind Hub is its ability to fill communication gaps and improve information handling in the Final Year Project (FYP) process at UPTM. The hub centralizes project information and encourages collaboration among students, coordinators, and supervisors to boost efficiency. Its user-friendly interface tailored to FYP stakeholders is expected to transform the FYP process, fostering innovation and technological progress in education.</p>
            <a href="courses.php" class="inline-btn">our courses</a>
         </div>

      </div>

      <div class="box-container">

         <div class="box">
            <i class="fas fa-graduation-cap"></i>
            <div>
               <h3>+10k</h3>
               <p>online courses</p>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-user-graduate"></i>
            <div>
               <h3>+40k</h3>
               <p>brilliant students</p>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-chalkboard-user"></i>
            <div>
               <h3>+2k</h3>
               <p>expert tutors</p>
            </div>
         </div>

         <div class="box">
            <i class="fas fa-briefcase"></i>
            <div>
               <h3>100%</h3>
               <p>job placement</p>
            </div>
         </div>

      </div>

   </section>

   <section class="reviews">

      <h1 class="heading">student's reviews</h1>

      <div class="box-container">

         <div class="box">
            <p>FYP Mastermind Hub revolutionizes the way we approach Final Year Projects. It's a game-changer for students, coordinators, and supervisors alike, offering a seamless platform for collaboration and information sharing.</p>
            <div class="student">
               <img src="images/pic-2.jpg" alt="">
               <div>
                  <h3>Amy</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>This hub has simplified the FYP process tremendously. It's intuitive, easy to navigate, and provides all the resources we need in one place. Highly recommended for anyone embarking on their final year journey. Recommended for FYP students.</p>
            <div class="student">
               <img src="images/pic-3.jpg" alt="">
               <div>
                  <h3>Aliah</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>Being a coordinator, FYP Mastermind Hub has been a crucial tool. It simplifies student communication, monitors project advancement smoothly, and guarantees deadlines are achieved without the typical disorder.</p>
            <div class="student">
               <img src="images/pic-4.jpg" alt="">
               <div>
                  <h3>Wani</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>The interface is clean and user-friendly, making it accessible for all students, regardless of their technical expertise. It's a refreshing change from the outdated systems we've used in the past. Strongly suggested for students undertaking their FYP.</p>
            <div class="student">
               <img src="images/pic-5.jpg" alt="">
               <div>
                  <h3>Anis</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>FYP Mastermind Hub fosters a sense of community among students and facilitates knowledge sharing. It's not just a tool, it's a supportive environment that encourages growth and collaboration. Highly recommended for FYP students.</p>
            <div class="student">
               <img src="images/pic-6.jpg" alt="">
               <div>
                  <h3>Jiha</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="box">
            <p>I've been using the hub for a few weeks now, and I'm impressed by its versatility. Whether I need to submit project proposals, communicate with my supervisor, or access relevant resources, everything is conveniently organized within the hub.</p>
            <div class="student">
               <img src="images/pic-7.jpg" alt="">
               <div>
                  <h3>Aisyah</h3>
                  <div class="stars">
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star"></i>
                     <i class="fas fa-star-half-alt"></i>
                  </div>
               </div>
            </div>
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