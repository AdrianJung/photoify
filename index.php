<?php require __DIR__.'/views/header.php'; ?>
    <?php if (!isset($_SESSION['user'])): ?>
        <?php redirect('/login.php');?>
    <?php endif ;?>
    <?php require __DIR__.'/views/footer.php'; ?>
