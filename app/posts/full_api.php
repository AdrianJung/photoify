<?php
declare(strict_types=1);


require __DIR__.'/../autoload.php';

$posts = (getPosts($pdo));

$data = $posts;
echo json_encode($data);