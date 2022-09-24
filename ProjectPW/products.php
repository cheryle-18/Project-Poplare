<?php
    require_once("./conn.php");
    header('Cache-Control: no cache');
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

    if(isset($_SESSION["search"])){
        unset($_SESSION["search"]);
    }
    $current_cat = "";
    $current_sub = "";
    $current_search = "";
    $current_brand = "";
    
    if(isset($_GET["category"])){
        $current_cat = $_GET["category"];
        unset($_SESSION["currPage"]);
    }
    if(isset($_GET["subcategory"])){
        $current_sub = $_GET["subcategory"];
        unset($_SESSION["currPage"]);
    }
    
    if(isset($_REQUEST["brand"])){
        $current_brand = $_REQUEST["brand"];
        unset($_SESSION["currPage"]);
    }

    $title = "All";
    $queryStr = "SELECT * FROM items";

    if($current_cat!=""){
        $stmt2 = $conn->query("SELECT * FROM category where ID='$current_cat'");
        $result = $stmt2->fetch_assoc();
        $title = $result["Name"];

        $queryStr = $queryStr . " WHERE Category = '$current_cat'";
        if($current_sub!=""){
            // $stmt = $conn->prepare("SELECT * FROM items WHERE Category = '$current_cat' AND Sub_Category = '$current_sub'");
            $queryStr = $queryStr . " AND Sub_Category = '$current_sub'";

            $stmt2 = $conn->query("SELECT * FROM subcategory where ID='$current_sub'");
            $result = $stmt2->fetch_assoc();
            $title = $title . " " . $result["Name"];
        }
        // else{
        //     $stmt = $conn->prepare("SELECT * FROM items WHERE Category = '$current_cat'");
        // }
    } 
    // else $stmt = $conn->prepare("SELECT * FROM items");
    if($current_brand!=""){
        // $stmt = $conn->prepare("SELECT * FROM items WHERE Brand='$current_brand'");
        $queryStr = $queryStr . " WHERE Brand='$current_brand'";
        $title = ucfirst($current_brand);
    }

    $sortBy = $_SESSION["sortBy"] ?? "";
    $dir = $_SESSION["dir"] ?? "";
    if(isset($_POST["btnSort"])){
        $sortBy = $_POST["cmbSort"];
        $dir = $_POST["cmbDir"];
        $_SESSION["sortBy"] = $sortBy;
        $_SESSION["dir"] = $dir;
    }

    if(isset($_POST["btnReset"])){
        $sortBy = "";
        $dir = "";
        if(isset($_SESSION["sortBy"])){
            unset($_SESSION["sortBy"]);
        }
        if(isset($_SESSION["dir"])){
            unset($_SESSION["dir"]);
        }
        if(isset($_SESSION["currPage"])){
            unset($_SESSION["currPage"]);
        }
    }

    if($sortBy!="" && $dir!=""){
        $queryStr = $queryStr . " ORDER BY $sortBy";
        if($dir=="ASC"){
            $queryStr = $queryStr . " ASC";
        }
        else{
            $queryStr = $queryStr . " DESC";
        }
    }

    // echo $queryStr;
    $stmt = $conn->prepare($queryStr);
    $stmt->execute();
    $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    $jmlhPage = ceil(count($items)/16);

    $currPage = $_SESSION["currPage"] ?? 0;
    if(isset($_POST["btnPage"])){
        $currPage = $_POST["btnPage"];
        $_SESSION["currPage"] = $currPage;
    }
    if(isset($_POST["btnPrev"])){
        if($currPage > 0){
            $currPage--;
        }
        $_SESSION["currPage"] = $currPage;
    }
    if(isset($_POST["btnNext"])){
        if($currPage<$jmlhPage-1){
            $currPage++;
        }
        $_SESSION["currPage"] = $currPage;
    }

    $minPagination = 0;
    if($currPage-2 > 0){
        $minPagination = $currPage - 2;
    }
    $maxPagination = 5;
    if($currPage+3 < $jmlhPage && $currPage>2){
        $maxPagination = $currPage + 3;
    }
    else if($currPage <= 2){
        if($jmlhPage >= 5){
            $maxPagination = 5;
        }
        else{
            $maxPagination = $jmlhPage;
        }
    }
    else{
        $maxPagination = $jmlhPage;
    }

    if(isset($_SESSION["jmlhItem"])){
        unset($_SESSION["jmlhItem"]);
    }
    if(isset($_SESSION["currItem"])){
        unset($_SESSION["currItem"]);
    }

    if(isset($_POST["btnAddCart"])){
        if(!isset($_SESSION["username"])){
            header("Location: login.php");
        }
        else{
            $_SESSION["asal"] = "products";
            $_SESSION["addCart"] = $_POST["btnAddCart"];
            header("Location: usercontrol.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css">
    <style>
        .hoverable{
            background-color: #013221;
            color: white;
        }
        .hoverable:hover{
            background-color: #f5f3f0;
            color: #013221;
            border: 1px solid #013221;
        }
        body{
            background-image:url("./asset/bgnew.jpg");
            background-size: cover;
            background-attachment: fixed;
        }
        .pagination button{
            /* background-color: white; */
            /* color: #013221; */
            border: 1px solid lightgray;
        }
        .current{
            background-color: #013221;
            color: white;
        }
        .mycard{
            width: 23.5%;
            margin: 10px;
        }
        /* #tulisanku{
            text-align: left;
        } */
        #sortForm{
            width: 70%;
        }
        #tempKartu{
            width: 100%;
        }
        @media only screen and (max-width: 1450px) {
            .mycard {
                width: 30%;
            }
            #tempKartu{
                width: 95%;
                margin: 0 auto;
                
            }
            
        }
        @media only screen and (max-width: 1100px) {
            .mycard {
                width: 47%;
            }
            #tempKartu{
                width: 85%;
                margin: 0 auto;
            }
            
        }
        @media only screen and (max-width: 900px) {
            .mycard {
                width: 100%;
            }
            #tempKartu{
                width: 60%;
                margin: 0 auto;
            }
           
        }

        @media only screen and (max-width: 600px) {
            #tempKartu *{
                font-size: 0.9em;
            }
        }
        @media only screen and (max-width: 490px) {
            .logo {
                width: 200px;
                transform: scale(0.8);
            }
          
            
        }
        @media only screen and (max-width: 575px) {
            #kontenAtas{
                font-size: 0.9em;
            }
            #sortForm{
                width: 60%;
            }
            #sortForm form{
                flex-direction: column;
            }
            #sortForm *{
                font-size: 0.9em;
                padding-top: 10px;
                width: 80%;
                /* width: 100%; */
                margin: 0 auto;
            }
            #tulisanku{
                font-size: 1.3em;
                text-align: center;
            }
            
        }
    </style>
    <script src="./jquery.js"></script>
    <script> 
        $(document).ready(function () {
           name = "<?= $sortBy ?>";
           dir ="<?= $dir ?>";
           if(name!="" && dir!=""){
               //ok
               $("#cmbSort").val(name);
               $("#cmbDir").val(dir);
           }
        })

        function updt(id_item) {
            <?php if(isset($_SESSION["username"]))  
                {
            ?>
                jumlah = 1;
                cart_id = id_item;
                $.post("usercontrol.php",{addCart:id_item,jumlah:1},function(res){
                    var txt = `<div class="alert alert-success text-center" role="alert" id="txt" style="position:fixed;top:0px;left:0px;width:100%;display:none;background-color:green; color:white;font-size:1.3em;">Sucessfully added to cart!</div>`;
                        $("#mynav").removeClass("d-block");
                        $("#mynav").addClass("d-none");
                        //set timeout
                        $("body").append(txt);
                        $("#txt").fadeIn(200,function () {
                        });
                            var timeout = setTimeout(() => {
                            clearTimeout(timeout);
                            $("#txt").slideUp("slow",function () {
                                $("#txt").remove();   
                                $("#mynav").removeClass("d-none");
                                $("#mynav").addClass("d-block");
                            });
                        },2000);    
                })
            <?php
                }
                else{
            ?>
                    window.location.href = "login.php";

            <?php

                }
            ?>

        }   

    </script>
