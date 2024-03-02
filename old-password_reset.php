<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: index.php");
//     exit;
// }
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $new_password = $confirm_password = "";
$email_err = $new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] === "POST"){
    //Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email";
    }
    else {
        $email = trim($_POST["email"]);
    }
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE user_data SET password = ? WHERE email = $email";
        
        if($stmt = mysqli_prepare($conn, $sql)){ 
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
        <!-- CSS LINKS -->
        <link rel="stylesheet" href="style.css" />

<!-- SCRIPT FILES -->
<script src="script.js" type="text/javascript"></script>

</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="example@email.com" value="<?php echo $email; ?>" autofocus required/>
                <span class="help"><?php echo $email_err; ?></span>
            </div>

            <div>
                <label>New Password</label>
                <input type="password" name="new_password" <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?> value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <button type="submit" style="background: #007700; color: #fff;">Submit </button>
                <button type="reset"><a href="index.php"> Cancel</a></button>
            </div>
        </form>
    </div>    
</body>
</html>