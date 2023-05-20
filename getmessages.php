<?php 
    $conn = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($conn, "nerochat");
    $query = "SELECT username, message, time FROM messages ORDER BY time ASC";
    $send = mysqli_query($conn,$query);
    
    while($res = mysqli_fetch_array($send)){
        echo($res["username"] . "," . $res["message"] . "," . $res["time"] . "|");
    }
    
    mysqli_close($conn);

?>