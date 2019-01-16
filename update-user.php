<?php require __DIR__.'/views/header.php'; ?>
<h1 class="logo header-logo">Photoify.</h1>
<div class="update-user-page-container">
<?php if (!isset($_SESSION['error'])): ?>
<div class="icon">
        <div class="hamburger"></div>
    </div>
    <div id="simple-modal" class="modal">
        <div class="modal-content">
            <a href="profile.php">
            <p class="text-item text-1">Profile</p>
            </a>
            <a href="update-user.php">
                <p class="text-item text-2">Account Settings</p>
            </a>
            <a href="/app/users/logout.php">
                <p class="text-item text-3">Logout</p>
            </a>
        </div>
    </div>
<form class="update-form" action="/app/users/profile-image.php" method="POST" enctype="multipart/form-data">
<h5>Choose profile image</h5>
  <div>
    <input type="file" name="profilepic" id="profilepic" type="file" multiple="">
  </div>
  <button class="default-button" type="submit" name="button">Submit</button>
</form>
<form action="app/users/update-user.php" method="post">
<h5>Update account information</h5>
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
        <button class="default-button" type="submit" >Update</button>
    </a>
</form>
<form class="update-form" action="app/users/update-password.php" method="post">
<h5>Update password</h5>
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
              <button class="default-button" type="submit" class="">Update</button>
          </a>
  </form>
<form action="app/users/delete-user.php" method="post">
<h5>Delete account</h5>
    <label for="username">Username</label>
    <input class="" type="text" name="username" required>
    <br>
    <label for="password">Password</label>
    <input class="" type="password" name="password" required>
    <br>
    <label for="password">Confirm Password</label>
    <input class="" type="password" name="confirmPassword" required>
    <br>
    <button class="default-button" type="submit" class="delete-account-button">Delete</button>
</form>
<?php else:?>
<div class="error-div">
    <p class="error-text">
        <?php echo $_SESSION['error']; ?>
        <?php echo $_SESSION['message']; ?>
    </p>
</div>
<?php endif; ?>
<?php unset($_SESSION['error']); ?>
</div>
<script src="/assets/scripts/update-user.js"></script>
<script src="/assets/scripts/burgermenu.js"></script>
<?php require __DIR__.'/views/footer.php';?>
