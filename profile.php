<?php require __DIR__.'/views/header.php'; ?>
    <h1 class="logo header-logo">Photoify</h1>
    <div class="icon">
        <div class="hamburger"></div>
    </div>
    <div id="simple-modal" class="modal">
        <div class="modal-content">
            <a href="update-user.php">
            <p class="text-item text-1">Profile Settings</p>
            <a href="update-password.php">
                <p class="text-item text-2">Change password</p>
            </a>
            <a href="/app/users/logout.php">
                <p class="text-item text-3">Logout</p>
            </a>
        </div>
    </div>
    <?php if (isset($_SESSION['message'])):?>
        <h3><?=$_SESSION['message'];?></h3>
    <?php endif;?>
    <div class="profile-image-name">
        <img class="profile-image"src="<?= $_SESSION['user']['avatar']?>" alt="">
    <h1> <?=$_SESSION['user']['username'];?></h1>
</div>
<div class="posts-container">
</div>
<div class="profile-image-container" id="#profilecontainer">
</div>
<iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe>
<?php require __DIR__.'/views/footer.php'; ?>
<script src="/assets/scripts/profile.js"></script>
<script src="/assets/scripts/newposts.js"></script>

