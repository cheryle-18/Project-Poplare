<?php
    session_start();
    if(isset($_SESSION["message"])){
        unset($_SESSION["message"]);
    }

    if(isset($_SESSION["username"])){
        if($_SESSION["username"]=="admin"){
            header("Location: masterproduct.php");
        }
        else{
            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .loginCard{
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
    <script>
        $(document).ready(function () {
            $(".left").fadeIn();
            $("#btnLogin").click(function () {
                $.post("cekuser.php",$("#formLogin").serialize(),function(res){
                    if(res=="ok"){
                      window.location.href = "index.php";
                    }
                    // else if(res == "admin"){
                    //     window.location.href = "masterproduct.php";
                    // }
                    else{
                        var txt = `<div class="alert alert-danger text-center" role="alert" id="txt" style="position:fixed;top:0px;left:0px;width:100%;display:none;font-size:1.3em;">`+res+`!</div>`;
                        //set timeout
                        $("body").append(txt);
                        $("#txt").fadeIn(200,function () {
                        });
                            var timeout = setTimeout(() => {
                            clearTimeout(timeout);
                            $("#txt").slideUp("slow",function () {
                                $("#txt").remove();   
                            });
                        },2000);    
                    }
                })
            })
        })
    </script>
</head>
<body>
    <div class="content">
        <div class="row w-100 mx-0">
        <div class="left col-12 col-lg-6 d-flex flex-column justify-content-center">
            <h1 class="mb-4">Login</h1>
            <div class="loginCard rounded">
                <form action="cekuser.php" method="POST" id="formLogin">
                    <input type="hidden" name="login" value="true">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username">
                        <div id="userText" class="text-muted" style="text-align: right;"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                        <div id="passText" class="text-muted" style="text-align: right;"></div>
                    </div>
                </form>
                <a href="forgot.php" style="color: #013221; text-decoration: none;">Forgot Password</a>
                <button id="btnLogin" class="btn mb-3 mt-3" style="background-color: #013221; color: white; width: 100%">L O G I N</button>
            </div>
            <div class="detail mt-3">
                Don't have an account?
                <a href="register.php">Register</a>
            </div>
        </div>
        <div class="right col-md-6 d-none d-lg-block px-0 "></div>
        </div>
    </div>

    <script>
        $("document").ready(function(){

            $("#username").blur(function(){
                paramUser = $("#username").val();
                $.post("cekuser.php", {user: paramUser}, function(data, status){
                    if(data!=""){
                        $("#userText").html(data);
                    }
                    else{
                        $("#userText").html("");
                    }
                });
            });
            $("#password").blur(function(){
                paramPass = $("#password").val();
                paramUser = $("#username").val();
                $.post("cekuser.php", {passlogin: paramPass, userlogin: paramUser}, function(data, status){
                    if(data!=""){
                        $("#passText").html(data);
                    }
                    else{
                        $("#passText").html("");
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>