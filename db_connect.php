<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "portfolio";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->query("SET time_zone = '+00:00'");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>