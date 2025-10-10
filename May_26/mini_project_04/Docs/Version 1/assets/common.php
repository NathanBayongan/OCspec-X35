<?php

function user_message()
{
    if (isset($_SESSION['usermessage'])) { // Checks if "usermessage" is set
        $message = $_SESSION['usermessage'] . "</p>"; // styles "usermessage"
        unset($_SESSION['usermessage']); // unsets to make it not exist anymore to save storage/ memory.
        return $message; // returns message
    } else {
        $message = ""; // if condition isn't met, it returns blank
        return $message;
    }
}


function reg_user($conn, $post)
{
    try {
        // prepare and execute the SQL query
        $sql = "INSERT INTO user (username, password, signupdate, dob, country) VALUES (?, ?, ?, ?, ?)"; // prepares statement
        $stmt = $conn->prepare($sql); // prepare to sql

        $stmt->bindParam(1, $post['username']); // bind parameters for security
        // hash the password]
        $hpswd = password_hash($post['password'], PASSWORD_DEFAULT); // has the password
        // Using in built php library using default encryption because we have nothing else built into this code base
        // In a business environment, it's better to use PASSWORD_BCRYPTb
        $stmt->bindParam(2, $hpswd);
        $stmt->bindParam(3, $post['signupdate']);
        $stmt->bindParam(4, $post['dob']);
        $stmt->bindParam(5, $post['country']);

        $stmt->execute(); // run the query to insert
        $conn = null; // closes connection after use
        return true; // registration successful
    } catch (PDOException $e) {
        // handles database errors
        error_log("User Reg database error: " . $e->getMessage()); // logs the errors
        throw new Exception("User reg database error: ", $e); // throws exception for calling script
    } catch (Exception $e) {
        error_log("User Registration error: " . $e->getMessage()); // logs the error
        throw new Exception("User Registration error: ", $e); // throws exception
    }
}
