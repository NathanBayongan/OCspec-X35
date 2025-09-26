<?php
try {
function new_console($conn, $post)
{
    $sql = "INSERT INTO console (manufacturer, c_name, release_date, controller_no, bit) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // prepare to sql
    // Prevents sql injection by binding data from form to sql parameter
    $stmt->bindParam(1, $post['manufacturer']);
    $stmt->bindParam(2, $post['cname']);
    $stmt->bindParam(3, $post['release']);
    $stmt->bindParam(4, $post['controllerno']);
    $stmt->bindParam(5, $post['bit']);

    $stmt->execute(); // Run the query to insert
    $conn = null; // Closes connection so it can't be abused
}
} Catch (PDOException $e) {
    // Handle database errors
    error_log("Audit Database Error: " . $e->getMessage()); // Error logger
    throw new Exception("Auditing error: ", $e);
}
    Catch (Exception $e) {
        error_log("Audit Database Error: " . $e->getMessage()); // Error logger
        throw new Exception("Auditing error: ", $e);
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

    ?>