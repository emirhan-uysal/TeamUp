<?php
    session_start();
    $name = $_GET["user"];
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
    <div class="profile">
        <?php
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM `users` WHERE username = \"$name\""; 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h1>".$row["username"]."</h1>";
                $id = $row["userId"];
                $sql = "SELECT * FROM Follow WHERE followingId =\"$id\"";
                $result2 = $conn->query($sql);
                echo "<p>Follower: ". $result2->num_rows . "</p>";
                $sql = "SELECT * FROM Follow WHERE followerId =\"$id\"";
                $result2 = $conn->query($sql);
                echo "<p>Following: ". $result2->num_rows . "</p>";
                echo "<p>Fullname: ".$row["fullname"]."</p><br><p>Email: ".$row["email"]."</p><br><p>Department: ".$row["department"]."</p>";
                $id = $row["userId"];
                $name = $row["username"];
                echo "<a href=\"userpost.php?id=$id&name=$name\"><span class=\"custom-button\">See Posts of $name</span></a>";
            }
            $id = $row["userId"];
            $curId = $_SESSION["id"];
            $sql = "SELECT * FROM Follow WHERE followingId =\"$id\"";
            $result = $conn->query($sql);
            $doesFollow = false;
            if($result->num_rows>0){
                $sql = "SELECT * FROM Follow WHERE followerId =\"$curId\"";
                $temp = $conn->query($sql);
                if($temp->num_rows>0){
                    $doesFollow = true;
                }
            }
            if($id!=$_SESSION["id"]){
                if($doesFollow==false){
                    echo "<a href=\"follow.php?id=$id&name=$name\"><span class=\"custom-follow\">Follow</span></a>";
                }
                else{
                    echo "<a href=\"unfollow.php?id=$id&name=$name\"><span class=\"custom-unfollow\">Unfollow</span></a>";
                }
            }
            $conn->close();
        ?>
    </div>
    </div>
</body>
<?php
    include("footer.html");        
?>
</html>