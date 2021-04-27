<?php
    require 'config.php';
    session_start();

    $currentUser = $_SESSION["userid"];
    $msgContent = $_POST["message"];
    $msgTimestamp = $_POST["timestampp"];

    $sql = "INSERT INTO messages(userfrom, timestampp,content) VALUES ('$currentUser','$msgTimestamp','$msgContent')";
    try {
        mysqli_query($conn, $sql);
    } catch (Exception $th) {
        echo $th;
    }
?>