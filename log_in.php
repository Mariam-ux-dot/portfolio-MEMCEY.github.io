<?php
    session_start();
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "portfolio";
    // Creates connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Checks connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $conn->real_escape_string($_POST['Email']);
        $password = $conn->real_escape_string($_POST['Password']);
        
        // Validate credentials (use prepared statements in production)
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location: addEntry.php");
            exit();
        } else {
            echo "Invalid credentials!";
        }
        $conn->close();
    }
?>
