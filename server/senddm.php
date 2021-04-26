<?php
    require 'config.php';

    $msgUser = $_POST["new_user"];
    $msgContent = $_POST["message"];
    $msgTimestamp = $_POST["timestampp"];

    if((int)$msgUser == 0) //daca mi se transmite un nume in loc de id pt user-ul la care se trimite dm-ul
        $msgUser = getidRecord($conn , "users" , "username" , $msgUser) or die("Acest utilizator nu exista pe chat. ");
    //luam id-ul userului cu numele dat in formular 
    $sql = "INSERT INTO `direct_messages`(`userfrom`, `userto`, `timestampp`, `content`) VALUES (3,'$msgUser','$msgTimestamp','$msgContent')";
    try {
        mysqli_query($conn, $sql);
    } catch (Exception $th) {
        echo $th;
    }


    //returns the id (int) of record with given fieldname value from a given table
    function getidRecord($connection, $tablename , $fieldname , $fieldvalue){
        $sql = "SELECT id FROM " . $tablename . " WHERE " . $fieldname . " = '". $fieldvalue . "'";
        $result = mysqli_fetch_assoc(mysqli_query($connection,$sql));
        return $result["id"];
    }
?>