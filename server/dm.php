<?php
    require '../server/config.php';
    session_start();
    $userto = $_GET["userto"];

    $sql = "SELECT direct_messages.timestampp,direct_messages.content,
    direct_messages.userfrom FROM `direct_messages` 
    WHERE (direct_messages.userfrom = ".$_SESSION["userid"]." and direct_messages.userto = " . $userto . ") or 
    (direct_messages.userto = ".$_SESSION["userid"]." and direct_messages.userfrom = ". $userto .") ORDER BY direct_messages.timestampp DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p> " . $row["timestampp"] . " ";
        if ($row["userfrom"] == $_SESSION["userid"]) //in loc de 3 va trebui sa fie id-ul userului curent
            echo "<b> (tu) : ";
        else echo "(el/ea) : ";

        
        $contentMsg = strtolower($row["content"]);//stochez cu litere mici valoarea curenta
        //stochez in variabila isImage daca e path de imagine 
        $isImage = strpos($contentMsg, ".jpg") || strpos($contentMsg, ".png") || strpos($contentMsg, ".jpeg");

        if ($isImage) {//daca e un path de poza si nu text
            echo "<img src=../uploads/". $row["content"]. " width=100 height=100>  </p>";
        }
        else 
            echo $row["content"] . "</b> </p>";
    }
?>