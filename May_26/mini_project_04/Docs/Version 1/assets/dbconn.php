<?php
function dbconnect_insert()
{

    // should not be stored in plain text
    $servername = "localhost"; //sets servername
    // Do not use server name as root as it gives anyone access to the database
    $dbusername = "root"; //had to change this variable name as it fought again

    $dbpassword = "";// password for database useraccount

    $dbname = "posdatabase"; //database name to connect to

    try { // attempt this block of code, cathing an error
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);
        // Instead of PDO, We could use MySQLI connection, but PDO can connect to any kind of data source
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // sets error modes
        return $conn;
    } catch (PDOException $e) { // catch statement if it fails
        error_log("Database error in super_checker: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception // outputs the error
    }
}
