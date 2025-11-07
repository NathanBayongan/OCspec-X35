<?php
echo "<div class='navi'>";//declares class
echo "<nav>";

echo "<ul>";//declares unordered list


if(!isset($_SESSION['user'])){
    echo "<li class='linkbox'> <a href='login.php'>Login</a></li>";
    echo "<li class='linkbox'> <a href='register.php'>Register</a></li>";

} else {

    echo "<li class='linkbox'> <a href='book.php'>Book Appointment</a></li>";
    echo "<li class='linkbox'> <a href='booking.php'>Bookings</a></li>";
    echo "<li class='linkbox'> <a href='logout.php'>Logout</a></li>";

}

echo "</ul>";//closes list

echo "</nav>";
echo "</div>";
