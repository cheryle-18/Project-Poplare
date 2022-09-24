<?php
    require_once("./conn.php");

    if(isset($_SESSION["username"])){
        $location = "useraccount.php";
        $location2 = "usercart.php";

        $username = $_SESSION["username"];
        $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user = $stmt->fetch_assoc();
    }
    else{
        $location = "login.php";
        $location2 = "login.php";
    }
    //get cart
    $idUser = $user["id_user"];
    $stmt = $conn->query("SELECT * FROM cart WHERE id_user='$idUser'");
    $cartItems = $stmt->fetch_all(MYSQLI_ASSOC);
    
    if(isset($_SESSION["currPage"])){
        unset($_SESSION["currPage"]);
    }
    if(isset($_SESSION["search"])){
        unset($_SESSION["search"]);
    }

    if(isset($_POST["btnLogout"])){
        unset($_SESSION["username"]);
        header("Location: index.php");
    }
    if(isset($_POST["btnDelete"])){
        $idDelete = $_POST["id_cartku"];
        $stmt = $conn->prepare("DELETE FROM cart WHERE id_cart = ?");
        $stmt->bind_param("i", $idDelete);
        $result = $stmt->execute();
        $stmt = $conn->query("SELECT * FROM cart WHERE id_user='$idUser'");
        $cartItems = $stmt->fetch_all(MYSQLI_ASSOC);
    }

    require_once ("./midtrans/Midtrans.php");
    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = 'SB-Mid-server-qTRpnM1XKpZzUn5SR-NjGBRl';
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;
    \Midtrans\Config::$paymentIdempotencyKey = "Unique-ID";
    
    $snapToken = "";

    //get shipping
    $stmt = $conn->query("SELECT * FROM shipping WHERE id_user=$idUser");
    $shipping = $stmt->fetch_assoc();

    if(count($cartItems) > 0 && count($shipping)>0){
        $stmt = $conn->query("SELECT MAX(id_htrans) as idHtrans FROM h_trans");
        $result = $stmt->fetch_assoc();
        // $idHtrans = 15800; //biar kliatan bnyk
        $idHtrans = $result["idHtrans"]+1;
    
        $stmt = $conn->query("SELECT SUM(subtotal) as total FROM cart WHERE id_user='$idUser'");
        $result2 = $stmt->fetch_assoc();
        $subtotal = $result2["total"];
        $total = $subtotal;

        // $idHtrans = rand();
        $_SESSION["idHtrans"] = $idHtrans;

        //utk panggil snap
        $item_details = array();
        foreach($cartItems as $key => $value){
            $idItem = $value["id_item"];
            $stmt = $conn->query("SELECT * FROM items WHERE ID='$idItem'");
            $currProduct = $stmt->fetch_assoc();

            $temp = array(
                'id' => $idItem,
                'price' => $currProduct["Price"],
                'quantity' => $value["qty"],
                'name' => $currProduct["Title"]
            );

            array_push($item_details, $temp);
        }

        $redeemPoint = $_SESSION["redeemPoint"] ?? 0;
        $disc = 0;
        if($redeemPoint!=0){
            $disc = $redeemPoint * 1000;
            $discWritten = -1 * $disc;
            $temp = array(
                'id' => -1,
                'price' => $discWritten,
                'quantity' => 1,
                'name' => "Redeem Points"
            );
            $total = $total - $disc;
            array_push($item_details, $temp);
        }

        $transaction_details = array(
            'order_id' => $idHtrans,
            'gross_amount' => $total,
        );

        $shipping_address = array(
            'first_name'    => $user["name"],
            'address'       => $shipping["address"],
            'city'          => $shipping["city"],
            'postal_code'   => $shipping["postcode"],
            'phone'         => $shipping["phone"],
            'country_code'  => 'IDN'
        );

        $customer_details = array(
            'first_name'    => $user["name"],
            'email'         => $user["email"],
            'phone'         => $shipping["phone"],
            'address'       => $shipping["address"],
            'shipping_address' => $shipping_address
        );

        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        try{
            $snapToken = \Midtrans\Snap::getSnapToken($transaction); //get snaptoken
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    else{
        echo "<script>alert('Please fill in your shipping details first')</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        html,body{
            width: 100%;
            background-image: linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.4)),url("./asset/bg2.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }
        .content{
            width: 100%;
        }
   
        .hoverable{
            background-color: #013221;
            color: white;
        }
        .hoverable:hover{
            background-color: #f5f3f0;
            color: #013221;
            border: 1px solid #013221;
        }
        @media only screen and (max-width: 490px) {
            .logo {
                width: 200px;
                transform: scale(0.8);
            }
            .navku{
                padding-left:0px;
            }
        }
        @media only screen and (max-width: 490px) {
            #cartItems *{
                font-size: 0.95em;
            }
            #cartItems .buttonku,#cartItems input{
                width: 13%;
            }
        }
    </style>
    <script src="./jquery.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-78dlV8uEyHDTXXOJ"></script>
    <script>
        function updt(id_cart,stat) {
            cart_id = id_cart;
            $.post("usercontrol.php",{id_carts:cart_id,stat:stat},function(res){
                $("#jmlhItem_"+cart_id).val(res);
                id_user = $("#id_user").val();
                updtCart();
            })
            
        }   

        function updtCart(){
            $.post("usercontrol.php",{updatePrice:true},function(res){
                id_user = $("#id_user").val();
                $.post("usercontrol.php",{getTotal:true,id_user: id_user},function(res){
                    $("#subtotal").html(res);
                    // $("#total").html("<b>"+res+"</b>");
                });
                updateTotal();
            })
        }

        function updateTotal(){
            $.post("usercontrol.php", {updateTotal: true}, function(data, status){
                $("#total").html("<b>"+data+"</b>");
            });
        }

        $(document).ready(function () {
            //$(".content").show("slow");
            updtCart();
            updateTotal();

            $("#btnCheckout").click(function(){
                //panggil popup snap e
                snap.pay('<?=$snapToken?>', {
                    onSuccess: function(result){
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        // success = true; //gtw knp yg di dlm sini gk jalan malah buat error
                        //window.location.reload("usercart.php");
                        $.post("checkout.php", function(data, status){
                        // window.location.reload("usercart.php");
                        var txt = `<div class="alert alert-success text-center" role="alert" id="txt" style="position:fixed;top:0px;left:0px;width:100%;display:none;background-color:green; color:white;font-size:1.3em;">`+data+`</div>`;
                            $("#mynav").removeClass("d-block");
                            $("#mynav").addClass("d-none");
                            //set timeout
                            $("body").append(txt);
                            $("#txt").fadeIn(100,function () {
                            });
                                var timeout = setTimeout(() => {
                                clearTimeout(timeout);
                                $("#txt").slideUp("slow",function () {
                                    $("#txt").remove();   
                                    $("#mynav").removeClass("d-none");
                                    $("#mynav").addClass("d-block");
                                    window.location.reload("usercart.php");
                                });
                            },2000);    

                        });
                    },
                    onPending: function(result){
                        $.post("checkout.php", function(data, status){
                        // window.location.reload("usercart.php");
                        var txt = `<div class="alert alert-success text-center" role="alert" id="txt" style="position:fixed;top:0px;left:0px;width:100%;display:none;background-color:green; color:white;font-size:1.3em;">`+data+`</div>`;
                            $("#mynav").removeClass("d-block");
                            $("#mynav").addClass("d-none");
                            //set timeout
                            $("body").append(txt);
                            $("#txt").fadeIn(100,function () {
                            });
                                var timeout = setTimeout(() => {
                                clearTimeout(timeout);
                                $("#txt").slideUp("slow",function () {
                                    $("#txt").remove();   
                                    $("#mynav").removeClass("d-none");
                                    $("#mynav").addClass("d-block");
                                    window.location.reload("usercart.php");
                                });
                            },2000);    

                        });
                    },
                    onError: function(result){
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        // <?php
                        //     $idHtrans++;
                        //     $_SESSION["idHtrans"] = $idHtrans;
                        // ?>
                        window.location.reload("usercart.php");
                    }
                });

               
            });

            // $("#btnRedeem").click(function(){
            //     jmlh = $("#jmlhPoint").val();
            //     $.post("usercontrol.php", {redeemPoint: jmlh}, function(data, status){
            //         $("#discount").html(data);
            //         updateTotal();
            //         window.location.reload("usercart.php");
            //     });
            // });
        })
    </script>
