

<?php

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   header('location:login.php');
   exit();
}


$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
if ($select_profile->rowCount() > 0) {
    $user = $select_profile->fetch(PDO::FETCH_ASSOC);
?>

    <div class="profile">
        <img src="<?php echo "BackEnd/uploaded_files/" . $user['image']; ?>" style="width: fit;; object-fit:cover;" class="image" alt=""> <!-- Accessing image directly from $user -->
        <h3 class="name"><?php echo $user['name']; ?></h3>
        <p class="role">student</p>
        <a href="profile.php" class="btn">view profile</a>
    </div>

<?php
} else {
}
?>