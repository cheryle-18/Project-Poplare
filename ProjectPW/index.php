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
    
    if(isset($_SESSION["currPage"])){
        unset($_SESSION["currPage"]);
    }
    if(isset($_SESSION["search"])){
        unset($_SESSION["search"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" >
    <style>
      html,body{
          width: 100%;
          height:auto;
      }
      *{
          margin: 0;
          padding: 0;
          box-sizing: border-box;
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
        .banner{
            background-image:linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0.2)),url("./asset/bg2.jpg");
            width: 100%;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        }
        #jumbotrons{
            display: none;
        }
        #serviceku{
            opacity: 0;
        }
        #show_1,#show_2,#show_3{
          opacity: 0;
        }

        .ix{
            display: none;
        }
        .typer {
          width: 22ch;
          animation: typing 2s steps(22), blink .5s step-end infinite alternate;
          white-space: nowrap;
          overflow: hidden;
          /* border-right: 3px solid; */
          font-family: arial;
          /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
        }

        @keyframes typing {
          from {
            width: 0
          }
        }    
        @keyframes blink {
          50% {
            border-color: transparent
          }
        }
        .rounds{
            width: 60px;
            height: 60px;
            background-color: #013221;
            border-radius: 50%;
            position: absolute;
            top: -15px;
            left: 5px;
        }
        .brands{
          height: 400px;
          
        }
        .pic{
          display: flex;
          background-color: #f5f3f0;
          justify-content: center;
          align-items: center;
          text-align: center;
        }
        .pic img{
          margin: auto;
          height: 300px;
          display: block;
        }
        .text{
          background-color: #013221;
          color: white;
          text-align: center;
          align-items: center;
          display: flex;
          height: 100%;
        }
        .btnBrand{
            color: white;
            border: 1px solid white;
        }
        .btnBrand a{
            color: white;
            text-decoration: none;
        }
        .btnBrand:hover{
            color: #013221;
            background-color: white;
        }
        .btnBrand a:hover{
            color: #013221;
        }
        .cont{
            width: 100%;
        }
        img{
            width: 100%;
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
        @media only screen and (max-width: 700px) {
            .cont{
                width: 80%;
            }
        }
    </style>
    <script src="jquery.js"></script>
    
    <script>
        var scrolled = false;
        $scroll = 0;
        function animates(){
          $("#show_1").animate({
              "opacity":"1",
          },1000,function () {
              $("#show_2").animate({
                  "opacity":"1"
              },1000,function () {
                  $("show_3").animate({"opacity":"1"})
              });
          });
        }

        function moveMe(me){
            left = parseInt(me.css("left"));
            dx = parseInt(me.attr("dx"));
            if((left-1)==-200){
                me.fadeOut("linear",function () {
                    <?php  $stmt = $conn->query("SELECT * FROM user_review");
                            $reviews = $stmt->fetch_all(MYSQLI_ASSOC); ?>
                    me.css("left",<?= count($reviews)*300?> - 240);
                    me.fadeIn("slow");
                });
            
            }
            else{
                me.css("left",left-1);
            }
        }

        function move(){
            $(".cardku").each(function () {
                moveMe($(this));
            })
        }

        function animateService(){
          $('#serviceku').animate({"opacity":1},1000,function () {
              animates(); 
          });
        }
        $(document).ready(function () {
          timer = setInterval(() => {
                move();
            }, 10);

            $('#jumbotrons').fadeIn(1000);
            scrolled = true;
            animateService();
            $(window).scroll(function (event) {
                scroll = $(window).scrollTop();
                console.log(scroll);
                if(scroll>100){
                    if(!scrolled){
                        scrolled = true;
                       animateService();
                    }
                }
                if(scroll<70){
                    $('#serviceku').css({opacity : 0});
                    scrolled = false;

                    $('#show_1').css({opacity:0});
                    $('#show_2').css({opacity:0});
                    $('#show_3').css({opacity:0});
                }
            });
        });
    </script>
</head>
<body style="background-color: #f5f3f0;">
<nav class="navbar navbar-expand-xxl navbar-dark ps-xl-5 pe-xl-5" style="background-color: #013221;">

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

    <div class="jumbotron banner text-white text-center mx-auto my-0 w-100">
        <div class="row h-100 w-100 mx-0">
          <div class="col my-auto" id="jumbotrons">
            <h1 class="display-4 mb-5 text-center">WELCOME TO POPLARE</h1>
            <p class="mb-5" style="font-size: 1.1em;">Poplare provides eco-friendly and cruelty-free beauty, body and skincare products from around the world.</p>
            <a class="btn btn-outline-light btn-lg" href="products.php" role="button">View Products</a>
          </div>
        </div>
    </div>
  
  <div class="services py-5" id="serviceku" >
    <div class="container text-center">

      <h1 class="mb-4 typer mx-auto text-center" style="width: 95%;" id="judul" style="color: #013221;"><b>FEATURED PRODUCTS</b></h1>
      <p class="mb-5" style="font-size: 1.1em;">Check out our bestselling products</p>
      <div class="row d-flex justify-content-around">

          <?php
             $stmt = $conn->query("SELECT * FROM items ORDER BY total_buy DESC");
             $items = $stmt->fetch_all(MYSQLI_ASSOC);
                for ($i=0; $i < 3; $i++) { 
            ?>
                    <div class="col-9 col-md-6 col-xl-4 mb-5 mb-xl-2" id="show_<?=$i?>" style="position: relative;">
                      <div class="rounds text-white"><h3 style="margin-top: 12px;"><b><?= $i+1?></b></h3></div>
                      <div class="row">
                        <div class="col-11 py-4 bg-white mx-auto" style="box-shadow: 5px 10px 18px #888888;">
                          <div class="image" style="width: 100%; height:40vh;">
                            <img src="<?= $items[$i]["Image"] ?>" alt="" style="width:70%;">
                          </div>
                          <h4><b><?= $items[$i]["Title"] ?></b></h4>
                          <p><?= $items[$i]["Description"] ?></p>
                          <form action="pagedetail.php" method="POST">
                                <button class="hoverable btn mt-2" name="seeDetail" value='<?= $items[$i]["ID"] ?>'>Buy Now</button>
                            </form>
                        </div>
                      </div>
                  </div>

            <?php
              }
          ?>
    
      </div>
    </div>
  </div>

  <div class="services py-5 w-100" id="reviewku">
    <div class="container text-center">
          <h1 class="typer mb-4 mx-auto text-center" style="width: 95%; color:#013221;"><b>CUSTOMER REVIEWS</b></h1>
          <p>Check out reviews from various customers</p>
          <div class="cont mx-auto" style="height:70vh; background-color:#013221; position:relative; overflow:hidden; border:4px solid #013221; border-radius:30px;">
           <div class="leafs" style="position: absolute; top:-100px;right:0px">
              <img src="./asset/daun.png" width="100%" height="100%"></img>
           </div>
           <!-- INI TAK GANTI -->
          <?php

                $stmt = $conn->query("SELECT * FROM user_review");
                $reviews = $stmt->fetch_all(MYSQLI_ASSOC);
                $ctr = 0;
                for ($i=0; $i<count($reviews); $i++) { 
                    $idUser = $reviews[$i]["id_user"];
                    $stmt = $conn->query("SELECT * FROM users WHERE id_user='$idUser'");
                    $currUser = $stmt->fetch_assoc();
            ?>
                <div class="card ms-5 cardku p-2" style="width: 18rem; height:45vh; position:absolute; top:50%; left:<?=300*$i?>px;transform:translateY(-50%); border:3px solid rgb(145, 191, 109);">
                  <div class="card-body">
                    <h5 class="card-title"><b><?= $currUser["name"] ?></b></h5>
                    <p class="card-text">
                        <?php
                            for($j=0; $j<$reviews[$i]["rating"]; $j++){
                                ?>
                                <span><i class="fas fa-star"></i></span>
                            <?php
                            }
                        ?>
                    </p>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $reviews[$i]["comment"] ?></h6>
                    <p class="card-text"><?= $reviews[$i]["review"] ?></p>
                  
                    <!-- <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> -->
                  </div>
              </div>
            <?php

              }

          ?>
          <!-- SAMPE SINI -->
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="gallery w-100">
      <h1 class="typer mb-4 mx-auto text-center" style="width: 70%; color:#013221;"><b>BRANDS</b></h1>
      <div class="brands d-flex w-100">
        <div class="row w-100 mx-0">
            <div class="col-6 px-0 d-none d-lg-block"style="background-image: url('./asset/innisfree.png'); background-size:contain; background-repeat:no-repeat;background-position:center;"></div>
            <div class="col-12 col-lg-6 px-0">
                    <div class="text p-5">
                    <div class="detail m-auto">
                        <h2>INNISFREE</h2>
                        <div>
                           <p> Innisfree is an eco-conscious beauty brand committed to highly effective, clean, skin-conscious beauty and pledges to minimize environmental impact.</p>
                        </div>
                        <button class="btn btnBrand"><a href="products.php?brand=innisfree">Shop Innisfree</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="brands d-flex w-100">
        <div class="row w-100 mx-0">
            <div class="col-12 col-lg-6 px-0">
                <div class="text p-5 w-100">
                    <div class="detail m-auto">
                        <h2>AMWAY ARTISTRY</h2>
                        <div>
                            <p> Artistry promises your individual skincare needs are met with clinically-proven, targeted skincare collections.
                            </p>
                        </div>
                        <button class="btn btnBrand mt-4"><a href="products.php?brand=amway">Shop Amway</a></button>
                    </div>
                </div>
            </div>
            <div class="col-6 px-0 d-none d-lg-block"style="background-image: url('./asset/amway.png'); background-size:contain; background-repeat:no-repeat;background-position:center;"></div>
        </div>
    </div>
     
    <div class="brands d-flex w-100">
        <div class="row w-100 mx-0">
            <div class="col-6 px-0 d-none d-lg-block" style="background-image: url('./asset/bodyshop.png'); background-size:contain; background-repeat:no-repeat;background-position:center;"></div>
            <div class="col-12 col-lg-6 px-0">
                <div class="text p-5 w-100">
                    <div class="detail m-auto p-5">
                        <h2>THE BODY SHOP</h2>
                        <div>
                           <p> The Body Shop exists to fight for a fairer, more beautiful world.</p>
                        </div>
                        <button class="btn btnBrand mt-4"><a href="products.php?brand=bodyshop">Shop The Body Shop</a></button>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

  <div class="text-center py-3" style="background-color: #013221;">
      <a href="https://www.google.com"class="text-white" style="text-decoration: none;"><p> ©2021 Poplare. All Rights Reserved</p></a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>