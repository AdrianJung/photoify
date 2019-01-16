<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// checks if the user data is posted
if (isset($_POST['newPassword'], $_POST['oldPassword'], $_POST['username']))
{
    // checks that password does not match
    if ($_POST['newPassword'] != $_POST['oldPassword'])
    {
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        // fetches user information from db if username exists
        $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $users = $statement->fetch(PDO::FETCH_ASSOC);
        
        if (!$users)
        {   
            $_SESSION['error'] = "User does not exist";
            redirect('/../update-user.php');
        }
        
        $oldPassword = $_POST['oldPassword'];
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

    redirect('/update-user.php');

};
