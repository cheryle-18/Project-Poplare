<?php
    session_start();
    if(isset($_SESSION["username"])){
        $location = "useraccount.php";
    }
    else{
        $location = "login.php";
    }
    if(isset($_SESSION["message"])){
        unset($_SESSION["message"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <style>
        html,body{
            min-height: 100%;
            background-color: #013221;
        }
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            width: 100%;
        }
        .content{
            width: 100%;
            height:100%;
            display: flex;
            background-color: #013221;
        }
        h1{
            color: white;
            text-align: center;
        }
        .left{
            padding: 5% 7%;
        }
        .regCard{
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
            background-image: url("./asset/bg2.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            min-height: 100%;
        }
        .regCard{
            display: none;
        }
    </style>
    <script>
        $(document).ready(function (params) {
            $(".regCard").fadeIn();
            
            $("#btnRegister").click(function () {
                $.post("cekuser.php",$("#formCek").serialize(),function(res){
                    if(res=="Register success!"){
                        var txt = `<div class="alert alert-success text-center" role="alert" id="txt" style="position:fixed;top:0px;left:0px;width:100%;display:none;background-color:green; color:white;font-size:1.3em;">Register success!</div>`;
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
    <div class="content" id="content">
        <div class="row w-100 mx-0">
            <div class="left col-12 col-lg-6 d-flex flex-column justify-content-center">
            <h1 class="mb-4">Register</h1>  
            <div class="regCard rounded">
                <form action="cekuser.php" method="POST" id="formCek">
                    <div class="mb-3">
                        <input type="hidden" name="register" value="true">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                        <div class="text-muted" id="emailText" style="text-align: right;"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username">
                        <div class="text-muted" id="usernameText" style="text-align: right;"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm" class="form-control" id="confirm" placeholder="Enter password confirmation">
                        <div class="text-muted" id="confirmText" style="text-align: right;"></div>
                    </div>
                </form>
                <button id="btnRegister" class="btn mb-3 mt-3" style="background-color: #013221; color: white; width: 100%">R E G I S T E R</button>
            </div>
            <div class="detail mt-3">
                Already have an account?
                <a href="login.php">Login</a>
            </div>
        </div>
        <div class="right col-md-6 d-none d-lg-block px-0"></div>
        </div>
    </div>

    <script>
        $("document").ready(function(){
            $("#email").blur(function(){
                paramEmail = $("#email").val();
                $.post("cekuser.php", {email: paramEmail}, function(data, status){
                    if(data!=""){
                        $("#emailText").html(data);
                        h = parseInt($("#content").css("height"));
                        h += 20;
                        $("#content").css("height", h+"px");
                    }
                    else{
                        $("#emailText").html("");
                        h = parseInt($("#content").css("height"));
                        if(h>830){
                            h -= 20;
                        }
                        $("#content").css("height", h+"px");
                    }
                });
            });
            $("#username").blur(function(){
                paramUname = $("#username").val();
                $.post("cekuser.php", {username: paramUname}, function(data, status){
                    if(data!=""){
                        $("#usernameText").html(data);
                        h = parseInt($("#content").css("height"));
                        h += 20;
                        $("#content").css("height", h+"px");
                    }
                    else{
                        $("#usernameText").html("");
                        h = parseInt($("#content").css("height"));
                        if(h>830){
                            h -= 20;
                        }
                        $("#content").css("height", h+"px");
                    }
                });
            });
            $("#confirm").blur(function(){
                paramConf = $("#confirm").val();
                paramPass = $("#password").val();
                $.post("cekuser.php", {conf: paramConf, pass: paramPass}, function(data, status){
                    if(data!=""){
                        $("#confirmText").html(data);
                        h = parseInt($("#content").css("height"));
                        h += 20;
                        $("#content").css("height", h+"px");
                    }
                    else{
                        $("#confirmText").html("");
                        h = parseInt($("#content").css("height"));
                        if(h>830){
                            h -= 20;
                        }
                        $("#content").css("height", h+"px");
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>