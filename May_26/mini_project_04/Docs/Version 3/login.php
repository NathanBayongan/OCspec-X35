<?php //this opens the php code section
session_start();

require_once"assets/dbconn.php";
require_once"assets/common.php";

if (isset($_SESSION['user'])){ // Checks if user is already logged in
    $_SESSION["usermessage"] = "You are already logged in"; // redirects them with a message if they are.
    //header("Location: index.php");
    exit; // stops further execution

} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usr = login(dbconnect_insert(), $_POST); // does it here to ensure we can use parts of the data if successful


    if ($usr && password_verify($_POST['password'], $usr["password"])) {
        $_SESSION["user"] = true;
        $_SESSION["user_id"] = $usr["patient_id"];
        $_SESSION["usermessage"] = "Success! = user successfully logged in";
        auditor(dbconnect_insert(), $_SESSION["user_id"], "login", "User successfully logged in");
        header("Location: index.php");
        exit;
    } else {
        $_SESSION["usermessage"] = "Error: Login and Password do not match";
        header("Location: login.php");
        exit;
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
require_once "assets/nav.php";// presenting navigation bar

echo "<div class ='content'>"; // class context to give all items that give information an overall css to reduce need for styling later and standardise formatting
echo "<form method='post' action=''>";
echo "<input type= 'text'name ='email' placeholder='Email'>";
echo "<br>";
echo "<input type= 'password'name ='password' placeholder='Password'>";
echo "<br>";
echo "<input type= 'submit' value='login' id='submit'>";
echo "</form>";

echo '<br>';
echo user_message();


echo "</div>";

echo "</div>";

echo "</body>";

echo "</html>";
?>