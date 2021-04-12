<?php
    require 'config.php';
    
    $msgContent = $_POST["message"];
    $msgTimestamp = $_POST["timestampp"];

    $sql = "INSERT INTO messages(userfrom, timestampp,content) VALUES (1,'$msgTimestamp','$msgContent')";
    try {
        mysqli_query($conn, $sql);
    } catch (Exception $th) {
        echo $th;
    }
?>