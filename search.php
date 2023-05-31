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
    <div class="search-screen">
    <h2>Search Users</h2>
        <div class="search-bar">
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="text" name="search" placeholder="Enter a name">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="search-results">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $searchedName = $_POST["search"];

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM users WHERE username LIKE \"%$searchedName%\"";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class=\"result-item\">
                        <div class=\"gradient-a\">    
                        <a href=\"profile.php?user=".$row["username"]."\">". $row["username"]."</a></div>
                            <p>".$row["fullname"]."<br>".$row["department"]."</p>
                        </div>";
                }
                } else {
                    echo "No uses found.";
                }
                $conn->close();
            }
        ?>
        </div>
    </div>
    </div>
</body>
<?php include("footer.html");?>
</html>