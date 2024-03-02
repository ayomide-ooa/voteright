<?php
// CONFIGURATION FILE
// Creating a database account with the 


# Connecting to mySQL database using root
$server = "localhost";
$root = "root";
$null = ""; #no password

$conn_root = mysqli_connect($server, $root, $null);

#creating a database account if not exist and granting all permission
if(!$conn_root){
    die("ERROR: Could not login. " . mysqli_connect_error());
}
else {
    $voteright_admin = "CREATE USER IF NOT EXISTS 'Voteright'@'localhost' IDENTIFIED BY '@voterightpass777#'";

    if(mysqli_query($conn_root, $voteright_admin)){
        //flusing priviledges to reload the users table in mySQL
        $flush_privileges = "FLUSH PRIVILEGES";
        mysqli_query($conn_root, $flush_privileges);
        
        //Granting all privileges to netwrld
        $grant_permit = "GRANT ALL PRIVILEGES ON *.* TO 'Voteright'@'localhost' REQUIRE NONE WITH GRANT OPTION";
        mysqli_query($conn_root, $grant_permit);
    }

    else {
        die("Error: Could not Create Account" . mysqli_error($conn_root));
    }

$user = "Voteright";
$password = "@voterightpass777#";

#Connecting Voteright to database

$connUser = mysqli_connect($server, $user, $password);

 if(!$connUser) {
    die("ERROR: Could not connect to user account. " . mysqli_connect_error());
 }

 else {
#Creating database if not exist
$db_voteright = "CREATE DATABASE IF NOT EXISTS voteright";

if(mysqli_query($connUser, $db_voteright)) {
    $grant_permit_db = "GRANT ALL PRIVILEGES ON 'voteright'.* TO 'Voteright'@'localhost'";
    mysqli_query($conn_root, $db_voteright);
}

else {
    die("ERROR: Could not create database. " . mysqli_connect_error());
}
 }

$database = "voteright";

$conn = mysqli_connect($server, $user, $password, $database);

#Connecting to mysql database
if(!$conn) {
    die("Error! could not connect database: " . mysqli_connect_error());
}
else {
//creating users tables
$user_info = "CREATE TABLE IF NOT EXISTS user_data(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(25) NOT NULL,
    firstname VARCHAR(25) NOT NULL,
    othername VARCHAR(25),
    email VARCHAR(30) NOT NULL,
    password VARCHAR(225) NOT NULL,
    reg_date TIMESTAMP)";

    //connecting table to database
    $conn_user_info = mysqli_query($conn, $user_info);
    if(!$conn_user_info) {
        die("Failed! to create table: " . mysqli_error($conn));
        }
}
}