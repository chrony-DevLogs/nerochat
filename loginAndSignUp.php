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
    <link rel="icon" type="image/png" href="./logos/nerochatlogo.svg">
    <link rel="stylesheet" href="./loginStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <form class="form" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
        <div  class="cont1">
            <div class="insideCount">
                <h1 class="logo">NERO<br>CHAT</h1>
                <div class="radspan">
                    <div class="sar sar1">
                        <span>log in</span><br>
                        <span>sign up</span> 
                    </div>
                    <div class="sar">
                        <input type="radio" value="log in" name="sOrL" id="sOrL"><br>
                        <input type="radio" value="sign up" name="sOrL" id="sOrL2"><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="cont2">
            <div class="insideCount insideCount2">
                <h1 class="intro">START CHATTING</h1>
                <input class="inp" type="text" name="name" placeholder="username"><br>
                <input class="inp" type="password" name="passwd" placeholder="password"><br>
                <input class="sub" type="submit" value="SELECT" id="sub">
            </div>
        </div>

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