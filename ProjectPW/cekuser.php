<?php
    require_once("conn.php");

    $stmt = $conn->query("SELECT * FROM users");
    $users = $stmt->fetch_all(MYSQLI_ASSOC);

    if(isset($_POST["loginAdmin"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if($username=="" || $password==""){
            $_SESSION["message"] = "Please fill in all fields";
        }
        else{
            if($username=="admin" && $password=="admin"){
                $_SESSION["username"] = "admin";
            }
        }
        header("Location: loginadmin.php");
    }

    if(isset($_POST["login"]) && !isset($_POST["loginAdmin"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        if($username=="" || $password==""){
            $_SESSION["message"] = "Please fill in all fields";
        }
        else{
            // if($username=="admin" && $password=="admin"){
            //     $_SESSION["username"] = "admin";
            //     $_SESSION["message"] = "admin";
            // }
            // else{
                $ada = false;
                foreach($users as $key => $value){
                    if($value["username"]==$username && $value["status"]==1){
                        $ada = true;
                        if($value["password"]==md5($password)){
                            $_SESSION["username"] = $username;
                            $_SESSION["message"] = "ok";
                        }
                        else{
                            $_SESSION["message"] = "Incorrect password";
                        }
                    }
                }
                if($ada==false){
                    $_SESSION["message"] = "Username not found";
                }
            // }
        }
        echo $_SESSION["message"];
    }

    if(!isset($_POST["register"]) && !isset($_POST["login"]) && !isset($_POST["loginAdmin"])){
        if(isset($_REQUEST["user"])){
            $usern = $_REQUEST["user"];
            $stmt = $conn->query("SELECT * FROM users WHERE username='$usern'");
            $user = $stmt->fetch_assoc();
            if($user=="" && $usern!="admin"){
                echo "Username not found";
            }
        }
        if(isset($_REQUEST["passlogin"])){
            $pass = $_REQUEST["passlogin"];
            $usern = $_REQUEST["userlogin"];
            if($user!="" && $usern!="admin"){
                $stmt = $conn->query("SELECT * FROM users WHERE username='$usern'");
                $user = $stmt->fetch_assoc();
                if($user!=null && $user["password"]!=md5($pass)){
                    echo "Incorrect password";
                }
            }
        }
        if(isset($_REQUEST["conf"])){
            $pass = $_REQUEST["pass"];
            $conf = $_REQUEST["conf"];
            if($pass!=$conf){
                echo "Confirm password is incorrect";
            }
        }
        if(isset($_REQUEST["email"])){
            $email = $_REQUEST["email"];
            $stmt = $conn->query("SELECT * FROM users WHERE email='$email'");
            $user = $stmt->fetch_assoc();
            if($user!=""){
                echo "Email is already registered";
            }
        }
        if(isset($_REQUEST["username"])){
            $username = $_REQUEST["username"];
            $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
            $user = $stmt->fetch_assoc();
            if($user!=""){
                echo "Username taken";
            }
        }
    }
    if(isset($_POST["register"])){
        unset($_SESSION["message"]);
        $username = $_POST["username"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm = $_POST["confirm"];

        if($username=="" || $name=="" || $email=="" || $password=="" || $confirm==""){
            $_SESSION["message"] = "Please fill in all fields";
        }
        else if($password != $confirm){
            $_SESSION["message"] = "Incorrect password confirmation";
        }
        else{
            $kembar = false;
            $kembar2 = false;
            foreach($users as $key => $value){
                if($value["username"]==$username){
                    $kembar = true;
                    break;
                }
                if($value["email"]==$email){
                    $kembar2 = true;
                    break;
                }
            }
            if($kembar==false && $kembar2==false){
                $member = 0;
                $point = 0;
                $encrypt = md5($password);
                $stmt = $conn->prepare("INSERT INTO users (username, password, name, email, member, point) VALUES (?, ?, ?, ?, ?, ?) ");
                $stmt->bind_param("ssssii", $username, $encrypt, $name, $email, $member, $point);
                $result =$stmt->execute();

                $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
                $currUser = $stmt->fetch_assoc();
                $idUser = $currUser["id_user"];
                
                $stmt = $conn->prepare("INSERT INTO shipping (id_user) VALUES (?) ");
                $stmt->bind_param("i", $idUser);
                $result =$stmt->execute();

                if($result){
                    $_SESSION["message"] = "Register success!";
                }
            }
            else{
                if($kembar){
                    $_SESSION["message"] = "Username taken";
                }
                else if($kembar2){
                    $_SESSION["message"] = "Email is already registered";
                }
            }
        }
        echo $_SESSION["message"];
    }

    mysqli_close($conn);
?>