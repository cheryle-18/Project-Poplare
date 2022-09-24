<?php
    require_once("conn.php");

    $nama = $_POST["barang_nama"];
    $harga = $_POST["barang_harga"];
    $desc = $_POST["barang_desc"];
    $img = $_POST["barang_link"];
    $berat = $_POST["barang_berat"];
    $brand = $_POST["barang_brand"];
    $cat = $_POST["barang_kategori"];
    $sub = $_POST["barang_subkategori"];
    $stok = $_POST["barang_stok"];
    $rating = $_POST["barang_rating"];

    if($nama!="" && $harga!="" && $desc!="" &&$img!="" &&$berat!="" &&$brand!="" &&$cat!="" && $sub!="" &&$stok!=""){

        $stmt = $conn->prepare("INSERT INTO items(Title,Description,Price,Image,Weight,Category,Sub_Category,Rating,Brand,Stock) values(?,?,?,?,?,?,?,?,?,?);");

        $stmt->bind_param("ssisdssdsd",$nama,$desc,$harga,$img,$berat,$cat,$sub,$rating,$brand,$stok);
    
        if($stmt->execute()){
            echo 1;
        }else{
            echo 0;
        }
    }
    else{
        echo 0;
    }
?>