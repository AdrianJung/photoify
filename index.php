<?php require __DIR__.'/views/header.php'; ?>
<?php setcookie("userid", strval($_SESSION['user']['id']));?>
    <h1 class="logo header-logo">Photoify</h1>
<?php if (!isset($_SESSION['user'])): ?>
    <?php redirect('/login.php');?>
<?php endif ;?>
<div class="posts-container">
</div>
<iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe>
<script src="assets/scripts/functions.js" charset="utf-8"></script>
<script src="assets/scripts/newposts.js" charset="utf-8"></script>
<?php require __DIR__.'/views/footer.php'; ?>
