<?php require __DIR__.'/views/header.php'; ?>
<div class="background">
<div class="login-container">
        <h1 class="logo">Photoify.</h1>
        <?php if (!isset($_SESSION['user'])): ?>
        <div class="sign">
            <h3 class="sign-in">sign in</h3>
            <h3 class="sign-up">sign up</h3>
        </div>
        <div class="input-box">
        <form action="app/users/login.php" class="loginform" method="post">
            <i class="fas fa-user svg"></i>
              <input class="input input-first" type="text" name="username" placeholder="Username" required>
              <hr>
              <i class="fas fa-lock svg"></i>
              <input class="input input-second" type="password" name="password" placeholder="Password" required>
              <hr>
              <button type="submit" class="button submitbutton">enter</button>
          </form>
              <form action="app/users/register.php" class="registerform" method="post">
              <i class="fas fa-user svg"></i>
              <input class="input input-second" type="text" name="firstName" placeholder="First Name" required>
              <hr>
              <i class="fas fa-user svg"></i>
              <input class="input input-second" type="text" name="lastName" placeholder="Last Name" required>
              <hr>
              <i class="fas fa-user svg"></i>
              <input class="input input-second" type="text" name="username" placeholder="Username" required>
              <hr>
              <i class="fas fa-envelope svg"></i>
              <input class="input input-second" type="email" name="email" placeholder="Email" required>
              <hr>
              <i class="fas fa-lock svg lock-svg"></i>
              <input class="input input-second" type="password" name="password" placeholder="Password" required>
              <hr>
              <i class="fas fa-lock svg lock-svg"></i>
              <input class="input input-second" type="password" name="confirmPassword" placeholder="Confirm Password" required>
              <hr>
              <button type="submit" class="button submitbutton registerbutton">enter</button>
          </form>
    </div>
</div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <?php echo $_SESSION['error']; ?>
        <?php endif; ?>
<?php if (isset($_SESSION['user'])): ?>
    <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
<?php endif; ?>
<?php if (!isset($_SESSION['user'])): ?>
<?php endif; ?>
<?php require __DIR__.'/views/footer.php'; ?>
