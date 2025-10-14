<?php //this opens the php code section
session_start(); // have to start the session to end it

session_destroy(); // ends session

header("location:index.php?message=You have been logged out"); // displays logout message