</head>
<body style="background-color: #f5f3f0;">
<nav class="navbar navbar-expand-xxl navbar-dark ps-xl-5 pe-xl-5 fixed-top" style="background-color: #013221;" id="mynav">

<div class="container-fluid navku">
    <a href="index.php" class="logo">
    <div style="transform: scale(0.9);"><svg width="220" height="50" viewBox="0 0 350.1952307765463 65.11994608716238" class="css-1j8o68f"><defs id="SvgjsDefs1001"></defs><g id="SvgjsG1007" featurekey="symbolFeature-0" transform="matrix(1.2128649967198835,0,0,1.2128649967198835,-6.88605172971724,-28.083889831857203)" fill="#74b49b"><g xmlns="http://www.w3.org/2000/svg"><path d="M5.833,37.065c0,0-4.161,33.195,30.567,33.195C36.4,70.26,45.055,37.065,5.833,37.065z"></path><path d="M94.074,23.155c-47.241,0-51.611,29.712-50.744,44.967c7.981-23.02,29.738-28.101,29.738-28.101   c-20.77,12.557-25.03,35.225-25.307,36.825C100.514,74.81,94.074,23.155,94.074,23.155z"></path></g></g><g id="SvgjsG1008" featurekey="nameFeature-0" transform="matrix(1.217015520657995,0,0,1.217015520657995,122.48497246844325,0.9295872528967593)" fill="#ffffff"><path d="M14.512 12.754000000000001 c4.7656 0 7.9297 3.6719 7.9297 8.2031 c0 4.5703 -3.1641 8.1641 -7.9297 8.1641 l-7.2656 0 l0 10.879 l-2.7148 0 l0 -27.246 l9.9805 0 z M14.141 26.698999999999998 c3.4766 0 5.5469 -2.3828 5.5469 -5.7617 c0 -3.3008 -2.0703 -5.8008 -5.5469 -5.8008 l-6.8945 0 l0 11.563 l6.8945 0 z M43.6096875 40.37109 c-7.5391 0 -13.438 -5.2344 -13.438 -14.004 c0 -8.75 5.8984 -13.984 13.438 -13.984 c7.4805 0 13.418 5.2344 13.418 13.984 c0 8.7695 -5.9375 14.004 -13.418 14.004 z M43.6096875 37.7539 c5.9375 0 10.684 -4.082 10.684 -11.387 c0 -7.2656 -4.7461 -11.328 -10.684 -11.328 c-5.957 0 -10.742 4.0625 -10.742 11.328 c0 7.3047 4.7852 11.387 10.742 11.387 z M77.25809375 12.754000000000001 c4.7656 0 7.9297 3.6719 7.9297 8.2031 c0 4.5703 -3.1641 8.1641 -7.9297 8.1641 l-7.2656 0 l0 10.879 l-2.7148 0 l0 -27.246 l9.9805 0 z M76.88709375 26.698999999999998 c3.4766 0 5.5469 -2.3828 5.5469 -5.7617 c0 -3.3008 -2.0703 -5.8008 -5.5469 -5.8008 l-6.8945 0 l0 11.563 l6.8945 0 z M97.54688125 37.5 l9.7656 0 l0 2.5 l-12.48 0 l0 -27.246 l2.7148 0 l0 24.746 z M133.44153125 40 l-2.4609 -6.8359 l-12.637 0 l-2.4609 6.8359 l-2.8711 0 l10.039 -27.246 l3.2031 0 l10.039 27.246 l-2.8516 0 z M119.24223125 30.6836 l10.84 0 l-5.4297 -15.078 z M160.17571875 40 l-6.9727 -12.402 l-5.1953 0 l0 12.402 l-2.7148 0 l0 -27.246 l8.75 0 c5.3906 0 8.0078 3.3789 8.0078 7.5391 c0 3.75 -2.207 6.6016 -6.1523 7.1875 l7.4023 12.52 l-3.125 0 z M148.00781875 15.195 l0 10.117 l5.7227 0 c3.8867 0 5.7031 -2.0508 5.7031 -5.0195 c0 -2.9297 -1.8164 -5.0977 -5.7031 -5.0977 l-5.7227 0 z M187.10546875 15.254000000000001 l-11.406 0 l0 9.9023 l10.02 0 l0 2.4805 l-10.02 0 l0 9.8633 l11.406 0 l0 2.5 l-14.219 0 l0 -27.246 l14.219 0 l0 2.5 z"></path></g></svg></div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-xxl-none">
            <a class="nav-link d-inline-block ps-0" href='<?= $location ?>' style="color: white; margin-top: 5px;">
                    <?php
                        if(isset($_SESSION["username"])){
                            ?>
                            <h5>Hi, <?= $user["name"] ?>!</h5>
                        <?php
                        }
                        else{
                            ?>
                            <h4><i class="fa fa-user" aria-hidden="true"></i></h4>
                        <?php
                        }
                    ?>
                </a>
            <a class="nav-link d-inline-block float-end" href='<?= $location2 ?>' style="color: white; margin-top: 5px;"><h4><i class="fa fa-shopping-cart" aria-hidden="true"></i></h4></a>
        </div>
        <div class="d-xxl-none mt-3">
            <div>
                <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" id="" placeholder="Search" style="height: 2em;" name="input-search">
                        <button class="btn btn-outline-light" name="cari" style="height: 2em; justify-content: center;">
                            <h5 style="margin-top: -5px;"><i class="fa fa-search" aria-hidden="true"></i></h5> 
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-top: -2px;">
            <li class="nav-item dropdown">
                <a class="nav-link me-3 ms-xxl-3" href="products.php" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
                    Brands
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink" style="font-size: 1em; background-color: #013221;">
                    <li><a class="dropdown-item" href="products.php?brand=innisfree">Innisfree</a></li>
                    <li><a class="dropdown-item" href="products.php?brand=amway">Amway</a></li>
                    <li><a class="dropdown-item" href="products.php?brand=bodyshop">The Body Shop</a></li>
                    <li><a class="dropdown-item" href="products.php">All Brands</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link me-3 ms-xxl-1 test" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
                        Skincare
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink" style="font-size: 1em; background-color: #013221;">
                    <li><a class="dropdown-item" href="products.php?category=1&subcategory=1">Toner</a></li>
                    <li><a class="dropdown-item" href="products.php?category=1&subcategory=2">Moisturizer</a></li>
                    <li><a class="dropdown-item" href="products.php?category=1&subcategory=3">Serum & Essence</a></li>
                    <li><a class="dropdown-item" href="products.php?category=1&subcategory=4">Eye Care</a></li>
                    <li><a class="dropdown-item" href="products.php?category=1&subcategory=5">Mask</a></li>
                    <li><a class="dropdown-item" href="products.php?category=1&subcategory=6">Cleanser</a></li>
                    <li><a class="dropdown-item" href="products.php?category=1&subcategory=7">Men</a></li>
                    <li><a class="dropdown-item" href="products.php?category=1&subcategory=8">Tools</a></li>
                    <li><a class="dropdown-item" href="products.php?category=1">All Skincare Products</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link me-3 ms-xxl-1" href="products.php" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
                        Makeup
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink" style="font-size: 1em; background-color: #013221;">
                    <li><a class="dropdown-item" href="products.php?category=2&subcategory=9">Face</a></li>
                    <li><a class="dropdown-item" href="products.php?category=2&subcategory=10">Lips</a></li>
                    <li><a class="dropdown-item" href="products.php?category=2&subcategory=15">Eyes</a></li>
                    <li><a class="dropdown-item" href="products.php?category=2&subcategory=11">Nails</a></li>
                    <li><a class="dropdown-item" href="products.php?category=2&subcategory=8">Tools</a></li>
                    <li><a class="dropdown-item" href="products.php?category=2">All Makeup Products</a></li>
                  </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link me-3 ms-xxl-1" href="products.php" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
                    Body & Hair
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink" style="font-size: 1em; background-color: #013221;">
                    <li><a class="dropdown-item" href="products.php?category=3&subcategory=12">Body Care</a></li>
                    <li><a class="dropdown-item" href="products.php?category=3&subcategory=13">Hair Care</a></li>
                    <li><a class="dropdown-item" href="products.php?category=3&subcategory=14">Hand Care</a></li>
                    <li><a class="dropdown-item" href="products.php?category=3&subcategory=8">Tools</a></li>
                    <li><a class="dropdown-item" href="products.php?category=3">All Body & Hair Products</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutus.php" style="font-size: 1.2em;">About Us</a>
            </li>
        </ul>
        <div class="me-3 d-none d-xxl-block">
            <form action="search.php" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" id="" placeholder="Search" style="height: 2em;" name="input-search">
                    <button class="btn btn-outline-light" name="cari" style="height: 2em; justify-content: center;">
                        <h5 style="margin-top: -5px;"><i class="fa fa-search" aria-hidden="true"></i></h5> 
                    </button>
                </div>
            </form>
        </div>
        <div class="d-none d-xxl-block">
            <a class="nav-link d-inline-block" href='<?= $location ?>' style="color: white; margin-top: 5px;">
                    <?php
                        if(isset($_SESSION["username"])){
                            ?>
                            <h5>Hi, <?= $user["name"] ?>!</h5>
                        <?php
                        }
                        else{
                            ?>
                            <h4><i class="fa fa-user" aria-hidden="true"></i></h4>
                        <?php
                        }
                    ?>
                </a>
            <a class="nav-link d-inline-block" href='<?= $location2 ?>' style="color: white; margin-top: 5px;"><h4><i class="fa fa-shopping-cart" aria-hidden="true"></i></h4></a>
        </div>
    </div>
