<?php
// Include the database connection script
include 'connect.php';

// Check if the user is logged in
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
    exit(); // Ensure script stops execution after redirection
}

// Retrieve content ID from URL
if (isset($_GET['content_id'])) {
    $content_id = $_GET['content_id'];
} else {
    // Handle case where content ID is not provided
    // You can redirect the user or display an error message
    exit('Content ID is missing');
}



try {
    // Fetch content from the database based on content ID
    $query = "SELECT content.*, tutors.* FROM content
              INNER JOIN tutors ON content.tutor_id = tutors.id
              WHERE content.id = :content_id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':content_id', $content_id);
    $statement->execute();

    // Fetch the content
    $content = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$content) {
        // Handle case where content with the specified ID is not found
        exit('Content not found');
    }
} catch (PDOException $e) {
    // Handle database query errors
    exit('Error fetching content from database: ' . $e->getMessage());
}

$query2 = "SELECT * FROM likes WHERE content_id = :content_id";
$statement2 = $conn->prepare($query2);
$statement2->bindParam(':content_id', $content_id);
$statement2->execute();
$likes = $statement2->fetchAll(PDO::FETCH_ASSOC);

$tutor_id = $content['tutor_id'];


// Check if the form is submitted
if (isset($_POST['add_comment'])) {
    // Retrieve comment text from the form data
    $comment_text = $_POST['comment_box'];
    $id = unique_id();

    // Insert the comment into the database
    try {
        $query = "INSERT INTO comments (id, content_id, user_id, tutor_id, comment, date) 
                VALUES (:id, :content_id, :user_id, :tutor_id, :comment_text, NOW())";
        $statement = $conn->prepare($query);
        $statement->bindParam(':content_id', $content_id);
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':tutor_id', $tutor_id);
        $statement->bindParam(':comment_text', $comment_text);
        $statement->execute();

        // Optionally, provide feedback to the user
        echo "Comment added successfully!";
    } catch (PDOException $e) {
        // Handle database query errors
        exit('Error adding comment to database: ' . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>watch</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        .box-meow {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* 3 columns with equal width */
            gap: 20px;
            /* Gap between grid items */
        }

        .file {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .file a {
            text-decoration: none;
            color: #333;
        }
    </style>

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

    <section class="watch-video">


        <div class="video-container">
            <div class="video">

                <?php
                $query = "SELECT * FROM content WHERE id = :content_id";
                $statement = $conn->prepare($query);
                $statement->bindParam(':content_id', $content_id);
                $statement->execute();
                $documents = $statement->fetchAll(PDO::FETCH_ASSOC);

                // Check if any document has non-empty pdf1, doc1, or doc2 fields
                $hasFiles = false;
                foreach ($documents as $document) {
                    if (!empty($document['pdf1']) || !empty($document['doc1']) || !empty($document['doc2'])) {
                        $hasFiles = true;
                        break;
                    }
                }
                ?>

                <?php if ($hasFiles) : ?>
                    <h1 class="heading">Files</h1>
                    <div class="box-container" style="margin-bottom:50px;">
                        <?php foreach ($documents as $key => $document) : ?>
                            <div class="box-meow">
                                <?php if (!empty($document['pdf1'])) : ?>
                                    <div class="file">
                                        <h3 class="heading">File 1</h3>
                                        <a href="<?php echo "BackEnd/uploaded_files/" . $document['pdf1']; ?>" download="<?php echo $document['title'] . '1' . '.pdf'; ?>" class="inline-btn" style="margin-top: 0px; color: white;">Download File <?php echo '1'; ?></a>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($document['doc1'])) : ?>
                                    <div class="file">
                                        <h3 class="heading">File 2</h3>
                                        <a href="<?php echo "BackEnd/uploaded_files/" . $document['doc1']; ?>" download="<?php echo $document['title'] . '2' . '.docx'; ?>" class="inline-btn" style="margin-top: 0px; color: white;">Download File <?php echo '2'; ?></a>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($document['doc2'])) : ?>
                                    <div class="file">
                                        <h3 class="heading">File 3</h3>
                                        <a href="<?php echo "BackEnd/uploaded_files/" . $document['doc2']; ?>" download="<?php echo $document['title'] . '3' . '.doc'; ?>" class="inline-btn" style="margin-top: 0px; color: white;">Download File <?php echo '3'; ?></a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <h3 class="title"><?php echo $content['title']; ?></h3>
                <div class="info">
                    <p class="date"><i class="fas fa-calendar"></i><span><?php echo $content['date']; ?></span></p>
                    <p class="date"><i class="fas fa-heart"></i><span><?php echo count($likes); ?></span></p>
                </div>
                <div class="tutor">
                    <img src="images/pic-2.jpg" alt="">
                    <div>
                        <h3><?php echo $content['name']; ?></h3>
                        <span><?php echo $content['profession']; ?></span>
                    </div>
                </div>

                <?php

                // Check if the user has already liked the content
                $query3 = "SELECT * FROM likes WHERE user_id = :user_id AND content_id = :content_id";
                $statement3 = $conn->prepare($query3);
                $statement3->bindParam(':user_id', $user_id);
                $statement3->bindParam(':content_id', $content_id);
                $statement3->execute();
                $liked = $statement3->fetch(PDO::FETCH_ASSOC);

                if (isset($_POST['like'])) {
                    if (!$liked) {
                        // User has not liked the content, so insert a new like
                        $query4 = "INSERT INTO likes (user_id, tutor_id, content_id) VALUES (:user_id, :tutor_id, :content_id)";
                        $statement4 = $conn->prepare($query4);
                        $statement4->bindParam(':user_id', $user_id);
                        $statement4->bindParam(':tutor_id', $content['tutor_id']);
                        $statement4->bindParam(':content_id', $content_id);
                        $statement4->execute();
                    } else {
                        // User has already liked the content, so remove the like
                        $query5 = "DELETE FROM likes WHERE user_id = :user_id AND content_id = :content_id";
                        $statement5 = $conn->prepare($query5);
                        $statement5->bindParam(':user_id', $user_id);
                        $statement5->bindParam(':content_id', $content_id);
                        $statement5->execute();
                    }
                }



                ?>

                <form id="likeForm" action="" method="post" class="flex">
                    <a href="playlist.php?playlist_id=<?php echo $content['playlist_id']; ?>" class="inline-btn">view playlist</a>
                    <input type="hidden" name="like" value="1">
                    <button type="submit">
                        <?php if ($liked) : ?>
                            <i class="fa-solid fa-heart"></i>
                        <?php else : ?>
                            <i class="far fa-heart"></i>
                        <?php endif; ?>
                        <span><?php echo $liked ? 'unlike' : 'like'; ?></span>
                    </button>
                </form>

                <script>
                    document.getElementById("likeForm").addEventListener("submit", function(event) {
                        event.preventDefault(); // Prevent default form submission

                        fetch(this.action, {
                                method: 'POST',
                                body: new FormData(this),
                                headers: {
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json(); // Assuming the response is JSON
                            })
                            .then(data => {
                                // Reload the page after successful form submission
                                location.reload();
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    });
                </script>

                <p class="description">
                    <?php echo $content['description']; ?>
                </p>
            </div>


    </section>

    <section class="comments">





        <?php
        $query = "SELECT comments.*, users.name, users.image AS image
         FROM comments 
         INNER JOIN users ON comments.user_id = users.id
         WHERE comments.content_id = :content_id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':content_id', $content_id);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
        $commentCount = $statement->rowCount();
        ?>

        <h1 class="heading"><?php echo $commentCount; ?> comments</h1>

        <form action="" method="post" class="add-comment">
            <h3>Add Comment</h3>
            <textarea name="comment_box" placeholder="Enter your comment" required maxlength="1000" cols="30" rows="10"></textarea>
            <input type="submit" value="Add Comment" class="inline-btn" name="add_comment">
        </form>

        <h1 class="heading">user comments</h1>

        <div class="box-container">




            <?php foreach ($comments as $value) : ?>
                <div class="box">
                    <div class="user">
                        <img src="<?php echo "BackEnd/uploaded_files/" . $value['image']; ?>" alt="">
                        <div>
                            <h3><?php echo $value['name']; ?></h3>
                            <span><?php echo $value['date']; ?></span>
                        </div>
                    </div>
                    <div class="comment-box"><?php echo $value['comment']; ?></div>
                </div>
            <?php endforeach ?>



        </div>

    </section>


    <footer class="footer">

        &copy; copyright @ 2024 by <span>Hanis Syafiqah</span> | all rights reserved!

    </footer>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>