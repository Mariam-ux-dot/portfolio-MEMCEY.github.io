<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MEMCEY</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/mobile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;700&family=Staatliches&family=Play&display=swap">
</head>
<body>
<?php include 'header.php'; ?>

    <main>
        <article>
            <form method ="POST" action ="log_in.php">
                <fieldset>
                    <legend>LOGIN</legend>
                    <p>
                        <label>Email:</label><br>
                        <input type="email" name="Email" required>
                    </p>
                    <p>
                        <label>Password: </label><br>
                        <input type="password" name="Password" required>
                    </p><br>
                    <input type ="submit" class="button" value="Login">
                </fieldset>
            </form>
        </article>
    </main>

<?php include 'footer.php'; ?>

</body>
</html>