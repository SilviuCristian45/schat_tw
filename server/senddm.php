<?php
    require 'config.php';
    session_start();

    $currentUser = $_SESSION["userid"];
    $msgUser = $_POST["new_user"];
    $msgContent = $_POST["message"];
    $msgTimestamp = $_POST["timestampp"];
    $image = $_FILES["fileToUpload"]["name"];

    if (isset($image)) {//daca s-a incarcat o imagine
        $filefolder = '../uploads/';   //stochez path-ul folder-ului unde incarc fisierul
        $tmpfilename = $_FILES["fileToUpload"]["tmp_name"];     //fisierul inainte de upload va fi mutat intr-un folder temporar
        $filesize = $_FILES["fileToUpload"]["size"];    //marimea in bytes

        //aici trebuie facute niste validari

        //trebuie incarcat in baza de date numele pozei . incarc in tabelul mesaje practic 
        $sql = "INSERT INTO direct_messages(userfrom, userto, timestampp,content) VALUES ('$currentUser','$msgUser','$msgTimestamp','$image')";
        mysqli_query($conn, $sql);

        //upload-ul efectiv al pozei
        move_uploaded_file($tmpfilename, $filefolder . $image);
    }

    if((int)$msgUser == 0) //daca mi se transmite un nume in loc de id pt user-ul la care se trimite dm-ul
        $msgUser = getidRecord($conn , "users" , "username" , $msgUser) or die("Acest utilizator nu exista pe chat. ");
    //luam id-ul userului cu numele dat in formular 
    $sql = "INSERT INTO `direct_messages`(`userfrom`, `userto`, `timestampp`, `content`) VALUES ('$currentUser','$msgUser','$msgTimestamp','$msgContent')";
    try {
        mysqli_query($conn, $sql);
        echo "Conversatie creata cu succes. Click pe sectiunea direct messages pentru a deschide conversatia";
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