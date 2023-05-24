<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sOrL = $_POST["sOrL"];
        $username = $_POST["name"];
        $passwd = $_POST["passwd"];
        
        $conn = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($conn,"nerochat");

        if(($username == "" || $passwd == "") || (strlen($username) < 3) || (strlen($passwd) < 8)){
            echo("<h1 class='ro'> ERROR USERNAME MUST BE AT LEAST 3 CHARACTER LONG <br><br> AND PASSWORD MUST BE ATLEAST 8 CHARACTER LONG </h1>");
        }elseif($sOrL == "sign up"){
            $query = "INSERT INTO user VALUES('$username','$passwd')";
            if(!mysqli_query($conn,$query)){
                echo("<h1 class='ro'>CANNOT SIGN UP</h1>");
            }else{
                echo("<h1 class='ro'>SIGN UP SUCESS</h1>");
            };
            
        }else{
            $query = "SELECT user.username, user.passwd FROM user WHERE username = '$username' AND passwd = '$passwd'";
            $res = mysqli_query($conn,$query);
            $filterRes = mysqli_fetch_array($res);
            if($filterRes != null){
                session_start();
                $_SESSION["username"] = $username;
                header("Location: index.php");
                
            }else{
                echo("<h1 class='ro'>USER NAME OR PASSWORD IS NOT CORRECT</h1>");
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
        <style>
    .ro{ 
            color: red;
            text-align: center;
            background-color: #0B0B0B;
            font-family: 'Press Start 2P', cursive;
            padding: 20px;
            font-size: 20px;
        }

    </style>
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
            <h1 class="intro fa" id="intr">START CHATTING </h1><h1 class="fa" id="curser"></h1> <br>                <input class="inp" type="text" name="name" placeholder="username"><br>
                <input class="inp" type="password" name="passwd" placeholder="password"><br>
                <input class="sub" type="submit" value="SELECT" id="sub">
            </div>
        </div>

    </form>

    <script>
        document.getElementsByName("sOrL").forEach((e)=>{
            e.checked =false;
        })
        const rap = document.getElementById("sub")
        rap.disabled = true

        document.getElementsByName("sOrL").forEach(e => {
            e.addEventListener("click",()=>{    
                if(e.checked){
                    document.getElementById("sub").value = e.value;
                    document.getElementById("sub").disabled = false
                }
            })
        })

        function animate(target,str){
            target.innerHTML = "";
            i=0;

            setInterval(()=>{
                if(i > str.length -1){
                    target.innerHTML = "";
                    i = 0;
                    target.style.width = 0;
                }
                target.innerHTML += str[i];
                i++
            },400)
            
        }
        const target = document.getElementById("intr")
        const str = "START CHATTING";
        animate(target,str)

    </script>
</body>
</html>