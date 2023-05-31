<?php
    session_start();
    include("header.php");
    $postId = $_GET["postId"];
    $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM `posts` WHERE postId = \"$postId\""; 
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row["userId"]!=$_SESSION["id"]){
                header("Location: home.php");
            }
        }
        else {
            echo "No such users exists.";
        }
        $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEAMUP</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="edit-post-form">
            <h2>Edit post settings</h2>
            <a href="close.php?postId=<?php echo $postId;?>">
                <span class="custom-close">
                    Close Applications
                </span>
            </a>
            <br>
            <a href="deletepost.php?postId=<?php echo $postId;?>">
                <span class="custom-delete">
                    Delete
                </span>
            </a>
        </div>
    </div>
</body>
<?php
    include("footer.html");
?>
</html>