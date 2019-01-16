<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// checks if the user data is posted
if (isset($_POST['newPassword'], $_POST['oldPassword'], $_POST['username']))
{
    // checks if passwords match
    if ($_POST['newPassword'] != $_POST['oldPassword'])
    {
        $oldPassword = $_POST['oldPassword'];
        $username = $_POST['username'];
        $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
        $id = $_SESSION['user']['id'];
        $statement = $pdo->prepare('SELECT password,username FROM users WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($oldPassword, $user['password']) && $username === $user['username']) {

            $statement = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');

            $statement->bindParam(':id', $id, PDO::PARAM_STR);

            $statement->bindParam(':password', $newPassword, PDO::PARAM_STR);

            $statement->execute();
            $_SESSION['message'] = "Password successfully changed!";

            redirect('/profile.php');

        }
    }

    $_SESSION['error'] = "wrong password!";

    redirect('/update.php');
    
};
