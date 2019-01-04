<?php require __DIR__.'/views/header.php'; ?>
    <h1 class="logo header-logo">Photoify.</h1>
<?php if (!isset($_SESSION['user'])): ?>
    <?php redirect('/login.php');?>
<?php endif ;?>
<div class="post-box">
    <?php getPosts($pdo);?>
</div>
<script src="assets/scripts/functions.js" charset="utf-8"></script>
<script src="assets/scripts/posts.js" charset="utf-8"></script>
<?php require __DIR__.'/views/footer.php'; ?>
