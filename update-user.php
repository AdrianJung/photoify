<?php require __DIR__.'/views/header.php'; ?>
<h1 class="logo header-logo">Photoify.</h1>
<div class="update-user-page-container">
<?php if (!isset($_SESSION['error'])): ?>
<h5>Update profile image</h5>
<form action="/app/users/profile-image.php" method="POST" enctype="multipart/form-data">
  <div>
    <input type="file" name="profilepic" id="profilepic" type="file" multiple="">
  </div>
  <button type="submit" name="button">Submit</button>
</form>
<h5>Update account information</h5>
<form action="app/users/update-user.php" method="post">
    <label for="firstName">First Name</label>
    <input type="text" name="firstName" value="<?= $_SESSION['user']['name'];?>"required>
    <br>
    <label for="lastName">Last Name</label>
    <input type="text" name="lastName" value="<?= $_SESSION['user']['lastName'];?>"required>
    <br>
    <label for="username">Username</label>
    <input type="text" name="username" value="<?= $_SESSION['user']['username'];?>"required>
    <br>
    <label for="email">Email</label>
    <input type="text" name="email" value="<?= $_SESSION['user']['email'];?>"required>
    <br>
    <label for="password">Password</label>
    <input type="password" name="password" required>
    <br>
    <label for="password">Confirm Password</label>
    <input type="password" name="confirmPassword" required>
    <br>
    <a href="profile.php">
        <button type="submit" >Update</button>
    </a>
</form>
<h5>Delete Account</h5>
<form action="app/users/delete-user.php" method="post">
    <label for="username">Username</label>
    <input class="" type="text" name="username" required>
    <br>
    <label for="password">Password</label>
    <input class="" type="password" name="password" required>
    <br>
    <label for="password">Confirm Password</label>
    <input class="" type="password" name="confirmPassword" required>
    <br>
    <button type="submit" class="delete-account-button">Delete Account</button>
</form>
<?php else:?>
<div class="error-div">
    <p class="error-text">
        <?php echo $_SESSION['error']; ?>
    </p>
</div>
<?php endif; ?>
<?php unset($_SESSION['error']); ?>
</div>

<script src="/assets/scripts/update-user.js"></script>
<?php require __DIR__.'/views/footer.php';?>
