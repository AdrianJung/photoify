<?php

declare(strict_types=1);


require __DIR__.'/../autoload.php';

if(isset($_POST['username'], $_POST['password'], $_POST['confirmPassword'])){

    if ($_POST['password'] === $_POST['confirmPassword'])
    {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
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
        
        $userId = $users['id'];
        $dbPassword = $users['password'];
    
        // checks if given password is equal to password in db
        if (password_verify($password, $dbPassword))
        {
            $statement = $pdo->prepare('DELETE FROM users WHERE id = :user_id');
            $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $statement->execute();

            redirect('/app/users/logout.php');
        }
    
    }
    $_SESSION['error'] = "Wrong Credentials!";

   redirect('/../update-user.php');
    
}