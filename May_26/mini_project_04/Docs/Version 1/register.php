<?php
//this opens the php code section
session_start();

require_once "assets/common.php"; // connects this to the common function
require_once "assets/dbconn.php"; // connects this to the function that connects it to the database

if ($_SERVER["REQUEST_METHOD"] === "POST") { // checks the request method



        if (reg_user(dbconnect_insert(), $_POST)) {
            $_SESSION["usermessage"] = "User has been created successfully";
            header("Location: index.php");
            exit;

        } else {
            $_SESSION["usermessage"] = "User registration failed";
        }
    } else {
        $_SESSION["usermessage"] = "Error: User cannot be created";


}

echo "<!DOCTYPE html>";  // desired tag to declare what type of page it is

echo "<html>";  // opening html
echo "<head>";  // opening head

echo "<title>page title</title>";  // creating title
echo "<link rel='stylesheet' type='text/css' href='css\styles.css'>";// getting css formatting for website from external

echo "</head>";
echo "<body>"; // opening body


echo "<div class ='container'>"; // class container to give all items a default to reduce need for styling later
require_once "assets/topbar.php"; // presenting header
require_once "assets/nav.php";// presenting navigation bar

echo "<div class ='content'>"; // class context to give all items that give information an overall css to reduce need for styling later and standardise formatting
echo "<form method='post' action=''>";
echo "<input type= 'text' name ='username' placeholder='username'>";
echo "<br>";
echo "<input type= 'password' name ='password' placeholder='password'>";
echo "<br>";
echo "<input type= 'text' name ='signupdate' placeholder='sign up date'>";
echo "<br>";
echo "<input type= 'text' name ='dob' placeholder='date of birth'>";
echo "<br>";
echo "<input type= 'text' name ='country' placeholder='country'>";
echo "<br>";
echo "<input type= 'submit' value='register' id='submit'>";
echo "</form>";
echo "<br>";
echo user_message();

echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
