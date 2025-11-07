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

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['appdelete'])) {
        try {
            if (Cancel_appt(dbconnect_insert(), $_POST['apptid'])) {
                $_SESSION["usermessage"] = "Appointment cancelled.";
            } else {
                $_SESSION["usermessage"] = "Appointment failed to cancelled.";
            }
        } catch (Exception $e) {
            $_SESSION["usermessage"] = "Appointment failed to cancelled.";
        } catch (PDOException $e) {
            $_SESSION["usermessage"] = "Appointment failed to cancelled.";
        }
    } elseif((isset($_POST['appchange']))) {
        $_SESSION["apptid"] = $_POST['apptid'];
        header("location: alternate_book.php");
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
echo '<br>';

echo "<div class ='content'>"; // class context to give all items that give information an overall css to reduce need for styling later and standardise formatting
echo "<p id='top' id='Bold'> Welcome to<br></p>";
echo "<p id='bottom' id='Bold'>Primary Oaks Surgery </p>";
echo '<br>';
echo "<p id='top'>Information<br>";
echo '<br>';
echo user_message();
$appts = appt_grabber(dbconnect_insert());
if (!$appts) {
    echo "No appointments found";
} else {
    echo "<table id='bookings'>";
    foreach ($appts as $appt) {
        if ($appt['role'] = "doc") {
            $role = "Doctor";
        } else if ($appt['role'] = "nur") {
            $role = "Nurse";
        }

        echo "<form action=' ' method='post'>";

        echo "<tr>";
        echo "<td> Date: " . date('M d, Y @ h:i A', $appt['appointmentdate']) . "</td>";
        // Date is built in function with epoch time. It is set to display the date in a format we want it to be displayed.
        echo "<td> Made on: " . date('M d, Y @ h:i A', $appt['bookingdate']) . "</td>";
        echo "<td> With: " . $role . " " . $appt['fname'] . " " . $appt['sname'] . "</td>";
        echo "<td> Room: " . $appt['room'] . "</td>";
        echo "<td><input type='Hidden' name='apptid' value='".$appt['bookingid']."'>
                <input type='submit' name='appdelete' value='Cancel Appt' />
                <input type='submit' name='appchange' value='Change Appt' /></td>";

        echo "</tr>";
        echo "</form>";

    }
    echo "</table>";

}
echo '<br>';

echo "<p class ='content'> Below are your bookings </p>";


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

echo "</div>";
echo '<br>';

echo "</div class='navi'>";

echo "<nav>";

echo "<ul>";//declares unordered list

echo "<li class='linkbox'> <a href='index.php'>Home</a></li>"; #open a cell for a link to be housed

echo "</ul>";//closes list

echo "</nav>";

echo "</body>";

echo "</html>";


