<?php
    require_once("conn.php");
    $kode=$_GET['code'];
    $username = $_GET['username'];


    if (isset($kode) && isset($username)){
        //get user
        $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user = $stmt->fetch_assoc();
        $token = $user["token"];
        $db_username = $user["username"];

        //check between tokens & usernames
        if ($token==$kode && $db_username==$username){
            if  (isset($_POST["btnResetPass"])) {
                $password = $_POST["password"];
                $conf = $_POST["confirm"];

                if ($password==$confirm) {
                    $encrypt = md5($password);
                    $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
                    $stmt->bind_param("ss", $encrypt, $username);
                    header("Location: login.php");
                }
                else{
                    echo "<script>alert('Wrong confirm password')</script>";
                }
            }
        }
        else{
            echo "<script>alert('Wrong code and username')</script>";
        }
    }
    else{
        echo "<script>alert('Wrong link')</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            width: 100%;
        }
        .content{
            width: 100%;
            min-height: 100vh;
            display: flex;
            background-color: #013221;
        }
        h1{
            color: white;
            text-align: center;
        }
        .left{
            padding: 7% 10%;
        }
        .resetCard{
            background-color: #f5f3f0;
            padding: 50px;
        }
        .detail{
            color: white;
            text-align: center;
        }
        a{
            color: white;
        }
        a:hover{
            color: #A3CFBB;
        }
        .right{
            width: 50%;
            background-image: url("./asset/bg2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .left{
            display: none;
        }
    </style>
</head>
<body>
    <div class="content">
    <div class="row w-100 mx-0">
        <div class="left col-12 col-lg-6 d-flex flex-column justify-content-center">
            <h1 class="mb-4">Reset Password</h1>
            <div class="resetCard rounded">
                <form action="#" method="POST" id="formReset">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your new password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm" class="form-control" id="confirm" placeholder="Confirm your password">
                    </div>
                    <button id="btnResetPass" class="btn mb-3 mt-3" style="background-color: #013221; color: white; width: 100%">Reset Password</button>
                </form>
            </div>
        </div>
        <div class="right col-md-6 d-none d-lg-block px-0 "></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
