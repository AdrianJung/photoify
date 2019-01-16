<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['description'])) {

    $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);

    $postId = $_COOKIE['update'];

    $statement = $pdo->prepare('UPDATE posts SET description = :description WHERE post_id = :post_id');
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    
    $statement->execute();
    
        if (!$statement)
        {
            die(var_dump($pdo->errorInfo()));
        };

}

if (isset($_POST['deletePost'])) {
    
    $postId = $_COOKIE['delete'];

    $statement = $pdo->prepare('DELETE FROM posts WHERE post_id = :post_id');

    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);

    $statement->execute();

    if (!$statement)
    {
        die(var_dump($pdo->errorInfo()));
    };
};


