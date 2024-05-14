<?php
//Initialize the session
session_start();

//Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;

}
require_once "../config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLLS - HOME</title>
    <link rel="icon" href="../icon.png" type="image/x-icon" />

    <!-- CSS LINKS -->
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="style.css" />

    <!-- SCRIPT FILES -->
    <script src="script.js" type="text/javascript"></script>
</head>

<body>
    <video playsinline autoplay muted loop>
        <source src="../bg_video.mp4" type="video/mp4">
        Your browser doesn't support video file
    </video>
    <main>
        <header>
            <h1> &equiv; HOME</h1>
            <div class="slogan">
            <a href="../profile/index.php" style="color: #fff";>Welcome, <b><?php 

            $email = $_SESSION["email"];
            $sql = "SELECT firstname from user_data WHERE email = ?";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param($stmt,"s", $email);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $firstname);

            if(mysqli_stmt_fetch($stmt)){

                    echo $firstname;
                }
            else {
                echo "Invalid";
            }
            mysqli_stmt_close($stmt);

            mysqli_close($conn);
            ?>
            </b> &circledcirc;</a> 
            <b>|</b> <a href="../logout.php">Logout</a>
        </div>
        </header>

        <div class="selection_pane">
            <ul>
                <li>All</li>
                <li>Trending</li>
                <li>Popular</li>
                <li>Private</li>
                <li>Premium</li>
            </ul>
        </div>

        <section>
            <div class="election-card">
                <h1 onclick="location.href='../create_new/index.html';"><img src="../img/plus.png" /> </h1>
            </div>
            <div class="election-card">
                <img src="../img/image.jpg" alt="Image" />
                <h3><a href="../election/index.php">Election Title for 2023</a></h3>
                <span>Starts: 00:00:00</span> |
                <span>End: 00:00:00</span>
            </div>

            <div class="election-card">
                <img src="../img/image.jpg" alt="Image" />
                <h3><a href="../election/index.php">Election Title for 2023</a></h3>
                <span>Starts: 00:00:00</span> |
                <span>End: 00:00:00</span>
            </div>

            <div class="election-card">
                <img src="../img/image.jpg" alt="Image" />
                <h3><a herf="#">Election Title for 2023</a></h3>
                <span>Starts: 00:00:00</span> |
                <span>End: 00:00:00</span>
            </div>

            <div class="election-card">
                <img src="../img/image.jpg" alt="Image" />
                <h3><a herf="#">Election Title for 2023</a></h3>
                <span>Starts: 00:00:00</span> |
                <span>End: 00:00:00</span>
            </div>

            <div class="election-card">
                <img src="../img/image.jpg" alt="Image" />
                <h3><a herf="#">Election Title for 2023</a></h3>
                <span>Starts: 00:00:00</span> |
                <span>End: 00:00:00</span>
            </div>
            
            <div class="election-card">
                <img src="../img/image.jpg" alt="Image" />
                <h3><a herf="#">Election Title for 2023</a></h3>
                <span>Starts: 00:00:00</span> |
                <span>End: 00:00:00</span>
            </div>

            <div class="election-card">
                <img src="../img/image.jpg" alt="Image" />
                <h3><a herf="#">Election Title for 2023</a></h3>
                <span>Starts: 00:00:00</span> |
                <span>End: 00:00:00</span>
            </div>

            <div class="election-card">
                <img src="../img/image.jpg" alt="Image" />
                <h3><a herf="#">Election Title for 2023</a></h3>
                <span>Starts: 00:00:00</span> |
                <span>End: 00:00:00</span>
            </div>
            
            <div class="election-card">
                <img src="../img/image.jpg" alt="Image" />
                <h3><a herf="#">Election Title for 2023</a></h3>
                <span>Starts: 00:00:00</span> |
                <span>End: 00:00:00</span>
            </div>

        </section>
    </main>
</body>
</html>