<?php

session_start();
require_once "assets/common.php";
require_once "assets/dbconn.php";

if($_SERVER["REQUEST_METHOD"] == "POST") { // This block of code SHOULD be here unless there is a reason for it not to be

    try {

        $tmp = $_POST["appt_date"] . ' ' . $_POST["appt_time"];
        $epoch_time = strtotime($tmp); // Best to preassign it to a variable to ensure consistent results during busy hours
        if(commit_booking(dbconnect_insert(),$epoch_time)){
            $_SESSION['usermessage'] = "SUCCESS: Your booking has been confirmed!";
            header("Location: booking.php");
            exit;
        } else {
            $_SESSION['usermessage'] = "ERROR: Booking has failed!";
        }

    }
    catch(PDOException $e) {
        $_SESSION["usermessage"] = "Error: " . $e->getMessage();
    } catch (PDOException $e) {
        $_SESSION["usermessage"] = "Error: " . $e->getMessage();
    }
}



echo "<DOCTYPE html>";


$staff = staff_grabber(dbconnect_insert());



echo "<!DOCTYPE html>";  // desired tag to declare what type of page it is

echo "<html>";  // opening html
echo "<head>";  // opening head

echo "<title>page title</title>";  // creating title
echo "<link rel='stylesheet' type='text/css' href='css\styles.css'>";// getting css formatting for website from external

echo "</head>";
echo "<body>"; // opening body


echo "<div class ='container'>"; // class container to give all items a default to reduce need for styling later
require_once "assets/topbar.php"; // presenting header

echo "<div class='content'>";
echo "<form method='post' action=''>";
echo "<label for='appt-time'> Appointment Time:</label>";
echo "<input type='time' name='appt_time' required>";

echo "<br>";
echo "<label for='appt-date'> Appointment Time:</label>";
echo "<input type='date' name='appt_date' required>";

echo "<br>";
echo "<select name='staff'>";

foreach ($staff as $staf) {
    if ($staf['role'] = "doc"){
        $role = 'Doctor';
    } else if ($staf['role'] = "nur"){
        $role = 'Nurse';
    }
    echo "<option value=".$staf['staffid'].">".$role." ". $staf['fname']." ".$staf['sname']." Room ".$staf['room']."</option>";
}
echo "</select>";
echo "<input type='submit' name='submit' value='Submit'>";
echo "</form>";
echo '<br>';
echo user_message();


echo "</div>";

echo "</div class='navi'>";

echo "<nav>";

echo "<ul>";//declares unordered list

echo "<li class='linkbox'> <a href='index.php'>Home</a></li>"; #open a cell for a link to be housed

echo "</ul>";//closes list

echo "</nav>";

echo "</body>";

echo "</html>";
?>