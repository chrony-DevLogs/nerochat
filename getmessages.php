<?php 
    $conn = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($conn, "nerochat");
    $query = "SELECT username, message, time FROM messages ORDER BY time ASC";
    $send = mysqli_query($conn,$query);
    $data = array();

    while ($res = mysqli_fetch_array($send)) {
        $data[] = array(
            'name' => $res['username'],
            'message' => $res['message'],
            'time' => $res['time']
        );
    }
    
    echo json_encode($data);

    mysqli_close($conn);

?>