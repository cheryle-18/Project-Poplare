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

    $cur_item = -1;

    $cur_item = $_SESSION["currItem"] ?? -1;
    if(isset($_POST["seeDetail"])){
        $cur_item = $_POST["seeDetail"];
        $_SESSION["currItem"] = $cur_item;
    }

    if(!isset($_SESSION["currItem"])){
        header("Location:products.php");
        exit;
    }

    $jmlhItem = $_SESSION["jmlhItem"] ?? 1;

    if(isset($_POST["btnBack"])){
        unset($_SESSION["currItem"]);
        if(isset($_SESSION["search"])){
            header("Location: search.php");
            exit;
        }
        else{
            header("Location: products.php");
            exit;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .hoverable{
            background-color: #013221;
            color: white;
        }
        .hoverable:hover{
            background-color: white;
            color: #013221;
            border: 1px solid #013221;
        }
        body{
            background-image: url("./asset/bg-page-detail.jpg");
            background-size: cover;
            background-attachment: fixed;
        }

        @media only screen and (max-width: 490px) {
            .logo {
                width: 200px;
                transform: scale(0.8);
            }
         
        }
    </style>
    <script src="./jquery.js"></script>
    <script>
        $(document).ready(function () {
            $("#jmlhItem").val("1");
            // $("#left-detail").show("slow");
            // $("#right-detail").show("slow");
            $("#btnPlus").click(function () {
                val = parseInt($("#jmlhItem").val());
                val+=1;
                $("#jmlhItem").val(val);
            })
            $("#btnMin").click(function () {
                val =parseInt($("#jmlhItem").val());
                if(val > 1){
                    val-=1;
                }
                $("#jmlhItem").val(val);
            })

            $("#btnAddCart").click(function () {
             <?php if(isset($_SESSION["username"]))  
                {
                ?>
                val = $("#btnAddCart").val();
                jumlah = $("#jmlhItem").val();
                $.post("usercontrol.php",{addCart:val,asal:"detail",jumlah:jumlah},function(res){
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

            })
        })
        

    </script>
</head>
<body>
<nav class="navbar navbar-expand-xxl navbar-dark ps-xl-5 pe-xl-5" style="background-color: #013221;" id="mynav">

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

    <div class="container-fluid w-100 p-5" style="margin-top: 76px;">
        <?php
            $stmt = $conn->prepare("SELECT * FROM items WHERE ID = $cur_item");
            $stmt->execute();
            $item = $stmt->get_result()->fetch_assoc();
        ?>
        <div class="row d-flex justify-content-center align-items-center w-100 flex-column flex-lg-row">
            <div style="width: 100%;" class="d-block d-lg-none">
                <form action="#" method="POST" class="w-100 d-flex justify-content-center">
                    <button class="btn btn-dark hoverable mb-2" name="btnBack">Back</button>
                </form>
             </div>
            <div class="col-12 col-lg-6 text-center mb-3 mb-lg-0" id="left-detail">
                <div class="picture">
                    <img src="<?= $item["Image"] ?>" alt=""" style="width:80%; border: 1px solid #013221; border-radius: 5px; background-color:whitesmoke">
                </div>
                <!-- <div class="text">
                   <h1><b> <?= $item["Title"] ?></b></h1>
                </div>
                <div class="description">
                    <p><i> <?= $item["Description"] ?></i></p>
                </div> -->
            </div>
            <div class="col-12 col-lg-6 justify-content-center align-items-center" id="right-detail">
                <div style="width: 80%;"class="d-none d-lg-block">
                    <form action="#" method="POST">
                        <button class="btn btn-dark hoverable mb-2" style="width: 25%;" name="btnBack">Back</button>
                    </form>
                </div>
                <div class="card mb-3 d-flex" style="width: 100%; height:70%; border: 1px solid #013221;">
                <div class="card-header" style="color: #0F5132;"><h2><b><?= $item["Title"] ?></b></h2></div>
                <div class="card-body">
                    <?php
                        $id = $item["Category"];
                        $stmt = $conn->prepare("SELECT * FROM category WHERE ID = '$id'");
                        $stmt->execute();
                        $cat = $stmt->get_result()->fetch_assoc();
                        $id = $item["Sub_Category"];
                        $stmt = $conn->prepare("SELECT * FROM subcategory WHERE ID = '$id'");
                        $stmt->execute();
                        $sub = $stmt->get_result()->fetch_assoc();
                    ?>
                    <p><b><?=$cat["Name"]?> | <?=$sub["Name"]?></b></p>
                    <!-- <h2 class="card-title text-success"><b><?= $item["Title"] ?></b></h2> -->
                    <h4><b style="color: #0F5132;">Rp. <?= number_format($item["Price"],0,'.','.') ?></b></h4>
                    <div class="rating mt-4">
                        <span>Ratings : </span>
                        <?php
                            $getNum = intval($item["Rating"]);
                            $getDob = $item["Rating"] - $getNum;
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
                    <p><b style="color: #0F5132;"><?= $item["Stock"]>0?"Available":"Out of Stock" ?></b></p>
                    <p class="card-text"><?= $item["Description"] ?></p>
                    <div class="buttons d-flex mt-3 flex-column flex-lg-row justify-content-center align-items-center">
                        <div class="d-flex justify-content-center" style="width: fit-content;">
                            <div class="input-group me-0 me-lg-3 mb-2">
                                <button class="btn btn-dark hoverable" name="btnMin" id="btnMin">–</button>
                                <input type="number text-center" style="text-align: center;" class="form-control" name="jmlhItem" id="jmlhItem" min="1">
                                <button class="btn btn-dark hoverable" name="btnPlus" id="btnPlus">+</button>
                            </div>
                        </div>
                        <div class="cart" style="width: 70%;">
                            <button class="btn btn-dark hoverable" style="width: 100%;" value='<?= $item["ID"] ?>' name="btnAddCart" id="btnAddCart">Add to Cart</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>