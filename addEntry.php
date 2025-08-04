<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/blog.css">
    <link rel="stylesheet" href="/css/mobile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;700&family=Staatliches&family=Play&display=swap">
    <script src="/js/addPost.js" defer></script>
    <title>Add Blog Post - MEMCEY</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <?php if(isset($_SESSION['post_error'])): ?>
    <div class="error-message">
        <?php echo $_SESSION['post_error']; 
        unset($_SESSION['post_error']); ?>
    </div>
    <?php endif; ?>

    <main>
        <article>
            
        <aside class="user-status">
            <p>Welcome, <span id="username"><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Guest'; ?></span></p>
        </aside>

        <section class="blog-form">
            <h2>Add a New Blog Post</h2>
            <form method="POST" action="addPost.php" id="postForm">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required class="form-input">
                <div id="title-error" class="error-message"></div>

                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="5" required class="form-input"></textarea>
                <div id="content-error" class="error-message"></div>
                
                <div class="char-counter">
                    <span id="char-count">0</span>/1000 characters
                </div>
                <div class="button-container">
                    <input type="submit" class="button" value="Post">
                    <input type="reset" class="button" value="Clear">
                </div>
            </form>
        </section>
        </article>
    </main>
    
    <?php include 'footer.php'; ?>
</body>
</html>