<?php
    require_once("conn.php");
    $current_cat = "";
    $current_sub = "";
    $current_search = "";
    if(isset($_SESSION["username"])){
        $location = "useraccount.php";
    }
    else{
        $location = "login.php";
    }
    if(isset($_SESSION["search"])){
        unset($_SESSION["search"]);
    }
    if(isset($_GET["category"])){
        $current_cat = $_GET["category"];
        unset($_SESSION["currPage"]);
    }

    $queryStr = "SELECT * FROM items";

    $searchName = $_SESSION["searchName"] ?? "";
    $searchID = $_SESSION["searchID"] ?? "";
    if(isset($_POST["btnSearchName"])){
        $searchName = "%" . $_POST["searchName"] . "%";
        $_SESSION["searchName"] = $searchName;
        if(isset($_SESSION["searchID"])){
            unset($_SESSION["searchID"]);
            $searchName = "";
        }
    }
    else if(isset($_POST["btnSearchID"])){
        $searchID = $_POST["searchID"];
        $_SESSION["searchID"] = $searchID;
        if(isset($_SESSION["searchName"])){
            unset($_SESSION["searchName"]);
            $searchID = "";
        }
    }

    if($current_cat!="" || $searchName!="" || $searchID!=""){
        $queryStr = $queryStr . " WHERE";
        if($current_cat!=""){
            $queryStr = $queryStr . " Category='$current_cat'";
            if($searchName!="" || $searchID!=""){
                $queryStr = $queryStr . " AND";
            }
        }
        if($searchName!=""){
            $queryStr = $queryStr . " Title like '$searchName'";
        }
        else if($searchID!=""){
            $queryStr = $queryStr . " ID='$searchID'";
        }
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
        $searchName = "";
        $searchID = "";
        if(isset($_SESSION["searchName"])){
            unset($_SESSION["searchName"]);
        }
        if(isset($_SESSION["searchID"])){
            unset($_SESSION["searchID"]);
        }
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
    $stmt = $conn->prepare($queryStr);
    $stmt->execute();
    $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    $jmlhPage = ceil(count($items)/20);

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
    if(isset($_POST["logout"])){
        unset($_SESSION["username"]);
        header("Location: index.php");
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
        .pagination button{
            /* background-color: white;
            color: #013221; */
            border: 1px solid lightgray;
        }
        .current{
            background-color: #013221;
            color: white;
        }
        /* body{
            background-image: url("./asset/bg-page-detail.jpg");
            background-size: cover;
            background-attachment: fixed;
        } */
        .mycard{
            width: 23.5%;
            margin: 10px;
        }
        @media only screen and (max-width: 1450px) {
            .mycard {
                width: 30%;
            }
        }
        @media only screen and (max-width: 1100px) {
            .mycard {
                width: 47%;
            }
        }
        @media only screen and (max-width: 763px) {
            .mycard {
                width: 75%;
           
            }
        }
        @media only screen and (max-width: 490px) {
            .logo {
                width: 200px;
                transform: scale(0.8);
            }
           
        }

    </style>
    <script src="jquery.js"></script>
    <script>
        $(document).ready(function () {
        })
    </script>
</head>
<body style="background-color: #f5f3f0;">
    <nav class="navbar navbar-expand-xxl navbar-dark ps-xl-5 pe-xl-5 fixed-top" style="background-color: #013221;">
    <div class="container-fluid ps-3">
        <a href="#" class="logo">
        <div style="transform: scale(0.9);"><svg width="220" height="50" viewBox="0 0 350.1952307765463 65.11994608716238" class="css-1j8o68f"><defs id="SvgjsDefs1001"></defs><g id="SvgjsG1007" featurekey="symbolFeature-0" transform="matrix(1.2128649967198835,0,0,1.2128649967198835,-6.88605172971724,-28.083889831857203)" fill="#74b49b"><g xmlns="http://www.w3.org/2000/svg"><path d="M5.833,37.065c0,0-4.161,33.195,30.567,33.195C36.4,70.26,45.055,37.065,5.833,37.065z"></path><path d="M94.074,23.155c-47.241,0-51.611,29.712-50.744,44.967c7.981-23.02,29.738-28.101,29.738-28.101   c-20.77,12.557-25.03,35.225-25.307,36.825C100.514,74.81,94.074,23.155,94.074,23.155z"></path></g></g><g id="SvgjsG1008" featurekey="nameFeature-0" transform="matrix(1.217015520657995,0,0,1.217015520657995,122.48497246844325,0.9295872528967593)" fill="#ffffff"><path d="M14.512 12.754000000000001 c4.7656 0 7.9297 3.6719 7.9297 8.2031 c0 4.5703 -3.1641 8.1641 -7.9297 8.1641 l-7.2656 0 l0 10.879 l-2.7148 0 l0 -27.246 l9.9805 0 z M14.141 26.698999999999998 c3.4766 0 5.5469 -2.3828 5.5469 -5.7617 c0 -3.3008 -2.0703 -5.8008 -5.5469 -5.8008 l-6.8945 0 l0 11.563 l6.8945 0 z M43.6096875 40.37109 c-7.5391 0 -13.438 -5.2344 -13.438 -14.004 c0 -8.75 5.8984 -13.984 13.438 -13.984 c7.4805 0 13.418 5.2344 13.418 13.984 c0 8.7695 -5.9375 14.004 -13.418 14.004 z M43.6096875 37.7539 c5.9375 0 10.684 -4.082 10.684 -11.387 c0 -7.2656 -4.7461 -11.328 -10.684 -11.328 c-5.957 0 -10.742 4.0625 -10.742 11.328 c0 7.3047 4.7852 11.387 10.742 11.387 z M77.25809375 12.754000000000001 c4.7656 0 7.9297 3.6719 7.9297 8.2031 c0 4.5703 -3.1641 8.1641 -7.9297 8.1641 l-7.2656 0 l0 10.879 l-2.7148 0 l0 -27.246 l9.9805 0 z M76.88709375 26.698999999999998 c3.4766 0 5.5469 -2.3828 5.5469 -5.7617 c0 -3.3008 -2.0703 -5.8008 -5.5469 -5.8008 l-6.8945 0 l0 11.563 l6.8945 0 z M97.54688125 37.5 l9.7656 0 l0 2.5 l-12.48 0 l0 -27.246 l2.7148 0 l0 24.746 z M133.44153125 40 l-2.4609 -6.8359 l-12.637 0 l-2.4609 6.8359 l-2.8711 0 l10.039 -27.246 l3.2031 0 l10.039 27.246 l-2.8516 0 z M119.24223125 30.6836 l10.84 0 l-5.4297 -15.078 z M160.17571875 40 l-6.9727 -12.402 l-5.1953 0 l0 12.402 l-2.7148 0 l0 -27.246 l8.75 0 c5.3906 0 8.0078 3.3789 8.0078 7.5391 c0 3.75 -2.207 6.6016 -6.1523 7.1875 l7.4023 12.52 l-3.125 0 z M148.00781875 15.195 l0 10.117 l5.7227 0 c3.8867 0 5.7031 -2.0508 5.7031 -5.0195 c0 -2.9297 -1.8164 -5.0977 -5.7031 -5.0977 l-5.7227 0 z M187.10546875 15.254000000000001 l-11.406 0 l0 9.9023 l10.02 0 l0 2.4805 l-10.02 0 l0 9.8633 l11.406 0 l0 2.5 l-14.219 0 l0 -27.246 l14.219 0 l0 2.5 z"></path></g></svg></div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form action="#" method="POST" class="d-xxl-none float-end my-4">
                <button class="btn btn-outline-light" name="logout">Logout</button>
            </form>
            <!-- <div class="d-xxl-none mt-3">
                <div>
                    <form action="mastersearch.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" id="" placeholder="Search" style="height: 2em;" name="input-search">
                            <button class="btn btn-outline-light" name="cari" style="height: 2em; justify-content: center;">
                                <h5 style="margin-top: -5px;"><i class="fa fa-search" aria-hidden="true"></i></h5> 
                            </button>
                        </div>
                    </form>
                </div>
            </div> -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-top: -2px;">
                <li class="nav-item dropdown">
                    <a class="nav-link me-2 ms-1 active" href="masterproduct.php" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
                        Products
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink" style="font-size: 1em; background-color: #013221;">
                        <li><a class="dropdown-item" href="masterproduct.php?category=1">Skincare</a></li>
                        <li><a class="dropdown-item" href="masterproduct.php?category=2">Make Up</a></li>
                        <li><a class="dropdown-item" href="masterproduct.php?category=3">Body & Hair</a></li>
                        <li><a class="dropdown-item" href="masterproduct.php">All Products</a></li>
                    </ul>
                </li>
                <li class="nav-item me-2 ms-1">
                    <a class="nav-link" href="addproduct.php" style="font-size: 1.2em;">Add Product</a>
                </li>
                <li class="nav-item me-2 ms-1">
                    <a class="nav-link" href="masteruser.php" style="font-size: 1.2em;">Users</a>
                </li>
                <li class="nav-item me-2 ms-1">
                    <a class="nav-link" href="masterresponse.php" style="font-size: 1.2em;">Responses</a>
                </li>
                <li class="nav-item me-2 ms-1">
                    <a class="nav-link" href="mastertrans.php" style="font-size: 1.2em;">Transactions</a>
                </li>
                <li class="nav-item me-2 ms-1">
                    <a class="nav-link" href="report.php" style="font-size: 1.2em;">Report</a>
                </li>
               
            </ul>
            <!-- <div class="me-3 d-none d-xxl-block">
                <form action="mastersearch.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" id="" placeholder="Search" style="height: 2em;" name="input-search">
                        <button class="btn btn-outline-light" name="cari" style="height: 2em; justify-content: center;">
                            <h5 style="margin-top: -5px;"><i class="fa fa-search" aria-hidden="true"></i></h5> 
                        </button>
                    </div>
                </form>
            </div> -->
            <form action="#" method="POST" class="d-none d-xxl-block">
                <button class="btn btn-outline-light" name="logout">Logout</button>
            </form>
        </div>
    </div>
    </nav>

    <div class="content p-5 mt-5" style="justify-content: center;" >
        <div class="forms d-flex flex-column flex-lg-row justify-content-center mb-5">
            <div class="searchyName">
                <button style="background-color: transparent;border:none;" id="sname"><h4>Search by Name <i class="fas fa-caret-down"></i></h4></button>
                <form action="#" method="POST" class="d-flex" id="formsname">
                    <input type="text" name="searchName" id="" class="form-control" placeholder="Product Name">
                    <button class="btn ms-2 btn-outline-light" name="btnSearchName" style="background-color: #013221; color: white;">Search</button>
                </form> <br>
            </div>
            <div class="searchById ms-lg-5">
                <h4>Search by ID <i class="fas fa-caret-down"></i></h4>
                <form action="#" method="POST" class="d-flex">
                    <input type="text" name="searchID" id="" class="form-control" placeholder="Product ID">
                    <button class="btn ms-2 btn-outline-light" name="btnSearchID" style="background-color: #013221; color: white;">Search</button>
                </form> <br>
            </div>
            <div class="filter ms-lg-5">
                <h4>Sort</h4>
                <form action="#" method="POST" class="d-flex">
                    <select name="cmbSort" id="" class="form-select">
                        <option value="" selected></option>
                        <option value="ID">ID</option>
                        <option value="Title">Name</option>
                        <option value="Price">Price</option>
                        <option value="Stock">Stock</option>
                    </select>
                    <select name="cmbDir" id="" class="form-select ms-2">
                        <option value="" selected></option>
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                    <button class="btn ms-2 btn-outline-light" name="btnSort" style="background-color: #013221; color: white;">Sort</button>
                    <button class="btn ms-2 btn-outline-light" name="btnReset" style="background-color: #013221; color: white;">Reset</button>
                </form>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                    $batas = (20*$currPage)+20;
                    if($batas > count($items)){
                        $batas = count($items);
                    }
                    for($i=(16*$currPage); $i<$batas; $i++){  
                        $value = $items[$i];  
                        ?>
                        <tr>
                            <td><?= $value["ID"] ?></td>
                            <td style="width: 7%;">
                                <div class="pic">
                                    <img src="<?= $value["Image"] ?>" class="card-img-top" alt="..." style="border: 1px solid #013221;">
                                </div>
                            </td>
                            <td><?= $value["Title"] ?></td>
                            <td>Rp <?= number_format($value["Price"],0,'.','.') ?></td>
                            <td><?= $value["Stock"] ?></td>
                            <td>
                                <form action="editproduct.php" method="POST">
                                    <button class="hoverable btn mt-2" name="editProduct" value='<?= $value["ID"] ?>'>Edit</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation example" style="color:#013221;">
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
                    <li class='<?= $class ?>'>
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