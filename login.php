<?php
    session_start();
?>
<!DOCTYPE html>
<?php
    include("header.html");
    include("connection.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="content">
    <form class="login-form" action="login.php" method="POST">
    <h2>Login</h2>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Login</button>
    <ul>Don't have an account? <a href="register.php">Register</a></ul>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $usr = $_POST["username"];
            $pwd = $_POST["password"];
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM `users` WHERE username = \"$usr\""; 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if($row["pass"]==$pwd){
                    $_SESSION["usr"] = $usr;
                    $_SESSION["id"] = $row["userId"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["age"] = $row["age"];
                    $_SESSION["dep"] = $row["department"];
                    $_SESSION["fullname"] = $row["fullname"];
                    header("Location: home.php");
                    die();
                }
                else{
                    echo "Wrong username or password.";
                }
            }
            else {
                echo "Wrong username or password.";
            }
            $conn->close();
        }
    ?>
    </div>
    <?php
    include("footer.html");
    ?>
</body>
</html>