<?php
    include("header.php");
    /*
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    
    // Create database
    $sql = "CREATE DATABASE teamup";
    if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
    } else {
    echo "Error creating database: " . $conn->error;
    }
    $dbname = "teamup";
    */
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "CREATE TABLE Users (
        userId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(30) NOT NULL,
        username VARCHAR(30) NOT NULL UNIQUE,
        pass VARCHAR(20) NOT NULL,
        age INT,
        department VARCHAR(20),
        email VARCHAR(30) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    if ($conn->query($sql) === TRUE) {
        echo "Users table created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
    //Post table
    $sql = "CREATE TABLE Posts (
        postId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(30) NOT NULL,
        category VARCHAR(10) NOT NULL,
        discription VARCHAR(512) NOT NULL,
        teammates VARCHAR(128),
        contact VARCHAR(30),
        userId INT UNSIGNED NOT NULL,
        post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (userId) REFERENCES Users(userId)
        )";
        
        if ($conn->query($sql) === TRUE) {
          echo "Table Tweets created successfully";
        } else {
          echo "Error creating table: " . $conn->error;
        }
    
    $sql = "CREATE TABLE Follow (
        fId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        followerId INT UNSIGNED NOT NULL,
        followingId INT UNSIGNED NOT NULL,
        follow_Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (followerId) REFERENCES Users(userId),
        FOREIGN KEY (followingId) REFERENCES Users(userId)
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table Following created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    $sql = "CREATE TABLE Applications (
        appId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        applicantId INT UNSIGNED NOT NULL,
        postId INT UNSIGNED NOT NULL,
        appMessage VARCHAR(255) NOT NULL,
        app_Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (applicantId) REFERENCES Users(userId),
        FOREIGN KEY (postId) REFERENCES Posts(postId)
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table Application created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    $conn->close();
?> 