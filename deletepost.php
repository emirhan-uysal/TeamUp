<?php
    session_start();
    include("header.php");

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_SESSION["id"];
    $postId = $_GET["postId"];
    $sql = "DELETE FROM Posts WHERE postId=$postId and userId=$userId";
    //Add exception handling
    if ($conn->query($sql) === TRUE){
        header("Location: home.php");
    }

    $conn->close();
?>