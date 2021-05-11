<?php
    require 'config.php';
    
    if(isset($_GET["currentTime"]))//daca s-a trimis timestampului ultimului mesaj afisat
        $currentTime = $_GET["currentTime"];
    else $currentTime = "0";
    $sql = "SELECT messages.timestampp,messages.id,messages.content,users.username,users.idgrad FROM messages INNER JOIN users on messages.userfrom = users.id ORDER BY messages.timestampp DESC";
    $result = mysqli_query($conn, $sql);
    
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if($row["timestampp"] > $currentTime){//daca au aparut mesaje fata de ultimul
                $contentMsg = strtolower($row["content"]);//stochez cu litere mici valoarea curenta
                //stochez in variabila isImage daca e path de imagine 
                $isImage = strpos($contentMsg, ".jpg") || strpos($contentMsg, ".png") || strpos($contentMsg, ".jpeg");
                $isVideo = strpos($contentMsg, ".m4v") || strpos($contentMsg, ".mp4");
                if ($isImage) {//daca e path-ul catre o poza (deci daca contine jpg sau jpeg sau png)
                    echo "<p>" . $row["username"] . " <img src=uploads/". $row["content"]. " width=100 height=100>  </p>";
                }
                if ($isVideo) {
                    $videoContent = "<video width=300 height=200 controls>
                        <source src=uploads/".$row["content"].">
                    </video>";
                    echo "<p> (" . $row["timestampp"] . ") ". $row["username"] . " '$videoContent .  </p>";
                }

                if ($row["idgrad"] == 2) //mesaj trimis de moderator
                    echo '<p style="color: #d8b41f "> (Moderator) ('. $row["timestampp"] . ") ". $row["username"]. " : " . $row["content"]. "</p>";
                else if ($row["idgrad"] == 3) //mesaj trimis de admin
                    echo '<p style="color: #17eae4 "> (Admin) ('. $row["timestampp"] . ") ". $row["username"]. " : " . $row["content"]. "</p>";
                else if (!$isVideo && !$isImage)
                    echo "<p> (". $row["timestampp"] . ")  ".$row["username"]. " : " . $row["content"]. "</p>";    
        
                }
            }
    } else {
    echo "0 results";
    }
?>