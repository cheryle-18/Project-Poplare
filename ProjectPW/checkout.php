<?php
    require_once("./conn.php");
    //get user
    $username = $_SESSION["username"];
    $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $stmt->fetch_assoc();
    $idUser = $user["id_user"];

    $stmt = $conn->query("SELECT * FROM cart WHERE id_user='$idUser'");
    $cartItems = $stmt->fetch_all(MYSQLI_ASSOC);
    
    $stmt = $conn->query("SELECT SUM(qty) as qty FROM cart WHERE id_user='$idUser'");
    $result = $stmt->fetch_assoc();

    $stmt = $conn->query("SELECT SUM(subtotal) as total FROM cart WHERE id_user='$idUser'");
    $result2 = $stmt->fetch_assoc();

    $total = $result2["total"];
    $qty = $result["qty"];
    $status = "Pending"; //hrse pending biar baru diproses stlh bayar tp gtw gmn carae confirm sdh bayar blm
    // $status = "In Process";
    $points_used = $_SESSION["redeemPoint"] ?? 0;
    if(isset($_SESSION["redeemPoint"])){
        $points_used = $_SESSION["redeemPoint"];
        unset($_SESSION["redeemPoint"]);
    }
    $total -= ($points_used*1000);
    
    if($user["member"]==1){
        $points_received = floor($total / 10000);
    }
    else{
        $points_received = 0;
    }

    //add hTrans
    $idHtrans = $_SESSION["idHtrans"];
    unset($_SESSION["idHtrans"]);
    $stmt = $conn->prepare("INSERT INTO h_trans(id_htrans, id_user, total, qty, points_received, points_used, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiiis", $idHtrans, $idUser, $total, $qty, $points_received, $points_used, $status);
    // $stmt = $conn->prepare("INSERT INTO h_trans(id_user, total, qty, points_received, points_used, status) VALUES (?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("iiiiis", $idUser, $total, $qty, $points_received, $points_used, $status);
    $stmt->execute();
    
    //add dTrans
    foreach($cartItems as $key => $value){
        $idItem = $value["id_item"];
        $stmt = $conn->query("SELECT SUM(qty) as qtyBrg FROM cart WHERE id_item='$idItem'");
        $result = $stmt->fetch_assoc();
        $qtyBrg = $result["qtyBrg"];

        $stmt = $conn->prepare("INSERT INTO d_trans(id_htrans, id_item, qty) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $idHtrans, $idItem, $qtyBrg);
        $stmt->execute();
       
        $stmt = $conn->query("SELECT * FROM items WHERE ID='$idItem'");
        $currItem = $stmt->fetch_assoc();

        $stock = $currItem["Stock"];
        $stockBaru = $stock - $value["qty"];

        $totBuy = $currItem["total_buy"];
        $totBuyBaru = $totBuy + $value["qty"];
        
        $stmt = $conn->prepare("UPDATE items SET Stock=?, total_buy=? WHERE ID=?");
        $stmt->bind_param("iii", $stockBaru, $totBuyBaru, $idItem);
        $stmt->execute();
    }

    //minus points
    $newPoint = $user["point"] - $points_used;
    $stmt = $conn->prepare("UPDATE users SET point=? WHERE id_user=?");
    $stmt->bind_param("ii", $newPoint, $idUser);
    $stmt->execute();

    //delete from cart
    $stmt = $conn->query("DELETE FROM cart WHERE id_user='$idUser'");

    echo "Thank you for buying :)!";
?>