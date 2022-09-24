<?php
    require_once("conn.php");

    if(isset($_POST["btnConfMember"])){
        $idUser = $_POST["btnConfMember"];
        $member = 1;
        $stmt = $conn->prepare("UPDATE users SET member=? WHERE id_user=?");
        $stmt->bind_param("ii", $member, $idUser);
        $stmt->execute();

        header("Location: masteruser.php");
    }
    if(isset($_POST["shipOrder"])){
        $idHtrans = $_POST["shipOrder"];
        $status = "Shipping";
        $stmt = $conn->prepare("UPDATE h_trans SET status=? WHERE id_htrans=?");
        $stmt->bind_param("si", $status, $idHtrans);
        $stmt->execute();

        header("Location: mastertrans.php");
    }
    else if(isset($_REQUEST["getIncome"])){
        $data = array();
        for($i=1; $i<=12; $i++){
            $stmt = $conn->query("SELECT SUM(total) as total FROM h_trans WHERE (status='Shipping' OR status='Completed') AND MONTH(trans_date)='$i'");
            $result = $stmt->fetch_assoc();
            $total = $result["total"];
            if($total==null){
                $total = 0;
            }
            $monthName = date("F", mktime(0, 0, 0, $i, 10));
            $temp = array(
                "month_name" => $monthName,
                "m_income" => $total
            );
            array_push($data, $temp);
        }
        echo json_encode($data);
    }
    
    // if(isset($_POST["editP"])){
    //     $idProduct = $_POST["editP"];
    //     $stmt = $conn->query("SELECT * FROM items WHERE ID=$idProduct");
    //     $currProduct = $stmt->fetch_assoc();

    //     $name = $_POST["name"];
    //     $price = $_POST["price"];
    //     $desc = $_POST["desc"];
    //     $weight = $_POST["weight"];
    //     $brand = $_POST["cmbBrand"];
    //     $category = $_POST["cmbCategory"];
    //     $subcategory = $_POST["subCategory"];
    //     $stock = $_POST["stock"];

    //     if($nama=="" || $price=="" || $desc=="" || $weight=="" || $brand=="" || $category=="" || $subcategory=="" || $stock==""){
    //         $_SESSION["message"] = "Please fill in all fields";
    //     }
    //     else if($price<0){
    //         $_SESSION["message"] = "Please input a valid price";
    //     }
    //     else{
    //         $stmt = $conn->prepare("UPDATE items SET Name=?, Price=?, Description=?, Weight=?, Brand=?, Category=?, Sub_Category=?, Stock=? WHERE ID=$idProduct");
    //         $stmt->bind_param("sisisssi",$name, $price , $desc, $weight, $brand, $category, $subcategory, $stock);
    //         $result = $stmt->execute();
    //     }
    // }
?>