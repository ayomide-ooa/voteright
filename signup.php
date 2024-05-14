<?php
require "config.php";

// Define variables and initialize with empty values
$lastname = $firstname = $othername = $gender = $dob = $email = $tel = $password = $confirm_password = "";
$lastname_err = $firstname_err = $gender_err = $dob_err = $email_err = $tel_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate name
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter lastname.";
    }
    else{
        $lastname = trim($_POST["lastname"]);
    }
    // Validate name
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter firstname.";
    }
    else{
        $firstname = trim($_POST["firstname"]);
    }
    $othername = trim($_POST["othername"]);


    if(isset($_POST["gender"]) && !empty($_POST["gender"])){
        $gender = $_POST["gender"];
    }
    else {
        $gender_err = "Please choose your gender";
    }

    if(isset($_POST["dob"]) && !empty($_POST["dob"])){
        $dob = $_POST["dob"];
        $yearofbirth = date_parse($dob)["year"];
        
    }
    else {
        $dob_err = "Please choose your date of birth";
    }
###############################################################################
    // Validate email
    if(empty(trim($_POST["email"])) && empty(trim($_POST["tel"]))){
        $email_err = "Please enter your email.";
        $tel_err = "Please enter your phone no";
    } 
    else{
        // Prepare a select statement
        $sql = "SELECT id FROM user_data WHERE email = ? AND tel = ?";       
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_tel);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            $param_tel = trim($_POST["tel"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = '<div class="help">This email is already taken.</div>';
                    $tel_err = '<div class="help">This phone no is already taken.</div>';
                 } else{
                    $email = trim($_POST["email"]);
                    $tel = trim($_POST["tel"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } 
    elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } 
    else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } 
    else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($lastname_err) && empty($firstname_err) && empty($gender_err) && empty($dob_err) && empty($tel_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
    $sql = "INSERT INTO user_data (lastname, firstname, othername, gender, dob, year_of_birth, email, tel, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssisss", $param_lastname, $param_firstname, $param_othername, $param_gender, $param_dob, $param_yob, $param_email, $param_tel, $param_password);
            
            // Set parameters
            $param_lastname = $lastname;
            $param_firstname = $firstname;
            $param_othername = $othername;
            $param_gender = $gender;
            $param_dob = $dob;
            $param_yob = $yearofbirth;
            $param_username = $email;
            $param_tel = $tel;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: home/index.php");
                //echo"<script>window.open('home/index.php','_self')</script>";
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
