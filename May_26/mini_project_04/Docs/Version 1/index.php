<?php
//this opens the php code section

if (!isset($_GET['message'])) { // Checks if variable 'message' has been assigned anything
    session_start();
    $message = false; // Setting it as false to prevent errors further down the ode
} else {
    // Decodes the message for display
    $message = htmlspecialchars(urldecode($_GET['message']));
}


require_once "assets/dbconn.php";
require_once "assets/common.php";

echo "<!DOCTYPE html>";  // desired tag to declare what type of page it is

echo "<html>";  // opening html
echo "<head>";  // opening head

echo "<title>page title</title>";  // creating title
echo "<link rel='stylesheet' type='text/css' href='css\styles.css'>";// getting css formatting for website from external

echo "</head>";
echo "<body>"; // opening body


echo "<div class ='container'>"; // class container to give all items a default to reduce need for styling later
require_once "assets/topbar.php"; // presenting header
echo '<br>';

echo "<div class ='content'>"; // class context to give all items that give information an overall css to reduce need for styling later and standardise formatting
echo "<p> Welcome to </p>";
echo "<p> Primary Oaks Surgery </p>";

try {
    $conn = dbconnect_insert(); // establishes connection to database
    echo ""; // display message to ensure the connection is valid

} catch (PDOException $e) {
    echo $e->getMessage();
}
if (!$message) { // checks if 'message' variable has been set
    echo user_message(); // displays user message

} else {
    echo $message; // displays message
}

echo "</div>";
echo "<div class ='content'>"; // class context to give all items that give information an overall css to reduce need for styling later and standardise formatting
echo "<p> Info </p>";

echo "</div>";
echo '<br>';
require_once "assets/nav.php";// presenting navigation bar

echo "</body>";

echo "</html>";
