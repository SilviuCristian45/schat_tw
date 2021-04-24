<?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p> " . $row["timestampp"] . " ";
        if ($row["userfrom"] == 3) //in loc de 3 va trebui sa fie id-ul userului curent
            echo "(tu) : ";
        else echo "(el/ea) : ";
        echo $row["content"] . "</p>";
    }
?>