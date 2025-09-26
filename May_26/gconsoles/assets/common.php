<?php

function new_console($conn, $post){
    try {
    $sql = "INSERT INTO console (manufacturer, console_name, release_date, controller_no, bits) VALUES (?, ?, ?, ?, ?)";
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
    if(isset($_SESSION['usermessage'])){
        $message= $_SESSION['usermessage'];
        unset($_SESSION['usermessage']);
        return $message;
    }else{
        $message= "";
        return $message;
    }
}
