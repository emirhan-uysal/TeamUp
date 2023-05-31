<?php
    session_start();
    $postId = $_GET["id"];
?>
<!DOCTYPE html>
<?php
    include("header.php");
?>
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
    <?php
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM `posts` WHERE postId = \"$postId\""; 
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usr = $row["userId"];
            $sql = "SELECT fullname,username FROM `users` WHERE userId = \"$usr\""; 
            $result2 = $conn->query($sql);
            $row2 = $result2->fetch_assoc();
            $id = $row["postId"];
            echo "<div class=\"post-details-container\">";
            echo "<h2 class=\"post-details-title\">".$row["title"]."</h2>";
            $usr = $row2["username"];
            echo "<div class=\"post-details-meta\">
                <p class=\"post-details-author\">Posted by <a href=\"profile.php?user=$usr\">".$usr."</a></p>
                <p class=\"post-details-date\">".$row["post_date"]."</p>
                </div>";
            echo "<div class=\"post-details-content\">
                <p>".$row["discription"]."</p>
            </div>
            <div class=\"post-details-meta\">
                <p class=\"post-details-author\">Looking for: ".$row["teammates"]."</p>
            </div>
            <div class=\"post-details-meta\">
                <p class=\"post-details-author\">Contact: ".$row["contact"]."</p>
            </div>";
            if($row["userId"]!=$_SESSION["id"]){
                echo "<a href=\"apply.php?postId=$id\"><span class=\"custom-apply\">Apply</span></a>
                </div>";
            }
            else{
                echo "<a href=\"edit.php?postId=$id\"><span class=\"custom-edit\">Edit</span></a>
                </div>";
            }
        }
        else {
            echo "No such users exists.";
        }
        $conn->close();
    ?>
    </div>
</body>
<?php
    include("footer.html");
?>
</html>