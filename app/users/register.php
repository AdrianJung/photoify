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
        $created_at = date("Y-m-d");

        $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
    
        if(!$statement)
        {
            die(var_dump($pdo->errorInfo()));
        }

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user)
        {
        $_SESSION['error'] = 'Username or email already exists';
        redirect('/login.php');
        }
        
        // insert statement
        $statement = $pdo->prepare('INSERT INTO users(first_name, last_name, email, username, password, created_at)
        VALUES (:firstName, :lastName, :email, :userName, :password, :created_at)');

        if (!$statement)
        {
            die(var_dump($pdo->errorInfo()));
        }
        // binds variables to parameteres for insert statement
        $statement->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':userName', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->bindParam(':created_at', $created_at, PDO::PARAM_STR);

        $statement->execute();
        redirect('/login.php');
    }
    $_SESSION['error'] = "Password doesn't match";
    redirect('/login.php');
};