</head>
<body>
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

    <div class="content p-5 mx-auto" style="justify-content: center; position:relative;margin-top:70px;">
        <div class="px-4 text-center" id="kontenAtas">
            <!-- <div class="card p-3 m-3 mb-0" style="background-color: transparent;">
                <h1 style="color: #013221;"><?= $title ?> Products</h1>
            </div> -->
            <h1 style="color:#013221;letter-spacing:4px;margin-bottom:20px;" id="tulisanku"><i class="fas fa-leaf"></i> <?= $title ?> Products</h1>
            <button id="sortBtn"class="mt-2 mt-lg-4" style="background:transparent;border:none;"><h4><i class="fas fa-caret-right"></i> Sort Products</h4></button>
            <div id="sortForm" class="d-sm-flex justify-content-center w-100">
                <form action="#" method="POST" class="d-flex">
                    <select name="cmbSort" class="form-select mb-2 mb-sm-0" style="background-color:transparent; border: 1px solid #013221; color: black;" id="cmbSort">
                        <option value="" selected>Sort by</option>
                        <option value="Title">Name</option>
                        <option value="Price">Price</option>
                        <option value="ID">Newest</option>
                    </select>
                    <select name="cmbDir" id="cmbDir" class="form-select ms-sm-3 mb-2 mb-sm-0" style="background-color:transparent; border: 1px solid #013221; color: black;" id="cmbDir">
                        <option value="" selected>Mode</option>
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                    <button class="btn hoverable mb-2 mb-sm-0 ms-sm-3 px-3" name="btnSort">Sort</button>
                    <button class="btn hoverable  mb-2 mb-sm-0 ms-sm-1 px-3" name="btnReset">Reset</button>
                </form>
            </div>
        </div>
        <div class="cards d-flex flex-wrap" style="margin-top: 20px;" id="tempKartu">
            <?php
                //for($i=0; $i<count($items); $i++){
                $batas = (16*$currPage)+16;
                if($batas > count($items)){
                    $batas = count($items);
                }  
                
                for($i=(16*$currPage); $i<$batas; $i++){  
                    $img_link = $items[$i]["Image"];
                ?>
                    <div class="card shadow mycard">
                        <div class="p-3">
                            <img src="<?= $img_link ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body" style="margin-top: -20px;">
                            <div class="rating">
                                <?php
                                    $getNum = intval($items[$i]["Rating"]);
                                    $getDob = $items[$i]["Rating"] - $getNum;
                                    for ($ctr=1; $ctr < $getNum; $ctr++) {     
                                ?>
                                        <span><i class="fas fa-star"></i></span>
                                <?php
                                    }
                                    if($getDob!=0){
                                ?>
                                    <span><i class="fas fa-star-half-alt"></i></span>
                                <?php
                                    }
                                    else if($getNum!=0){      
                                 ?>   
                                        <span><i class="fas fa-star"></i></span>
                                    <?php
                                    }
                                ?>

                            </div>
                            <h5 class="card-title"><b><?= $items[$i]["Title"] ?></b></h5>
                            <h5 class="card-text text-dark">Rp <?= number_format($items[$i]["Price"],0,'.','.') ?></h5>
                            <div class="buttons d-flex">
                                <form action="pagedetail.php" method="POST">
                                    <button class="hoverable btn mt-2" name="seeDetail" value='<?= $items[$i]["ID"] ?>'>Details</button>
                                </form>
                                <button class="btnAddCart hoverable btn mt-2 ms-1" name="btnAddCart" value='<?= $items[$i]["ID"]?>' onclick="updt(<?=$items[$i]['ID']?>)">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                <?php
                    
                }
            ?>
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center button-group">
            <li class="page-item">
                <form action="#" method="POST">
                    <button class="btn btn-light" name="btnPrev">Prev</button>
                </form>
            </li>
            <?php
                for($i=$minPagination; $i<$maxPagination; $i++){
                        if($i == $currPage){
                            $class = "page-item current text-white";
                        }
                        else{
                            $class = "page-item btn-light text-dark";
                        }
                    ?>
                    <li>
                        <form action="#" method="POST">
                            <button class="btn <?= $class ?>" value='<?= $i ?>' name="btnPage"><?= $i+1 ?></button>
                        </form>
                    </li>
                <?php
                }
            ?>
            <li class="page-item">
                <form action="#" method="POST">
                    <button class="btn btn-light" name="btnNext">Next</button>
                </form>
            </li>
        </ul>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>