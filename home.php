<?php
    session_start();
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
    <div class="feed-container">
        <h1>Feed</h1>
        <p style="color:grey">Latest posts created by the community:</p>
        <div class="feed">
            <?php
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }
                $id = $_SESSION["id"];
                $sql = "SELECT * FROM `posts` JOIN Users ON posts.userId = users.userId ORDER BY post_date DESC"; 
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class=\"post\">
                            <h3>". $row["title"] ."</h3>
                            <ul>Created: ". $row["post_date"] ."</ul>
                            <ul>By: ". $row["username"] ."</ul>
                            <p>". $row["discription"] ."</p>
                            <a href=\"post.php?id=".$row["postId"]."\" class=\"read-more\">Read More</a>
                        </div>";
                }
                } else {
                echo "No post yet.";
                }
                $conn->close();
            ?>
        </div>
    </div>
    </div>
    <?php
    include("footer.html");
    ?>
</body>
</html>