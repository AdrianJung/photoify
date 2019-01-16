<?php require __DIR__.'/views/header.php'; ?>
<link rel="stylesheet" href="/assets/styles/login.css">
    <h1 class="logo header-logo">Photoify.</h1>
    <h4 class="new-post-header">New Post</h4>

    <div class="posts-container">
    <div class="post-box preview-box">
            <div class="post-image-container">
            <img class="post-image previewimage" src="">
            </div>
            <form action="app/posts/store.php" method="post" enctype="multipart/form-data">
            <input class="file-input" type="file"  onchange="previewFile()" name="image" id="image" type="file" multiple="">
            <div class="select-image-div">
            <input type="button" class="button image-button" value="Select image" onclick="document.getElementById('image').click();"/>
            <br>
            <input type="text" class="new-post-input" name="description" placeholder="add description">
            <br>
            <button type="submit" class="button image-button" name="button">Submit</button>
            </form>
            </div>      
            </div>
</div>
    <script src="/assets/scripts/preview.js"></script>
<?php require __DIR__.'/views/footer.php'; ?>
