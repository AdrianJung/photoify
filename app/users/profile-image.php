<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';
if (isset($_FILES['profilepic'])) {
    $image = ($_FILES['profilepic']) ? $_FILES['profilepic'] : $user['avatar'];

    $username = $_SESSION['user']['username'];

    if (!file_exists(__DIR__ .'/../uploads/' . $_SESSION['user']['id'] . '/profile_pictures/'))
    {
        mkdir(__DIR__ .'/../uploads/' . $_SESSION['user']['id'] . '/profile_pictures/', 0777, true);
    }

    $destination = '/../uploads/' . $_SESSION['user']['id'] . '/profile_pictures/' . time() . '-' . $image['name'];

    move_uploaded_file($image['tmp_name'], __DIR__.$destination);

    $destination = '/app/uploads/' . $_SESSION['user']['id'] . '/profile_pictures/' . time() . '-' . $image['name'];

    $statement = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':avatar', $destination, PDO::PARAM_STR);
    $statement->execute();
    
    $statement = $pdo->prepare('SELECT avatar FROM users WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user']['avatar'] = $user['avatar'];
};

redirect('/profile.php');
