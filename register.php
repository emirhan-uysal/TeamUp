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
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="content">
    <form action="register.php" method="post" class="register-form">
        <h2>Register</h2>
        <br>
        <div class="form-group">
            <label>Fullname: </label>
            <input type="text" name="fullname">
        </div>
        <br>
        <div class="form-group">
            <label>Username: </label>
            <input type="text" name="username">
        </div>
        <br>
        <div class="form-group">
            <label>Email: </label>
            <input type="email" name="email">
        </div>
        <br>
        <label>Password: </label>
            <div class="form-group">
            <input type="password" name="password">
        </div>
        <br>
        <label>Age: </label>
            <div class="form-group">
            <input type="number" name="age">
        </div>
        <br>
        <div class="form-group">
            <label>Department: </label>
            <select name="department" id="dep">
            <option value="cse">Comp Sci</option>
            <option value="ee">Electrical Engineering</option>
            <option value="bus">Business</option>
            <option value="art">Arts</option>
        </select>
        </div>
        <br><br>
        <button type="submit">Register</button>
    </form>
    </div>
</body>
<?php include("footer.html");?>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fullname = $_POST["fullname"];
        $usr = $_POST["username"];
        $pass = $_POST["password"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        $dep = $_POST["department"];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO Users (fullname, username, pass, age, department, email)
        VALUES ('$fullname', '$usr', '$pass', '$age', '$dep', '$email')";

        //Add exception handling
        if ($conn->query($sql) === TRUE){
        echo "Registiration successfull, please <a href=\"login.php\">Login</a> now.";
        } else {
        echo "<a style=\"color:\"red\"\">This username already exists.</a>";
        }

        $conn->close();
    }
?>