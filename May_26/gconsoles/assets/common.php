<?php

function new_console($conn, $post){
    try {
    $sql = "INSERT INTO console (manufacturer, console_name, release_date, controller_no, bits) VALUES (?, ?, ?, ?, ?)"; // Writes a line of sql for the code to use
    $stmt = $conn->prepare($sql); // prepare to sql
    // Prevents sql injection by binding data from form to sql parameter
    $stmt->bindParam(1, $post['manufacturer']);
    $stmt->bindParam(2, $post['console_name']);
    $stmt->bindParam(3, $post['release_date']);
    $stmt->bindParam(4, $post['controller_no']);
    $stmt->bindParam(5, $post['bits']);

    $stmt->execute(); // Run the query to insert
    $conn = null; // Closes connection so it can't be abused
} Catch (PDOException $e) {
    // Handle database errors
    error_log("Audit Database Error: " . $e->getMessage()); // Error logger
    throw new Exception("Auditing error: ", $e);
}
    Catch (Exception $e) {
        error_log("Audit Database Error: " . $e->getMessage()); // Error logger
        throw new Exception("Auditing error: ", $e);
    }
}
function user_message(){
    if(isset($_SESSION['usermessage'])){ // Checks if "usermessage" is set
        $message= $_SESSION['usermessage']."</p>"; // styles "usermessage"
        unset($_SESSION['usermessage']); // unsets to make it not exist anymore to save storage/ memory.
        return $message; // returns message
    }else{
        $message= ""; // if condition isn't met, it returns blank
        return $message;
    }
}

function only_user($conn, $username){
    try{
        $sql = "SELECT username FROM user WHERE username = ?"; // set up statement
        $stmt = $conn->prepare($sql); // prepares
        $stmt->bindParam(1, $username);
        $stmt->execute(); // run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // brings back results
        $conn = null; // cuts off connection immediately after the action is complete.
        if ($result) { // checks if it finds a value
            return true; // returns true
        } else {
            return false; // returns false
        }
    }
    catch (PDOException $e) { // catch error
        // Log the error (Crucial!!!)
        error_log("Database Error in only_user: " . $e->getMessage());
        // Throw the exception
        throw $e; // re-throws the exception
    }
}

function reg_user($conn, $post){
    try{
        // prepare and execute the SQL query
        $sql = "INSERT INTO user (username, password, signupdate, dob, country) VALUES (?, ?, ?, ?, ?)"; // prepares statement
        $stmt = $conn->prepare($sql); // prepare to sql

        $stmt->bindParam(1, $post['username']); // bind parameters for security
        // hash the password]
        $hpswd=password_hash($post['password'], PASSWORD_DEFAULT); // has the password
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

function login($conn, $post){
    try{ // try this code, catch errors
        $sql = "SELECT * FROM user WHERE username = ?"; // set up sql statement
        $stmt = $conn->prepare($sql); // prepares
        $stmt->bindParam(1, $post['username']); // binds the parameters to execute
        $stmt->execute(); // runs sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Brings back results
        $conn = null; // Breaks off connection once it is used

        if($result){ // If there is a result returned
            return $result;

        } else {
            $SESSION['Error'] = "User not found";
            header("Location: index.php");
            exit; // Stops further execution
        }

    } catch (Exception $e) {
        $SESSION['Error'] = $e->getMessage();
        header("Location: index.php");
        exit; // Stops further execution
    }
}