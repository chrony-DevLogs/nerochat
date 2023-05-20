<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    $conn = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($conn, "nerochat");
    session_start();
    $session = $_SESSION["username"];
    $text = $_POST["message"] ;
   if($text !=""){
    $text = trim($text);
    $query = "INSERT INTO messages(username,date,time,message) VALUES ('$session',CURRENT_DATE,CURRENT_TIME,'$text')";
    if (mysqli_query($conn, $query)) {
        echo "YES";
    } else {
        echo "NO";
    }
   }

    mysqli_close($conn);

}
?>