<?php

session_start();
require_once "assets/common.php";
require_once "assets/dbconn.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $tmp = $_POST["appt_date"]. ' ' . $_POST["appt_time"];
    $epoch_time = strtotime($tmp); // Best to preassign it to a variable to ensure consistent results during busy hours

    echo $epoch_time;
    echo time();
}




$staff = staff_grabber(dbconnect_select());

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
    echo "<option value='".$staf['staff_id']."'>".$role. $staf['name']."</option>";
        $staf['fname']." Room ".$staf['room']."</option>";
}