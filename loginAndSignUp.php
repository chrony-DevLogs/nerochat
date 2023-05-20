<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sOrL = $_POST["sOrL"];
        $username = $_POST["name"];
        $passwd = $_POST["passwd"];
        
        $conn = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($conn,"nerochat");

        if($username == "" || $passwd == "" ){
            die("<h1> ERROR USERNAME AND PASSWORD MUST BE NOT NULL </h1>");
        }elseif($sOrL == "sign up"){
            $query = "INSERT INTO user VALUES('$username','$passwd')";
            if(!mysqli_query($conn,$query)){
                die("<h1>CANNOT SIGN UP</h1>");
            }else{
                echo("<h1>SIGN UP SUCESS</h1>");
            };
            
        }else{
            $query = "SELECT user.username, user.passwd FROM user WHERE username = '$username' AND passwd = '$passwd'";
            $res = mysqli_query($conn,$query);
            $filterRes = mysqli_fetch_array($res);
            if($filterRes != null){
                session_start();
                $_SESSION["username"] = $username;
                header("Location: index.php");
                
            }
        }
        mysqli_close($conn);
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
        <input type="text" name="name" placeholder="username"><br>
        <input type="text" name="passwd" placeholder="password"><br>
        login: <input type="radio" value="log in" name="sOrL" id="sOrL">
        sign up: <input type="radio" value="sign up" name="sOrL" id="sOrL2"><br>

        <input type="submit" value="SELECT" id="sub">
    </form>

    <script>
        document.getElementById("sub").disabled = true
        document.getElementsByName("sOrL").forEach(e => {
            e.addEventListener("click",()=>{    
                if(e.checked){
                    document.getElementById("sub").value = e.value;
                    document.getElementById("sub").disabled = false

                }
            })
        })
    </script>
</body>
</html>