<?php
    require "config.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    //echo $username . $password;

    //query pentru validare daca exista acest username in baza de date
    $sqlValidare = "SELECT username FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $sqlValidare);

    //daca deja exista username-ul in baza de date
    if(mysqli_num_rows($result)) die("Inregistrare esuata deoarece acest username deja exista");
     
    $sql = "INSERT INTO users(username, password, idgrad) VALUES ('$username','$password',1);";
    mysqli_query($conn, $sql);

    $sql = "SELECT id from users where username = '$username'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    //deschidem sesiunea utilizatorului si o setam
    session_start();
    $_SESSION["userid"] = $result["id"];
    header("Location:../index.php");
?>