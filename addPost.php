<?php
    session_start();
    require_once 'db_connect.php';
    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit();
    }

    $title = $_POST['title'];
    $content = $_POST['content'];
    $characters = $_POST['char-count'];
    $post_date = date('Y-m-d H:i:s');
        
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $content = trim($_POST['content']);
        $contentLength = strlen($content);

        if ($contentLength > 1000) {
            $_SESSION['post_error'] = "Content exceeds 1000 character limit";
            header("Location: addEntry.php");
            exit();
        }
        //////////////////////////////////
        $sql = "INSERT INTO POSTS (title, content, post_date, characters)
    VALUES ('$title', '$content', '$post_date', '$characters')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: viewBlog.php");
            exit();
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
?>