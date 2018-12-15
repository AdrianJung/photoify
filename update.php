<?php require __DIR__.'/views/header.php'; ?>
<body>
    <?php if (!isset($_SESSION['message'])): ?>
    <form action="app/users/update.php" method="post">
          <label for="password">Old Password</label>
          <input class="" type="password" name="oldPassword" required>
          <br>
          <label for="password">New Password</label>
          <input class="" type="password" name="newPassword" required>
      <button type="submit" class="">enter</button>
  </form>
<?php else: ?>
<?php echo $_SESSION['message']; ?>
<?php endif; ?>
</body>
<?php require __DIR__.'/views/footer.php'; ?>
