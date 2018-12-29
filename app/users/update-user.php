<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// checks if the user data is posted
if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword']))
{
    // checks if passwords match
    if ($_POST['password'] === $_POST['confirmPassword'])
    {
        // sanitizes and saves posted data to variables
        $firstName = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_STRING);
        $lastName = filter_var(trim($_POST['lastName']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $updated_at = date("Y-m-d");

        $id = $_SESSION['user']['id'];

        $statement = $pdo->prepare('UPDATE users SET first_name = :firstName, last_name = :lastName, email = :email, username = :username, password = :password, updated_at = :updated_at WHERE id = :id');


        if (!$statement)
        {
            die(var_dump($pdo->errorInfo()));
        }
        // binds variables to parameteres for insert statement
        $statement->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);

        $statement->execute();

    }
};
redirect('logout.php');
