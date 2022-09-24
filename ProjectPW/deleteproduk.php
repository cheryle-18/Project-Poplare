<?php
    require_once("conn.php");
    $id = $_POST["barang_ID"];
    
    $result = $conn->query("DELETE FROM items WHERE ID= '$id'");    
    if($result){
        echo 1;
    }
    else{
        echo 0;
    }
?>