<?php //this opens the php code section
session_start(); // connect to the session to get important information

require_once "assets/common.php"; // connects this to the common function
require_once "assets/dbconn.php"; // connects this to the function that connects it to the database

if (isset($_SESSION['userid'])) {  // Looks for if the user is already logged in
    $_SESSION['usermessage'] = "ERROR: You have already logged in!";  // tells them they are logged in and redirect to index
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") { // checks for post condition
    if (reg_user(dbconnect_insert(), $_POST)) {
        $_SESSION["usermessage"] = "User has been created successfully";
        header("Location: index.php");
        exit; // this ensures the redirect works and stops any further code executing.

    } else {
        $_SESSION["usermessage"] = "User registration failed";
    }
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

echo "<div class ='content'>"; // class context to give all items that give information an overall css to reduce need for styling later and standardise formatting
echo "<form method='post' action=''>";
echo "<input type= 'text' name ='fname' placeholder='First Name'>";
echo "<br>";
echo "<input type= 'text' name ='sname' placeholder='Surname'>";
echo "<br>";
echo "<input type= 'datetime-local' name ='dob' placeholder='Date of Birth'>";
echo "<br>";
echo "<input type= 'text' name ='gender' placeholder='Gender'>";
echo "<br>";
echo "<input type= 'password' name ='password' placeholder='Password'>";
echo "<br>";
echo "<input type= 'submit' value='register' id='submit'>";
echo "</form>";
echo "<br>";
echo user_message();

echo "</div>";
require_once "assets/nav.php";// presenting navigation bar
echo "</div>";

echo "</body>";

echo "</html>";