<?php
//Initialize the session
session_start();

//Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;

}
require_once "../config.php";

            $email = $_SESSION["email"];

            //Prepare SQL statement
            $query = "SELECT * from user_data WHERE email = ?";

            $stmt = mysqli_prepare($conn, $query);

            //Bind parameters
            mysqli_stmt_bind_param($stmt,"s", $email);

            //Execute SQL query
            mysqli_stmt_execute($stmt);

            //Get result
            $result = mysqli_stmt_get_result($stmt);

            //Check if a row is returned
            if($row = mysqli_fetch_assoc($result)){
                //If row found, row dat can be access like $row['column_name']
                // echo $row["firstname"];
                }
            else {
                //If email has error
                echo "Error!";
            }
            mysqli_stmt_close($stmt);

            mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLLS - PROFILE</title>
    <link rel="icon" href="../icon.png" type="image/x-icon" />

    <!-- CSS LINKS -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../style.css" />

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
            <h1> &equiv; PROFILE</h1>
            <a href="../home">Home</a>
            <a href="./edit_profile.php"><button class="edit-btn">Edit</button></a>
        </header>

        <section>
                <img src="../img/image1.jpg" width="250px" alt="image1.jpg" />
                
            <div class="bio-data" id="bio">

                <?php
                $row['id'] = 'usr' .$row['id']/1000000;
                $row['password'] = $row['year_of_birth'] = $row['reg_date'] = null;

                foreach( $row as $i ){
                   echo "<div class='data-box'>$i</div>";
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>