<?php require __DIR__.'/views/header.php'; ?>
<article>
    <h1>Login</h1>
    <form action="app/users/login.php" method="post">
          <label for="username">Username</label>
          <input class="" type="text" name="username" placeholder="Username" required>
          <br>
          <label for="password">Password</label>
          <input class="" type="password" name="password" required>
          <br>
      <button type="submit" class="">Login</button>
    </form>
    <?php if (isset($_SESSION['error'])): ?>
        <?php echo $_SESSION['error']; ?>
        <?php endif; ?>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
