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
    $cookieData = json_encode($posts);
    $cookieName = "posts";
    setcookie($cookieName,$cookieData);
    // return $posts;
}
