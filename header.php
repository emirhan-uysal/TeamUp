<header>
    <h1>TeamUp</h1>
    <?php 
        echo "<h6>Welcome " . $_SESSION["usr"] . "!</h6>";
    ?>
    <a href="home.php">Home</a>
    <a href="createpost.php">Post</a>
    <a href="search.php">Connect</a>
    <a href="network.php">Network</a>
    <?php echo "<a href=profile.php?user=".$_SESSION["usr"].">Profile</a>";?>
    <a href="logout.php">Logout</a>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "teamup";
    ?>
</header>