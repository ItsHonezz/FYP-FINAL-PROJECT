<?php
// Include the database connection script
include 'connect.php';

// Check if the user is logged in
if (!isset($_COOKIE['user_id'])) {
    exit('User not logged in'); // Handle unauthorized access
}

// Get user ID from cookie
$user_id = $_COOKIE['user_id'];

// Retrieve content ID from URL
if (!isset($_GET['content_id'])) {
    exit('Content ID is missing');
}

$content_id = $_GET['content_id'];

// Check if the user has already liked the content
$query = "SELECT * FROM likes WHERE content_id = :content_id AND user_id = :user_id";
$statement = $conn->prepare($query);
$statement->bindParam(':content_id', $content_id);
$statement->bindParam(':user_id', $user_id);
$statement->execute();
$existing_like = $statement->fetch(PDO::FETCH_ASSOC);

if ($existing_like) {
    // User has already liked the content, so unlike it
    $query = "DELETE FROM likes WHERE content_id = :content_id AND user_id = :user_id";
    $action = "unliked";
} else {
    // User hasn't liked the content yet, so like it
    $query = "INSERT INTO likes (content_id, user_id) VALUES (:content_id, :user_id)";
    $action = "liked";
}

// Execute the like/unlike action
$statement = $conn->prepare($query);
$statement->bindParam(':content_id', $content_id);
$statement->bindParam(':user_id', $user_id);
$statement->execute();

// Redirect back to the content page after liking/unliking
header("Location: watch.php?content_id=$content_id&action=$action");
exit();
