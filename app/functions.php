<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
    * Redirect the user to given path.
    *
    * @param string $path
    *
    * @return void
    */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

function rrmdir($path) {
    // Open the source directory to read in files
       $i = new DirectoryIterator($path);
       foreach($i as $f) {
           if($f->isFile()) {
               unlink($f->getRealPath());
           } else if(!$f->isDot() && $f->isDir()) {
               rrmdir($f->getRealPath());
           }
       }
       rmdir($path);
}

function getPosts($pdo) {
    $statement = $pdo->prepare("SELECT posts.*, users.username, users.id, users.avatar, users.created_at, likes.has_liked FROM posts 
        LEFT JOIN likes ON posts.post_id = likes.post_id AND likes.user_id = :user_id
        INNER JOIN users ON posts.user_id = users.id
        WHERE users.id = posts.user_id
        ORDER BY timestamp desc");
    $statement->bindParam(':user_id', $_SESSION['user']['id']);
    $statement->execute();
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $statement = $pdo->prepare("SELECT posts.post_id, comments.id, comments.post_id, comments.user_id, comments.content, comments.author FROM posts, comments WHERE comments.post_id = posts.post_id");
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($posts as &$post)
    {
        
        $post['comments'] = array_filter($comments, function ($comment) use ($post) {
            
            return $comment['post_id'] === $post['post_id'];
            
        });

        $post['comments'] = array_values($post['comments']);
        
    }
    return $posts;
};
