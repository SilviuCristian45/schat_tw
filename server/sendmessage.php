<?php
    require 'config.php';
    
    $msgContent = $_POST["message"];
    $msgTimestamp = $_POST["timestampp"];

    //echo $msgContent . " " . $msgTimestamp;

    $sql = "INSERT INTO messages(userfrom, timestampp,content) VALUES (1,'$msgTimestamp','$msgContent')";
    try {
        mysqli_query($conn, $sql);
        echo "***";
    } catch (Exception $th) {
        echo $th;
        echo "...";
    }
?>