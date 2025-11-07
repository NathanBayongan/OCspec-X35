<?php //this opens the php code section
session_start(); // have to start the session to end it

require_once "assets/common.php";  # bring in the common functions we need
require_once "assets/dbconn.php"; # get the connection functions for the database

try {
    auditor(dbconnect_insert(), $_SESSION["user_id"], "logout", "User has successfully logged out");
} catch (Exception $e){
    $_SESSION['usermessage'] = $e->getMessage();
    header("Location: index.php");
    exit;
}

session_destroy(); // ends session

header("location: index.php?message= You have been logged out"); // displays logout message