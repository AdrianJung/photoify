<?php require __DIR__.'/views/header.php'; ?>
<link rel="stylesheet" href="/assets/styles/login.css">
    <div class="login-container">
        <h1 class="logo loginlogo">Photoify</h1>
        <?php if (!isset($_SESSION['error'])): ?>
        <div class="sign">
            <h3 class="sign-in">sign in</h3>
            <h3 class="sign-up">sign up</h3>
        </div>
        <div class="input-box">
            <form action="app/users/login.php" class="loginform" method="post">
                <i class="fas fa-user svg"></i>
                <input class="input input-first" type="text" name="username" placeholder="Username" required>
                <hr class="hr-login">
                <i class="fas fa-lock svg"></i>
                <input class="input input-second" type="password" name="password" placeholder="Password" required>
                <hr class="hr-login">
                <button type="submit" class="button submitbutton">enter</button>
            </form>
            <form action="app/users/register.php" class="registerform" method="post">
                <i class="fas fa-user svg"></i>
                <input class="input input-second" type="text" name="firstName" placeholder="First Name" required>
                <hr class="hr-login">
                <i class="fas fa-user svg"></i>
                <input class="input input-second" type="text" name="lastName" placeholder="Last Name" required>
                <hr class="hr-login">
                <i class="fas fa-user svg"></i>
                <input class="input input-second" type="text" name="username" placeholder="Username" required>
                <hr class="hr-login">
                <i class="fas fa-envelope svg"></i>
                <input class="input input-second" type="email" name="email" placeholder="Email" required>
                <hr class="hr-login">
                <i class="fas fa-lock svg lock-svg"></i>
                <input class="input input-second" type="password" name="password" placeholder="Password" required>
                <hr class="hr-login">
                <i class="fas fa-lock svg lock-svg"></i>
                <input class="input input-second" type="password" name="confirmPassword" placeholder="Confirm Password"
                    required>
                <hr class="hr-login">
                <button type="submit" class="button submitbutton registerbutton">enter</button>
            </form>
        </div>
        <?php else:?>
        <div class="error-div">
            <p class="error-text">
                <?php echo $_SESSION['error']; ?>
            </p>
        </div>
        <?php endif; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<script src="/assets/scripts/login.js"></script>
</body>
</html>
