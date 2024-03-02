<?php
require "config.php";

// Define variables and initialize with empty values
$lastname = $firstname = $othername = $email = $password = $confirm_password = "";
$lastname_err = $firstname_err = $email_err = $password_err = $confirm_password_err = "";
 
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
    // Validate name
    // if(empty(trim($_POST["othername"]))){
    //     $othername_err = "Please enter othername.";
    // }
    // else{
        $othername = trim($_POST["othername"]);
    // }
###############################################################################
    // Validate username
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } 
    else{
        // Prepare a select statement
        $sql = "SELECT id FROM user_data WHERE email = ?";       
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = '<div class="wrng-bg">This email is already taken.</div>';
                 } else{
                    $email = trim($_POST["email"]);
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
    if(empty($lastname_err) && empty($firstname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
    $sql = "INSERT INTO user_data (lastname, firstname, othername, email, password) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_lastname, $param_firstname, $param_othername, $param_email, $param_password);
            
            // Set parameters
            $param_lastname = $lastname;
            $param_firstname = $firstname;
            $param_othername = $othername;
            $param_username = $email;
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
