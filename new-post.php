<?php require __DIR__.'/views/header.php'; ?>
    <h1 class="logo header-logo">Photoify.</h1>
    <h4>New Post</h4>
    <form action="app/posts/store.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image" type="file" multiple="">
        <br>
        <input type="text" name="description" placeholder="description">
        <br>
      <button type="submit" name="button">Submit</button>
    </form>
<?php require __DIR__.'/views/footer.php'; ?>
