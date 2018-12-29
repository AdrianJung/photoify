<?php require __DIR__.'/views/header.php'; ?>
<body>
        <h1 class="logo header-logo">Photoify.</h1>
    <form action="app/users/update-password.php" method="post">
          <label for="username">Username</label>
          <input class="" type="text" name="username" required>
          <br>
          <label for="password">Old Password</label>
          <input class="" type="password" name="oldPassword" required>
          <br>
          <label for="password">New Password</label>
          <input class="" type="password" name="newPassword" required>
          <br>
          <a href="profile.php">
              <button type="submit" class="">enter</button>
          </a>
  </form>
 <?php if(isset($_SESSION['error'])):?>
<?= $_SESSION['error']; ?>
<?php endif;?>
</body>
<?php require __DIR__.'/views/footer.php'; ?>
