<?php require __DIR__.'/views/header.php'; ?>
    <h1 class="logo header-logo">Photoify.</h1>
    <h4>profile image</h4>
    <?php if(isset($_SESSION['error'])): ?>
    <div class="error-div">
            <p class="error-text">
                <?php echo $_SESSION['error']; ?>
            </p>
        </div>
    <?php endif;?>
<form class="" action="/app/users/profile-image.php" method="POST" enctype="multipart/form-data">
  <div class="">
    <input type="file" name="profilepic" id="profilepic" type="file" multiple="">
  </div>
  <button type="submit" name="button">Submit</button>
</form>
<h4>account information</h4>
<form action="app/users/update-user.php" method="post">
    <label for="firstName">First Name</label>
    <input class="" type="text" name="firstName" value="<?= $_SESSION['user']['name'];?>"required>
    <br>
    <label for="lastName">Last Name</label>
    <input class="" type="text" name="lastName" value="<?= $_SESSION['user']['lastName'];?>"required>
    <br>
    <label for="username">Username</label>
    <input class="" type="text" name="username" value="<?= $_SESSION['user']['username'];?>"required>
    <br>
    <label for="email">Email</label>
    <input class="" type="text" name="email" value="<?= $_SESSION['user']['email'];?>"required>
    <br>
    <label for="password">Password</label>
    <input class="" type="password" name="password" required>
    <br>
    <label for="password">Confirm Password</label>
    <input class="" type="password" name="confirmPassword" required>
    <br>
    <a href="profile.php">
        <button type="submit" class="">Update</button>
    </a>
</form>
<h4>Delete Account</h4>
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
<?php if(isset($_SESSION['error'])):?>
<?= $_SESSION['error']; ?>
<?php endif;?>
<script src="/assets/scripts/update-user.js"></script>
<?php require __DIR__.'/views/footer.php';?>
