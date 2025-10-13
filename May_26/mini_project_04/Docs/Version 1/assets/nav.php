<?php

echo "<div class='navi'>";//declares class
echo "<nav>";

echo "<ul>";//declares unordered list

if (!isset($_SESSION['user'])) {
    echo "<li><a href='register.php'>Sign Up</a></li>";
}

echo "</ul>";//closes list

echo "</nav>";
echo "</div>";