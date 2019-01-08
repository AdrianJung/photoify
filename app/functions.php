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

function getPosts($pdo) {
    $statement = $pdo->prepare("SELECT * FROM posts, users WHERE users.id = posts.user_id ORDER BY timestamp DESC");
    $statement->execute();
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $statement = $pdo->prepare("SELECT posts.post_id, comments.id, comments.post_id, comments.user_id, comments.content FROM posts, comments WHERE comments.post_id = posts.post_id");
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    
    foreach ($posts as &$post) {
        
        $post['comments'] = array_filter($comments, function ($comment) use ($post) {
            
            return $comment['post_id'] === $post['post_id'];
            
        });

        $post['comments'] = array_values($post['comments']);
        
    }
    return $posts;
};
