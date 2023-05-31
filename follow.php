<?php
    session_start();
    include("header.php");
    $usr = $_GET["name"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_SESSION["id"];
    $followingId = $_GET["id"];
    $sql = "INSERT INTO Follow (followerId, followingId)
    VALUES ('$userId', '$followingId')";
    //Add exception handling
    if ($conn->query($sql) === TRUE){
        header("Location: profile.php?user=$usr");
    }

    $conn->close();
?>