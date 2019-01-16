<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

$data = (getPosts($pdo));

echo json_encode($data);