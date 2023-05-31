<?php
    session_start();
    $postId = $_GET["postId"];
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
    <form class="application-form" method="post">
    <h2>Apply Now</h2>
    
    <label for="message">Message:</label>
    <textarea id="message" name="message" rows="5" required></textarea>
    
    <button type="submit">Submit</button>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }

            $userId = $_SESSION["id"];
            $postId = $_GET["postId"];
            $message = $_POST["message"];
            $sql = "INSERT INTO Applications (applicantId, postId,appMessage)
            VALUES ('$userId', '$postId,','$message')";
            //Add exception handling
            if ($conn->query($sql) === TRUE){
                echo '
                    <div class="popup-message success">
                    <span class="close-button" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                    <h2>Success!</h2>
                    <p>Your form has been submitted successfully.</p>
                    </div>
                ';
            }

            $conn->close();
        }
    ?>
    </div>
    <script src="script.js"></script>
</body>
<?php
    include("footer.html");
?>
</html>