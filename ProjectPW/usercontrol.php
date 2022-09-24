<?php
    require_once("./conn.php");

    if(isset($_REQUEST["conf"])){
        $pass = $_REQUEST["pass"];
        $conf = $_REQUEST["conf"];
        if($pass!=$conf){
            echo "Confirm password is incorrect";
        }
    }

    else if(isset($_POST["updatePrice"])){
        $stmt = $conn->query("SELECT * FROM cart");
        $crt = $stmt->fetch_all(MYSQLI_ASSOC);

        for ($i=0; $i < count($crt); $i++) { 
            $id_item = $crt[$i]["id_item"];
            $stmt = $conn->query("SELECT * FROM items WHERE ID ='$id_item'");
            $item = $stmt->fetch_assoc();
            $price = $item["Price"]*$crt[$i]["qty"];

            $id_ct = $crt[$i]["id_cart"]; 
            $stmt = $conn->prepare("UPDATE cart SET subtotal = '$price' WHERE id_cart ='$id_ct'");
            $stmt->execute();
        }
    }

    else if(isset($_POST["id_carts"])){
        $id_cart = $_POST["id_carts"];
        $stat = $_POST["stat"];
        $stmt = $conn->query("SELECT * FROM cart WHERE id_cart='$id_cart'");
        $crt = $stmt->fetch_assoc();
        
        if($stat == 1){
            $qt = $crt["qty"]+1;
        }
        else{
            if($crt["qty"]-1>0){
                $qt = $crt["qty"]-1;
            }
            else{
                $qt = 1;
            }
        }
        
        $stmt = $conn->prepare("UPDATE cart SET qty = '$qt' WHERE id_cart ='$id_cart'");
        $stmt->execute(); 
        echo $qt;
    }

    else if(isset($_POST["getTotal"])){
        $idUser = $_POST["id_user"];
        $stmt = $conn->query("SELECT SUM(subtotal) as total FROM cart WHERE id_user='$idUser'");
        $result = $stmt->fetch_assoc();
        $total = $result["total"];
        echo "Rp ".number_format($total,0,'.','.');                
    }

    else if(isset($_POST["changePass"])){
        $password = $_POST["password"];
        $confirm = $_POST["confirm"];
        if($password==$confirm){
            $username = $_SESSION["username"];
            $encrypt = md5($password);
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
            $stmt->bind_param("ss", $encrypt, $username);
            if($stmt->execute()){
                $_SESSION["message"] = "Password successfully changed!";
            }

            header("Location: useraccount.php");
        }
        else{
            header("Location: changepass.php");
        }
    }
    else if(isset($_POST["saveInfo"])){
        $name = $_POST["name"];
        $birthdate = $_POST["birthdate"];
        $dob = date('Y-m-d', strtotime($birthdate));
        $username = $_SESSION["username"];

        $stmt = $conn->prepare("UPDATE users SET name=?, birthdate=? WHERE username=?");
        $stmt->bind_param("sss", $name, $dob, $username);
        $result = $stmt->execute();

        header("Location: editinfo.php");
    }
    else if(isset($_POST["saveShipping"])){
        $idShip = $_POST["saveShipping"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $province = $_POST["province"];
        $postcode = $_POST["postcode"];
        $phone = $_POST["phone"];

        $stmt = $conn->prepare("UPDATE shipping SET address=?, city=?, province=?, postcode=?, phone=? WHERE id_shipping=?");
        $stmt->bind_param("sssssi", $address, $city, $province, $postcode, $phone, $idShip);
        $result = $stmt->execute();

        header("Location: editshipping.php");
    }
    else if(isset($_POST["back"])){
        header("Location: useraccount.php");
    }
    else if(isset($_POST["gantipass"])){
        header("Location: changepass.php");
    }
    else if(isset($_POST["addCart"])){
        if(isset($_SESSION["username"])){
            $qty = $_POST["jumlah"] ?? 1;
            $username = $_SESSION["username"];
            $idItem = $_POST["addCart"];
    
            //get user
            $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
            $user = $stmt->fetch_assoc();
            $idUser = $user["id_user"];
    
            //get Existing
            $stmt = $conn->query("SELECT * FROM cart WHERE id_item ='$idItem'");
            $currItem = $stmt->fetch_assoc();
            if($currItem!=""){
                //get qty
                $curQTY = $currItem["qty"]+$qty;
                $cart_id = $currItem["id_cart"];
                $stmt = $conn->prepare("UPDATE cart SET qty = $curQTY where id_cart = '$cart_id'");
                $stmt->execute();
               
            }

            else{
                //get item
                $stmt = $conn->query("SELECT * FROM items WHERE ID='$idItem'");
                $currItem = $stmt->fetch_assoc();
                $harga = $currItem["Price"];
        
                $subtotal = $qty * $harga;
        
                $stmt = $conn->prepare("INSERT INTO cart(id_user, id_item, qty, subtotal) VALUES (?,?,?,?)");
                $stmt->bind_param("iiii", $idUser, $idItem, $qty, $subtotal);
                $result = $stmt->execute();
        
            }

            // if(isset($_SESSION["jmlhItem"])){
            //      unset($_SESSION["jmlhItem"]);
            //  }

            if($_POST["asal"]=="detail"){
                $location = "pagedetail.php";
            }
            else if($_SESSION["asal"]=="products"){
                $location = "products.php";
            }
            else if($_SESSION["asal"]=="search"){
                $location = "search.php";
            }
           
            header("Location: $location");
            exit;
        }
        else{
            header("Location: login.php");
            exit;
        }
    }
    else if(isset($_POST["applyMember"])){
        $idUser = $_POST["applyMember"];
        $newMember = 2;

        $stmt = $conn->prepare("UPDATE users SET member=? WHERE id_user=?");
        $stmt->bind_param("ii", $newMember, $idUser);
        if($stmt->execute()){
            $_SESSION["message"] = "Your membership is being processed";
        }

        header("Location: useraccount.php");
    }
    else if(isset($_POST["btnCancel"])){ //MULAI DARI SINI KE BAWAH BARU
        $idHtrans = $_POST["btnCancel"];
        $newStat = "Cancelled";
        $stmt = $conn->prepare("UPDATE h_trans SET status=? WHERE id_htrans=?");
        $stmt->bind_param("si", $newStat, $idHtrans);
        if($stmt->execute()){
            $_SESSION["message"] = "Order successfully cancelled";
        }

        $stmt = $conn->query("SELECT * FROM h_trans WHERE id_htrans='$idHtrans'");
        $result = $stmt->fetch_assoc();
        $total = $result["total"];

        //BUAT REFUND TP ERROR
        // require_once ("./midtrans/Midtrans.php");
        // \Midtrans\Config::$serverKey = 'SB-Mid-server-qTRpnM1XKpZzUn5SR-NjGBRl';
        // \Midtrans\Config::$isSanitized = true;
        // $params = array(
        //     'refund_key' => rand(),
        //     'amount' => $total,
        //     'reason' => 'Customer cancelled order'
        // );
        // $direct_refund = \Midtrans\Transaction::refundDirect($idHtrans, $params);

        header("Location: orderhistory.php");
    }
    else if(isset($_POST["btnArrive"])){
        $idHtrans = $_POST["btnArrive"];
        $newStat = "Completed";
        $stmt = $conn->prepare("UPDATE h_trans SET status=? WHERE id_htrans=?");
        $stmt->bind_param("si", $newStat, $idHtrans);
        $stmt->execute();

        $stmt = $conn->query("SELECT * FROM h_trans WHERE id_htrans='$idHtrans'");
        $currTrans = $stmt->fetch_assoc();
        $points = $currTrans["points_received"];

        $username = $_SESSION["username"];
        $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user = $stmt->fetch_assoc();
        $idUser = $user["id_user"];

        if($user["member"]==1){
            $point = $user["point"];
            $newPoint = $points + $point;
            $stmt = $conn->prepare("UPDATE users SET point=? WHERE id_user=?");
            $stmt->bind_param("ii", $newPoint, $idUser);
            $stmt->execute();
        }

        header("Location: userreview.php");
    }
    else if(isset($_POST["btnReview"])){
        $idUser = $_POST["btnReview"];
        $review = $_POST["reviewText"];
        $rating = $_POST["rating"];
        $comment = $_POST["cmbComment"];

        if($review!="" && $rating!="" && $comment!=""){
            if($rating<1){
                $rating = 1;
            }
            else if($rating>5){
                $rating = 5;
            }
            $stmt = $conn->prepare("INSERT INTO user_review(id_user, review, rating, comment) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isis", $idUser, $review, $rating, $comment);
            if($stmt->execute()){
                $_SESSION["message"] = "Thank you for your review! It means a lot to us :)";
            }
        }

        header("Location: orderhistory.php");
    }
    else if(isset($_POST["btnDeleteAcc"])){
        $idUser = $_POST["btnDeleteAcc"];
        $newStat = 0;

        $stmt = $conn->prepare("UPDATE users SET status=? WHERE id_user=?");
        $stmt->bind_param("ii", $newStat, $idUser);
        $stmt->execute();
        
        unset($_SESSION["username"]);
        header("Location: index.php");
    }
    else if(isset($_REQUEST["btnRedeem"])){
        $jmlhPoint = $_REQUEST["jmlhPoint"];

        $username = $_SESSION["username"];
        $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user = $stmt->fetch_assoc();

        if($jmlhPoint <= $user["point"]){
            $_SESSION["redeemPoint"] = $jmlhPoint;
            $discount = $jmlhPoint * 1000;
            // echo "-Rp ". number_format($discount,0,'.','.');
        }
        // else{
        //     echo 0;
        // }
        header("Location: usercart.php");
    }
    else if(isset($_REQUEST["updateTotal"])){
        $username = $_SESSION["username"];
        $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user = $stmt->fetch_assoc();
        $idUser = $user["id_user"];

        $stmt = $conn->query("SELECT SUM(subtotal) as subtotal FROM cart WHERE id_user='$idUser'");
        $result = $stmt->fetch_assoc();
        $subtotal = $result["subtotal"];

        $redeemed = $_SESSION["redeemPoint"] ?? 0;
        $disc = $redeemed * 1000;

        $newTotal = $subtotal - $disc;
        echo "Rp ". number_format($newTotal,0,'.','.');
    }
    else if(isset($_REQUEST["contactUs"])){
        $name = $_REQUEST["name"];
        $email = $_REQUEST["email"];
        $phone = $_REQUEST["phone"];
        $orderId = $_REQUEST["orderId"];
        $message = $_REQUEST["message"];

        $stmt = $conn->prepare("INSERT INTO contactus(name, email, phone, id_htrans, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $name, $email, $phone, $orderId, $message);
        $stmt->execute();
    }
?>