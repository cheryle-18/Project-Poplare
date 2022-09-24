<?php
    require_once("./conn.php");

    if(isset($_REQUEST["qty"])){
        $qty = $_REQUEST["qty"];
        
        if(isset($_SESSION["username"])){
            $username = $_SESSION["username"];
        }
        else{
            header("Location: login.php");
            exit;
        }
    }
?>