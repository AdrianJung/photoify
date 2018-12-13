<?php require __DIR__.'/views/header.php'; ?>
<body>
    <form action="app/users/update.php" method="post">
          <label for="password">New Password</label>
          <input class="" type="password" name="newPassword" required>
          <br>
          <label for="password">Old Password</label>
          <input class="" type="password" name="oldPassword" required>
      <button type="submit" class="">enter</button>
  </form>
</body>
<?php require __DIR__.'/views/footer.php'; ?>
