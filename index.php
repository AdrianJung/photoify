<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <?php if (isset($_SESSION['user'])): ?>
        <p>Welcome, GRATTIS JIPPI HURRA <?php echo $_SESSION['user']['name']; ?>!</p>
    <?php endif; ?>
    <?php if (!isset($_SESSION['user'])): ?>
    <a href="/login.php">
    <button type="button">LOGIN
    </button>
    </a>
    <a href="/register.php">
    <button type="button">REGISTER
    </button>
    </a>
<?php endif; ?>
</article>
<?php require __DIR__.'/views/footer.php'; ?>
