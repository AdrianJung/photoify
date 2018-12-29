<?php require __DIR__.'/views/header.php'; ?>
    <h1 class="logo header-logo">Photoify.</h1>
<?php if (!isset($_SESSION['user'])): ?>
    <?php redirect('/login.php');?>
<?php endif ;?>
<div class="post-box">
    <div class="post-header">
        <img src="images/default_profile.jpg" class="post-user-image" alt="">
        <h6>username</h6>
    </div>
    <img class="post-image" src="images/default_profile.jpg" alt="">
    <div class="post-description">
        <h5>Title</h5>
            <h6>Likes:</h6>
        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
        </p>
    </div>
</div>
<script src="assets/scripts/posts.js" charset="utf-8"></script>
<?php require __DIR__.'/views/footer.php'; ?>
