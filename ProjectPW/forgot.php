<?php
    require_once("conn.php");

    //check submit
    if  (isset($_POST["btnReset"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        
        //get user
        $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user = $stmt->fetch_assoc();
        if($user!=null){
            $db_email = $user["email"];
        }
        else{
            echo "<script>alert('Username not registered')</script>";
            $db_email = "";
        }
        

        //check input email similiar with email in database
        if ( $db_email!="" && $email==$db_email){
            // make random code
            $code = '123456789qazwsxedcrfvtgbyhnujmikolp';
            $code = str_shuffle($code);
            $code = substr($code,0, 10);

            // for send token
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $alamat = "https://naturalesite.000webhostapp.com/update.php?code=$code&username=$username";
            $to = $db_email;
            $judul = "Account Password Reset";
            $isi = '<div style="text-align: center;">
                        <h3>Click the button below to reset your password</h3>
                        <button style="background-color: #013221; color: white; border: none; padding: 10px; border-radius: 5px; padding: 15px;">
                        <a href="'.$alamat.'" style="text-decoration:none;color:white;">Reset Password</a>
                    </div>';
            $headers .= "From: password-reset@poplare.com" . "\r\n";
            mail($to,$judul,$isi,$headers);
            
            $stmt = $conn->prepare("UPDATE users SET token=? WHERE username=?");
            $stmt->bind_param("ss", $code, $username);
            if ($stmt->execute()){
                echo "<script>alert('Please check your email to reset your password')</script>";
            }
            else{
                echo "<script>alert('Please try again')</script>";
            }
        }
        else{   
            echo "<script>alert('Email not registered')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            <h1 class="mb-4">Forgot Password</h1>
            <div class="resetCard rounded">
                <form action="#" method="POST" id="formForgot">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <button id="btnReset" name="btnReset" class="btn mb-3 mt-3" style="background-color: #013221; color: white; width: 100%">Request Password Reset</button>
                </form>
            </div>
            <div class="detail mt-3">
                <a href="login.php">Return to Login Page</a>
            </div>
        </div>
        <div class="right col-md-6 d-none d-lg-block px-0 "></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>