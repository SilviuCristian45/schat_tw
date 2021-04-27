<?php
    require "config.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    //se pot face mai multe validari aici 
    //sau direct din front end  

    $sql = "SELECT * FROM users where username = '$username';";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    if ($result["password"] == $password) {//daca parolele sunt bune
        session_start();
        $_SESSION["userid"] = $result["id"];
        header("Location:../index.php");
    }
    else {
        echo "Eroare . Parola sau username incorecte";
    }    
?>