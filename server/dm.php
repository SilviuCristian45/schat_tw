<?php
    require '../server/config.php';

    $userto = $_GET["userto"];

    $sql = "SELECT direct_messages.timestampp,direct_messages.content,
    direct_messages.userfrom FROM `direct_messages` 
    WHERE (direct_messages.userfrom = 3 and direct_messages.userto = " . $userto . ") or 
    (direct_messages.userto = 3 and direct_messages.userfrom = ". $userto .") ORDER BY timestampp";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p> " . $row["timestampp"] . " ";
        if ($row["userfrom"] == 3) //in loc de 3 va trebui sa fie id-ul userului curent
            echo "(tu) : ";
        else echo "(el/ea) : ";
        echo $row["content"] . "</p>";
    }
?>