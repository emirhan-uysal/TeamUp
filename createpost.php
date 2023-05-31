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
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <title>Create Post</title>
</head>
<body>
  <div class="content">
  <form class="post-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
  <h2>Create a new post</h2>
  <br>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" required>
    </div>
    <div class="form-group">
      <label for="category">Category:</label>
      <select id="category" name="category" class="dropdown-menu" required>
        <option value="" disable selected>Select category</option>
        <option value="technology">Technology</option>
        <option value="academic">Academic</option>
        <option value="bussiness">Bussiness</option>
        <option value="fashion">Fashion</option>
        <option value="food">Food</option>
        <option value="travel">Music</option>
        <option value="cinema">Cinema</option>
      </select>
    </div>
    <div class="form-group">
      <label for="discription">Project Discription</label>
      <textarea id="discription" name="discription" rows="5" required></textarea>
    </div>
    <div class="form-group">
      <label for="teammates">Teammates:</label>
      <input type="text" id="teammates" name="teammates" required>
    </div>
    <div class="form-group">
      <label for="contact">Contact:</label>
      <input type="text" id="contact" name="contact" required>
    </div>
    <button type="submit">Create Post</button>
  </form>
  <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $title = $_POST["title"];
      $category = $_POST["category"];
      $discription = $_POST["discription"];
      $teammates = $_POST["teammates"];
      $contact = $_POST["contact"];
      $userId = $_SESSION["id"];

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "INSERT INTO Posts (title, category, discription, teammates, contact, userId)
      VALUES ('$title', '$category', '$discription', '$teammates', '$contact','$userId')";

      //Add exception handling
      if ($conn->query($sql) === TRUE){
      echo "Post created successfully!";
      } else {
      echo "<a style=\"color:\"red\"\">This username already exists.</a>";
      }

      $conn->close();
  }
  ?>
  </div>
</body>
<?php include("footer.html");?>
</html>