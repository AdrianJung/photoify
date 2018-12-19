<?php require __DIR__.'/views/header.php'; ?>
    <h1 class="logo header-logo">Photoify.</h1>
<div class="icon">
<div class="hamburger"></div>
</div>
<div class="profile-image-name">
    <div class="profile-image">
    </div>
    <h2><?php echo $_SESSION['user']['username'];?></h2>
</div>
<div class="profile-image-container">
</div>
    <?php require __DIR__.'/views/footer.php'; ?>
