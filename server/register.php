<?php
    require "config.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    //se pot face mai multe validari aici 
    //sau direct din front end 
    echo $username . $password;

    $sql = "INSERT INTO users(username, password, idgrad) VALUES ('$username','$password',1);";
    mysqli_query($conn, $sql);

    $sql = "SELECT id from users where username = '$username'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    session_start();
    $_SESSION["userid"] = $result["id"];

    header("Location:../index.php");
?>