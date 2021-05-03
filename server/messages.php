<?php
    require 'config.php';
    
    $sql = "SELECT messages.content,users.username,users.idgrad FROM messages INNER JOIN users on messages.userfrom = users.id ORDER BY messages.timestampp DESC";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $contentMsg = strtolower($row["content"]);//stochez cu litere mici valoarea curenta
            //stochez in variabila isImage daca e path de imagine 
            $isImage = strpos($contentMsg, ".jpg") || strpos($contentMsg, ".png") || strpos($contentMsg, ".jpeg");

            if ($isImage) {//daca e path-ul catre o poza (deci daca contine jpg sau jpeg sau png)
                echo "<p>" . $row["username"] . " <img src=uploads/". $row["content"]. " width=100 height=100>  </p>";
            }

            if ($row["idgrad"] == 2) //mesaj trimis de moderator
                echo '<p style="color: #d8b41f "> (Moderator) '. $row["username"]. " : " . $row["content"]. "</p>";
            else if ($row["idgrad"] == 3) //mesaj trimis de admin
                echo '<p style="color: #17eae4 "> (Admin) '. $row["username"]. " : " . $row["content"]. "</p>";
            else 
                echo "<p> ". $row["username"]. " : " . $row["content"]. "</p>";
        }
    } else {
    echo "0 results";
    }
?>