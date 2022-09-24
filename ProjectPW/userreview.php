<?php
    require_once("./conn.php");

    if(isset($_SESSION["username"])){
        $location = "useraccount.php";
        $location2 = "usercart.php";
    }
    else{
        $location = "login.php";
        $location2 = "login.php";
    }

    if(isset($_SESSION["currPage"])){
        unset($_SESSION["currPage"]);
    }
    if(isset($_SESSION["search"])){
        unset($_SESSION["search"]);
    }
    
    //get user
    $username = $_SESSION["username"];
    $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $stmt->fetch_assoc();

    //get order
    $idHtrans = $_SESSION["idHtrans"];
    $stmt = $conn->query("SELECT * FROM h_trans WHERE id_htrans='$idHtrans'");
    $order = $stmt->fetch_assoc();

    //get order details
    $stmt = $conn->query("SELECT * FROM d_trans WHERE id_htrans='$idHtrans'");
    $oDetails = $stmt->fetch_all(MYSQLI_ASSOC);

    if(isset($_POST["back"])){
        unset($_SESSION["idHtrans"]);
        header("Location: orderhistory.php");
    }

    if(isset($_POST["btnLogout"])){
        unset($_SESSION["username"]);
        header("Location: index.php");
    }

    if(isset($_SESSION["message"])){
        echo "<script>alert('$_SESSION[message]')</script>";
        unset($_SESSION["message"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css">
    <style>
        body{
            min-height: 100vh;
        }
        .content{
            width: 100%;
            overflow: auto;
            display: flex;
            background-image: url("./asset/bg2.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: calc(100vh - 73px);
            position: relative;
            user-select: none;
        }
        .left{
            width: 30%;
        }
        .right{
            width: 70%;
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
        .divDelete{
            visibility: hidden;
            position: absolute;
            left: 30vw;
            z-index: 1;
        }
        .content .show{
            visibility: visible;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s
        }
        i:hover{
            cursor: pointer;
        }
        @media only screen and (max-width: 763px) {
            .left{
                width: 100%;
            }
            .right{
                width: 100%;
            }
            .content{
                flex-direction: column;
            }
        }
    </style>
    <script src="jquery.js"></script>
    <script>
        function popup(){
            var popup = document.getElementById("divDelete")
            popup.classList.toggle("show");
        }

        function updtStar(id){
            for (let i = 1; i <= 5; i++) {
                star = $("#star_"+i);
                star.removeClass("fas");
                star.addClass("far");
            }
            for (let i = 1; i <= id; i++) {
                star = $("#star_"+i);
                star.removeClass("far");
                star.addClass("fas");
            }
            $("#myrating").val(id);
        }
        $(document).ready(function () {
            
        })
    </script>
</head>
<body style="background-color: #f5f3f0;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #013221;">
    <div class="container-fluid ps-5 pe-5">
        <a href="index.php">
        <div style="transform: scale(0.9);"><svg width="220" height="50" viewBox="0 0 350.1952307765463 65.11994608716238" class="css-1j8o68f"><defs id="SvgjsDefs1001"></defs><g id="SvgjsG1007" featurekey="symbolFeature-0" transform="matrix(1.2128649967198835,0,0,1.2128649967198835,-6.88605172971724,-28.083889831857203)" fill="#74b49b"><g xmlns="http://www.w3.org/2000/svg"><path d="M5.833,37.065c0,0-4.161,33.195,30.567,33.195C36.4,70.26,45.055,37.065,5.833,37.065z"></path><path d="M94.074,23.155c-47.241,0-51.611,29.712-50.744,44.967c7.981-23.02,29.738-28.101,29.738-28.101   c-20.77,12.557-25.03,35.225-25.307,36.825C100.514,74.81,94.074,23.155,94.074,23.155z"></path></g></g><g id="SvgjsG1008" featurekey="nameFeature-0" transform="matrix(1.217015520657995,0,0,1.217015520657995,122.48497246844325,0.9295872528967593)" fill="#ffffff"><path d="M14.512 12.754000000000001 c4.7656 0 7.9297 3.6719 7.9297 8.2031 c0 4.5703 -3.1641 8.1641 -7.9297 8.1641 l-7.2656 0 l0 10.879 l-2.7148 0 l0 -27.246 l9.9805 0 z M14.141 26.698999999999998 c3.4766 0 5.5469 -2.3828 5.5469 -5.7617 c0 -3.3008 -2.0703 -5.8008 -5.5469 -5.8008 l-6.8945 0 l0 11.563 l6.8945 0 z M43.6096875 40.37109 c-7.5391 0 -13.438 -5.2344 -13.438 -14.004 c0 -8.75 5.8984 -13.984 13.438 -13.984 c7.4805 0 13.418 5.2344 13.418 13.984 c0 8.7695 -5.9375 14.004 -13.418 14.004 z M43.6096875 37.7539 c5.9375 0 10.684 -4.082 10.684 -11.387 c0 -7.2656 -4.7461 -11.328 -10.684 -11.328 c-5.957 0 -10.742 4.0625 -10.742 11.328 c0 7.3047 4.7852 11.387 10.742 11.387 z M77.25809375 12.754000000000001 c4.7656 0 7.9297 3.6719 7.9297 8.2031 c0 4.5703 -3.1641 8.1641 -7.9297 8.1641 l-7.2656 0 l0 10.879 l-2.7148 0 l0 -27.246 l9.9805 0 z M76.88709375 26.698999999999998 c3.4766 0 5.5469 -2.3828 5.5469 -5.7617 c0 -3.3008 -2.0703 -5.8008 -5.5469 -5.8008 l-6.8945 0 l0 11.563 l6.8945 0 z M97.54688125 37.5 l9.7656 0 l0 2.5 l-12.48 0 l0 -27.246 l2.7148 0 l0 24.746 z M133.44153125 40 l-2.4609 -6.8359 l-12.637 0 l-2.4609 6.8359 l-2.8711 0 l10.039 -27.246 l3.2031 0 l10.039 27.246 l-2.8516 0 z M119.24223125 30.6836 l10.84 0 l-5.4297 -15.078 z M160.17571875 40 l-6.9727 -12.402 l-5.1953 0 l0 12.402 l-2.7148 0 l0 -27.246 l8.75 0 c5.3906 0 8.0078 3.3789 8.0078 7.5391 c0 3.75 -2.207 6.6016 -6.1523 7.1875 l7.4023 12.52 l-3.125 0 z M148.00781875 15.195 l0 10.117 l5.7227 0 c3.8867 0 5.7031 -2.0508 5.7031 -5.0195 c0 -2.9297 -1.8164 -5.0977 -5.7031 -5.0977 l-5.7227 0 z M187.10546875 15.254000000000001 l-11.406 0 l0 9.9023 l10.02 0 l0 2.4805 l-10.02 0 l0 9.8633 l11.406 0 l0 2.5 l-14.219 0 l0 -27.246 l14.219 0 l0 2.5 z"></path></g></svg></div>
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-top: -2px;">
                <li class="nav-item dropdown">
                    <a class="nav-link me-3 ms-3" href="products.php" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
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
                    <a class="nav-link me-3 ms-1 test" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
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
                    <a class="nav-link me-3 ms-1" href="products.php" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
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
                    <a class="nav-link me-3 ms-1" href="products.php" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
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
            <div class="me-3">
                <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" id="" placeholder="Search" style="height: 2em;" name="input-search">
                        <button class="btn btn-outline-light" name="cari" style="height: 2em; justify-content: center;">
                            <h5 style="margin-top: -5px;"><i class="fa fa-search" aria-hidden="true"></i></h5> 
                        </button>
                    </div>
                </form>
            </div>
            <a class="nav-link" href='<?= $location ?>' style="color: white; margin-top: 5px;">
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
            <a class="nav-link" href='<?= $location2 ?>' style="color: white; margin-top: 5px;"><h4><i class="fa fa-shopping-cart" aria-hidden="true"></i></h4></a>
        </div>
    </div>
    </nav>

    <div class="content ps-5 pe-5 pt-5 pb-5">
        <div class="divDelete card p-5" style="text-align: center;" id="divDelete">
            <h4>Are you sure you want to delete your account? <br>We're sad to see you go...</h4> 
            <div class="btns d-flex mt-2" style="justify-content: center">
                <button class="btn hoverable" id="btnNo" onclick="popup()">No</button>
                <form action="usercontrol.php" method="POST">
                    <button class="btn hoverable ms-1" name="btnDeleteAcc" value='<?= $user["id_user"] ?>'>Yes</button>
                </form>
            </div>
        </div>
        <div class="left p-2 pe-4">
            <div class="card" style="background-color: #f5f3f0;">
                <div class="card-header">
                <a href="useraccount.php" style="color: black; text-decoration: none;">My Account</a>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="background-color: #f5f3f0;"><a href="orderhistory.php" style="color: black; text-decoration: none;">Order History</a></li>
                    <button class="btn ps-3" id="menuDelete" class="menuDelete" style="background-color: #f5f3f0; width: 100%; text-align: left; border-bottom: 1px solid gainsboro; border-radius: 0;" onclick="popup()">Delete My Account</button>
                    <form action="#" method="POST">
                        <button class="btn ps-3" name="btnLogout" style="background-color: #f5f3f0; width: 100%; text-align: left;">Logout</button>
                    </form>
                </ul>
            </div>
        </div>
        <div class="right p-2">
            <div class="title card p-2 ps-4 mb-3" style="background-color: #f5f3f0;">
                <h1><b>Order #<?= $idHtrans ?> Completed!</b></h1>
            </div>
            <div class="card p-4 mb-3" style="background-color: #f5f3f0;">
                <h4><b>Thank you for trusting Poplare. Tell us more about your experience.</b></h4>
                <form action="usercontrol.php" method="POST">
                    <div class="mb-3 mt-3">
                    <label for="" class="form-label me-2 text-center">Rating : </label>
                        <span style="font-size: 1.3em;color:#013221;">
                            <i class="far fa-star" id="star_1" onclick="updtStar(1)"></i>
                            <i class="far fa-star" id="star_2" onclick="updtStar(2)"></i>
                            <i class="far fa-star" id="star_3" onclick="updtStar(3)"></i>
                            <i class="far fa-star" id="star_4" onclick="updtStar(4)"></i>
                            <i class="far fa-star" id="star_5" onclick="updtStar(5)"></i>
                        </span>
                        <input type="hidden" name="rating" value="0" id="myrating">
                        <!-- <input type="number" name="rating" id="" class="form-control mb-2" style="width: 10%;"> -->
                        <select name="cmbComment" id="" class="form-select">
                            <option value="Excellent">Excellent</option>
                            <option value="Good">Good</option>
                            <option value="Poor">Poor</option>
                            <option value="Bad">Bad</option>
                        </select>   
                    </div>
                    <textarea name="reviewText" id="" cols="30" rows="5" class="form-control mt-3" placeholder="Write your review here"></textarea>
                    <button class="btn hoverable mt-3" name="btnReview" value='<?= $user["id_user"] ?>' style="float: right;">Send</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>