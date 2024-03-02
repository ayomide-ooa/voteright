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
            <h1> &equiv; PROFILE</h1>
            <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <button class="edit-btn" id="editBtn" onclick="editBtn('saveEdit','editBtn','block',false)">Edit</button>
            <button type="submit" class="edit-btn" id="saveEdit" onclick="editBtn('editBtn','saveEdit','none',true)">Save</button>
            <div class="drop">
            <button class="edit-btn" id="addBtn">&plus;</button>
            <div class="input-type-field">
                <span onclick="addNew('text','<?php echo false ? $row['text'] : 'Some Text' ?>')" readonly>Textfield</span>
                <span onclick="addNew('text','<?php echo false ? $row['address'] : 'Office Address' ?>')" readonly>Address</span>
                <span onclick="addNew('tel', '<?php echo false ? $row['tel2'] : '+234 000 000 0000' ?>')" readonly>Phone no</span>
                <span onclick="addNew('email','<?php echo false ? $row['email'] : 'example@abc.com' ?>')" readonly>email</span>
                <span onclick="addNew('text','<?php echo false ? $row['text'] : 'Text field' ?>')" readonly>Textfield</span>
            </div>
            </div>
        </header>

        <section>
                <img src="../img/image1.jpg" style="margin: 5px auto;" width="250px" alt="image1.jpg" />
                
            <div class="bio-data" id="bio">
                <input type="text" name="user_id" id="y" value="id: usr000001" disabled/>
                <input type="text" name="firstname" value="<?php echo $row['firstname'] ?>" disabled/>
                <input type="text" name="othername" value="<?php echo $row['othername'] ?>" disabled/>
                <input type="text" name="lastname" value="<?php echo $row['lastname'] ?>" disabled/>

                <!-- Email & Contact-->
                <input type="email" name="email" value="<?php echo $row['email'] ?>" disabled/>
                <input type="tel" name="tel1" value="<?php echo false ? $row['tel1'] : "+234 000 000 0000" ?>" disabled/>
                <input type="tel" name="tel2" value="<?php echo false ? $row['tel2'] : "+234 000 000 0000" ?>" disabled/>

                <!-- Address -->
                <textarea name="address1" disabled><?php echo false ? $row['address'] : "Residential Address" ?></textarea>
                <textarea name="address2" disabled><?php echo false ? $row['address'] : "Permanent Address" ?></textarea>
            </div>
        </section>

    </main>
</body>
</html>