</div>
</nav>

    <div class="content p-5">
        <div class="title card p-2 ps-4 mb-3 w-100" style="background-color: #f5f3f0; margin-top:55px;">
            <h1><i class="fas fa-cart-plus me-3" style="color: #013221;"></i><b>Shopping Cart</b></h1>
        </div>
        <div class="row cards d-flex flex-column flex-lg-row mx-0" id="cartItems">
            <?php
                if(count($cartItems) > 0){
                    ?>
                    <div class="left col-12 col-lg-7 mb-3 mb-lg-0 px-0 pe-lg-4">
                        <div class="items card p-3 w-100" style="background-color: #f5f3f0;">
                            <?php
                                foreach($cartItems as $key => $value){
                                    $idItem = $value["id_item"];
                                    $stmt = $conn->query("SELECT * FROM items WHERE ID='$idItem'");
                                    $currProduct = $stmt->fetch_assoc();
                                    ?>
                                    <div class="itemCard p-3 d-flex">
                                        <div class="pic" style="width: 15%;">
                                            <img src="<?= $currProduct["Image"] ?>" class="card-img-top" alt="..." style="border: 1px solid #013221;">
                                        </div>
                                        <div class="text ps-3 pt-1" style="width: 90%;">
                                            <h4 class="card-title"><b><?= $currProduct["Title"] ?></b></h4>
                                            <h5 class="card-text text-dark">Rp. <?= number_format($currProduct["Price"],0,'.','.') ?></h5>
                                            <div class="d-flex" style="float: right;">
                                                <form action="#" method="POST">
                                                    <input type="hidden" name="id_cartku" value="<?= $value["id_cart"] ?>">
                                                    <button class="me-2 me-md-3 buttonku d-flex align-items-center h-100" style="border:none;background-color:transparent;" name="btnDelete"><h4><i class="fa fa-trash-o" style="color: #013221;" aria-hidden="true"></i></h4></button>
                                                </form>
                                                <div class="input-group me-3">
                                                    <input type="hidden" name="id_user" id ="id_user" value="<?= $idUser ?>">
                                                    <button class="btn btn-sm btn-dark hoverable rounded-start d-flex align-items-center justify-content-center buttonku" name="btnMin" style="height: 80%;align-items: center;" value="<?= $value["id_cart"] ?>" onclick="updt(<?=$value['id_cart']?>,-1)">–</button>
                                                    <input type="number text-center" style="height: 80%; text-align: center; width: 8vw;" class="form-control" name="jmlhItem" value='<?=$value["qty"] ?>' id="jmlhItem_<?=$value["id_cart"]?>">
                                                    <button class="btn btn-sm btn-dark hoverable btnPlus d-flex align-items-center justify-content-center buttonku" name="btnPlus" style="height: 80%;" value="<?= $value["id_cart"] ?>"onclick="updt(<?=$value['id_cart']?>,1)">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if($key < count($cartItems)-1){
                                            ?>
                                            <hr>
                                        <?php
                                        }
                                    ?>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="right col-12 col-lg-5 px-0">
                        <div class="totalCard card p-3 w-100" style="background-color: #f5f3f0;">
                            <?php
                                $stmt = $conn->query("SELECT SUM(subtotal) as total FROM cart WHERE id_user='$idUser'");
                                $result = $stmt->fetch_assoc();
                                $total = $result["total"];
                            ?>
                            <div class="detail">
                                <div class="pointStat p-2 w-50">
                                    <b>My Points</b> : <?= $user["point"] ?> <br>
                                    <label for="" class="form-label mt-3">Redeem Points</label>
                                    <form action="usercontrol.php" method="POST" class="d-flex mt-1 mb-3">
                                        <input type="text" name="jmlhPoint" id="jmlhPoint" class="form-control" placeholder="Amount">
                                        <button class="btn hoverable ms-2" name="btnRedeem" id="btnRedeem">Redeem</button>
                                    </form>
                                </div>
                                <table class="table table-borderless" style="font-size: 1.1em;">
                                    <tr>
                                        <td style="width: 30%;">Subtotal</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="text-align: right;" id="subtotal">Rp <?= number_format($subtotal,0,'.','.') ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Discount</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="text-align: right;" id="discount">-Rp <?= number_format($disc,0,'.','.') ?></td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid black;">
                                        <td style="width: 30%;">Shipping Fee</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="text-align: right;">Free</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Total</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="text-align: right;" id="total">Rp <b><?= number_format($total,0,'.','.') ?></b></td>
                                    </tr>
                                </table>
                            </div>
                            <button class="btn hoverable w-100 mt-4" name="checkout" value='<?= $total ?>' id="btnCheckout">Checkout</button>
                            <form action="products.php" method="POST">
                                <button class="btn hoverable w-100 mt-2" name="cont">Continue Shopping</button>
                            </form>
                        </div>
                    </div>
                <?php
                }
                else{
                    ?>
                    <div class="card p-4 w-100" style="background-color: #f5f3f0; margin-bottom: 41vh;">
                        <h5>You don't have any items in your cart.</h5>
                        <form action="products.php" method="POST" class="w-100">
                            <button class="btn hoverable mt-2" name="cont">Continue Shopping</button>
                        </form>
                    </div>
                <?php
                }
            ?>
        </div>
    </div>

    <div class="notification card" id="notification" style="display: none;">
        Payment successful!
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>