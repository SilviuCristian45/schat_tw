<?php
    require 'config.php';
    
    $sql = "SELECT messages.content,users.username FROM messages INNER JOIN users on messages.userfrom = users.id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<p> ". $row["username"]. " : " . $row["content"]. "</p>";
        }
    } else {
    echo "0 results";
    }
?>