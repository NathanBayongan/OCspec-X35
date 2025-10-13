<?php //this opens the php code section
session_start();

require_once"assets/dbcnct.php";
require_once"assets/common.php";

if (isset($_SESSION['user'])){
    $_SESSION["usermessage"] = "You are already logged in";
    header("Location: index.php");
    exit; // stops further execution
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usr = login(dbconnect_insert(), $_POST);

    if ($usr && password_verify($_POST['password'], $usr["password"])) {
        $_SESSION["user"] = true;
        $_SESSION["user_id"] = $usr["user_id"];
        $_SESSION["usermessage"] = "Sucecss! = user successfully logged in";
        auditor(dbconnect_insert(), $_SESSION["user_id"], "log", "User successfully logged in");
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
            echo "<form method='post' action='login.php'>";
            echo "<input type= 'text'name ='username' placeholder='username'>";
            echo "<br>";
            echo "<input type= 'password'name ='password' placeholder='password'>";
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

