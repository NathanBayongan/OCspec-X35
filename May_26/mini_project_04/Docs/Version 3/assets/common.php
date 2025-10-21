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

function login($conn, $post){
    try{ // try this code, catch errors
        $sql = "SELECT * FROM patient WHERE fname = ?"; // set up sql statement
        $stmt = $conn->prepare($sql); // prepares
        $stmt->bindParam(1, $post['fname']); // binds the parameters to execute
        $stmt->execute(); // runs sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Brings back results
        $conn = null; // Breaks off connection once it is used

        if($result){ // If there is a result returned
            return $result;

        } else {
            $SESSION['usermessage'] = "User not found";
        }

    } catch (Exception $e) {
        $SESSION['Error'] = $e->getMessage();
        throw new Exception("User Registration error: ", $e); // throws exception
    }
}

function reg_user($conn, $post)
{
    try {
        // prepare and execute the SQL query
        $sql = "INSERT INTO patient (fname, sname, dob, gender, password) VALUES (?, ?, ?, ?, ?)"; // prepares statement
        $stmt = $conn->prepare($sql); // prepare to sql

        $stmt->bindParam(1, $post['fname']); // bind parameters for security
        $stmt->bindParam(2, $post['sname']);
        $stmt->bindParam(3, $post['dob']);
        $stmt->bindParam(4, $post['gender']);
        // hash the password
        $hpswd = password_hash($post['password'], PASSWORD_DEFAULT); // has the password
        // Using in built php library using default encryption because we have nothing else built into this code base
        // In a business environment, it's better to use PASSWORD_BCRYPTb
        $stmt->bindParam(5, $hpswd);

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

function auditor($conn, $patientid, $code, $long){ // on doing any action, auditor is
    $sql = "INSERT INTO audit (date, patientid, code, longdesc) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // prepares the sql
    $date = date('Y-m-d'); // Y-m-d is the date orientation that php needs/accepts
    $stmt->bindParam(1, $date); // bind parameters for security
    $stmt->bindParam(2, $patientid);
    $stmt->bindParam(3, $code);
    $stmt->bindParam(4, $long);

    $stmt->execute(); // run the query to insert
    $conn = null; // closes the connection so it can't be abused
    return true; // Registration successful
}

function staff_grabber($conn){


    $sql = "SELECT staffid, role, fname, sname, room FROM staff WHERE role != ? ORDER by role DESC";

    $stmt = $conn->prepare($sql);
    $exclude_role = "adm";

    $stmt->bindParam(1, $exclude_role);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $result;
}