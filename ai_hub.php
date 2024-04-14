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
   <title>About Us</title>

   <!-- Font Awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="css/style2.css">

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
   <div class="row">
      <div class="content">
        <h1 class="heading">AI Hub</h1>
         <div class="chat-container">
            <div class="chat-box" id="chat-box"></div>
            <input type="text" id="user-input" placeholder="Type your message...">
            <button onclick="sendMessage()">Send</button>
         </div>
      </div>
   </div>
</section>

<footer class="footer">
   &copy; Copyright @ 2024 by <span>Hanis Syafiqah</span> | All rights reserved!
</footer>
   
<!-- External JavaScript file for chat functionality -->
<script>
// Existing JavaScript code

const chatBox = document.getElementById('chat-box');
const userInput = document.getElementById('user-input');

const responses = {
    "what is your name?": "I am a FYP Mastermind Hub.",
    "how are you?": "I'm just a program, so I don't have feelings, but I'm functioning well, thank you!",
    "what can you do?": "I can answer questions and engage in conversation based on predefined responses.",
    "when i have to submit for softcopy submission?": "FRIDAY (14/4/2024), WEEK 14 before 5 p.m. ( Late submission will NOT be marked!). Also, Contact your supervisor and examiner once you have submitted.",
    "submit to who?": "Supervisor (email and FYPMS), Examiner (email and FYPMS), Coordinator (LMS and FYPMS).",
    "when i have to submit for hardcopy submission?": "ONE Hardcopy report must be submitted to the faculty before or an : 26/4/2024. Also, Contact your supervisor and examiner once you have submitted.",
    "what should i put in my slide?": "Introduction, Problem Statement, Project Objectives, Literature Review, Requirement Data Gathering, Methodology, Testing and Result, Future Works, and Conclusion.",
    "can i share documents and resources with my team members?": "Yes, you can upload and share documents, references, and updates with your team members in the Courses section.",
    "how can i communicate with my supervisor?": "Use the chat or messaging feature available within the platform to communicate with your assigned supervisor.",
    "default": "I'm not sure how to respond to that.",
};

function sendMessage() {
    const userMessage = userInput.value.toLowerCase(); // Convert to lowercase
    displayMessage(userMessage, true);
    const response = getResponse(userMessage);
    displayMessage(response, false);
    userInput.value = '';
}

function getResponse(message) {
    return responses[message] || responses["Default"];
}

function displayMessage(message, isUser) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('message');
    messageElement.classList.add(isUser ? 'user-message' : 'bot-messages');
    messageElement.innerText = message;
    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

// New JavaScript code

let toggleBtn = document.getElementById('toggle-btn');
let body = document.body;
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () =>{
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}

toggleBtn.onclick = (e) =>{
   darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enableDarkMode();
   }else{
      disableDarkMode();
   }
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   search.classList.remove('active');
}

let search = document.querySelector('.header .flex .search-form');

document.querySelector('#search-btn').onclick = () =>{
   search.classList.toggle('active');
   profile.classList.remove('active');
}

let sideBar = document.querySelector('.side-bar');

document.querySelector('#menu-btn').onclick = () =>{
   sideBar.classList.toggle('active');
   body.classList.toggle('active');
}

document.querySelector('#close-btn').onclick = () =>{
   sideBar.classList.remove('active');
   body.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   search.classList.remove('active');

   if(window.innerWidth < 1200){
      sideBar.classList.remove('active');
      body.classList.remove('active');
   }
}
</script>

</body>
</html>
