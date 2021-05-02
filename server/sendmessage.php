<?php
    require 'config.php';
    session_start();

    $currentUser = $_SESSION["userid"]; //stochez id-ul userului din sesiuena curenta
    $msgContent = $_POST["message"];    //stochez mesajul text
    $msgTimestamp = $_POST["timestampp"];   //stochez timestamp-ul la care s-a trimis mesajul
    $image = $_FILES["fileToUpload"]["name"];   //stochez ce a uploadat user-ul 

    if (isset($image)) {//daca s-a incarcat o imagine
        $filefolder = '../uploads/';   //stochez path-ul folder-ului unde incarc fisierul
        $tmpfilename = $_FILES["fileToUpload"]["tmp_name"];     //fisierul inainte de upload va fi mutat intr-un folder temporar
        $filesize = $_FILES["fileToUpload"]["size"];    //marimea in bytes

        //aici trebuie facute niste validari

        //trebuie incarcat in baza de date numele pozei . incarc in tabelul mesaje practic 
        $sql = "INSERT INTO messages(userfrom, timestampp,content) VALUES ('$currentUser','$msgTimestamp','$image')";
        mysqli_query($conn, $sql);

        //upload-ul efectiv al pozei
        move_uploaded_file($tmpfilename, $filefolder . $image);
    }

    //incarcam mesajul text
    $sql = "INSERT INTO messages(userfrom, timestampp,content) VALUES ('$currentUser','$msgTimestamp','$msgContent')";
    try {
        mysqli_query($conn, $sql);
    } catch (Exception $th) {
        echo $th;
    }
?>