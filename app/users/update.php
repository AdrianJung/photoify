<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// checks if the user data is posted
if (isset($_POST['newPassword'], $_POST['oldPassword']))
{
    // checks if passwords match
    if ($_POST['newPassword'] != $_POST['oldPassword'])
    {
    $oldPassword = $_POST['oldPassword'];

    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

    $id = $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT password FROM users WHERE id = :id');

    $statement->bindParam(':id', $id, PDO::PARAM_STR);

    $statement->execute();

    $password = $statement->fetch(PDO::FETCH_ASSOC);


    if (password_verify($oldPassword, $password['password'])) {

        $statement = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');

        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        $statement->bindParam(':password', $newPassword, PDO::PARAM_STR);

        $statement->execute();

        $_SESSION['message'] = "Password successfully changed!";
    }

    redirect('/update.php');
    }
};
