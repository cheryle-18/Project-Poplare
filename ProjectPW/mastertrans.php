<?php
    require_once("conn.php");

    if(isset($_SESSION["currPage"])){
        unset($_SESSION["currPage"]);
    }
    if(isset($_SESSION["search"])){
        unset($_SESSION["search"]);
    }

    if(!isset($_SESSION["username"])){
        header("Location: login.php");
    }
    
    //get trans
    $queryStr = "SELECT * FROM h_trans";

    if(isset($_POST["btnSearchName"])){
        $custName = $_POST["searchName"];
        $stmt = $conn->query("SELECT * FROM users WHERE name='$custName'");
        $result = $stmt->fetch_assoc();
        $idUser = -1;
        if($result!=""){
            $idUser = $result["id_user"];
        }
        $queryStr = $queryStr . " WHERE id_user='$idUser'";
    }
    else if(isset($_POST["btnSearchID"])){
        $idHtrans = $_POST["searchID"];
        $queryStr = $queryStr . " WHERE id_htrans='$idHtrans'";
    }

    $stmt = $conn->query($queryStr);
    $hTrans = $stmt->fetch_all(MYSQLI_ASSOC);

    if(isset($_POST["btnDetTrans"])){
        $_SESSION["idTrans"] = $_POST["btnDetTrans"];
        $_SESSION["asal"] = "mastertrans";
        header("Location: transdetail.php");
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
    <title>Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,body{
            width: 100%;
            height: auto;
        }
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .btn-detail{
            width: 85px;
            margin-top: 0px;
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
        @media only screen and (max-width: 768px) {
            #kontenku *{
                font-size: 0.95em;
            }
            .btn-detail{
                width: 72px;
            }
        }
        @media only screen and (max-width: 451px) {
            .btn-detail{
               margin-top: 4px;
            }
        }
        @media only screen and (max-width: 320px) {
            #kontenku *{
                font-size: 0.92em;
            }
            .logo {
                width:150px;
                transform: scale(0.6);
            }
            .btn-detail{
                width: 47px;
            }
        }
    </style>
    <script src="jquery.js"></script>
    <script>
        $(document).ready(function () {
            $('#idselect').change(function() {
                var index = this.selectedIndex;
                if(index == 0){
                    $("#in").css("display","block");
                    $("#com").css("display","block");
                    $("#ship").css("display","block");
                    $("#cancel").css("display","block");
                }
                else if(index == 1){
                    $("#in").css("display","block");
                    $("#com").css("display","none");
                    $("#ship").css("display","none");
                    $("#cancel").css("display","none");
                }
                else if(index == 2){
                    $("#in").css("display","none");
                    $("#com").css("display","block");
                    $("#ship").css("display","none");
                    $("#cancel").css("display","none");
                }
                else if(index == 3){
                    $("#in").css("display","none");
                    $("#com").css("display","none");
                    $("#ship").css("display","block");
                    $("#cancel").css("display","none");
                }
                else if(index == 4){
                    $("#in").css("display","none");
                    $("#com").css("display","none");
                    $("#ship").css("display","none");
                    $("#cancel").css("display","block");
                }
            });
        })
    </script>
</head>
<body style="background-color: #f5f3f0;">
<nav class="navbar navbar-expand-xxl navbar-dark ps-0 ps-xl-5 pe-xl-5" style="background-color: #013221;">
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
            </div> -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-top: -2px;">
                <li class="nav-item dropdown">
                    <a class="nav-link me-2 ms-1" href="masterproduct.php" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.2em;">
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
                    <a class="nav-link active" href="mastertrans.php" style="font-size: 1.2em;">Transactions</a>
                </li>
                <li class="nav-item me-2 ms-1">
                    <a class="nav-link" href="report.php" style="font-size: 1.2em;">Report</a>
                </li>
            </ul>
            <form action="#" method="POST" class="d-none d-xxl-block">
                <button class="btn btn-outline-light" name="logout">Logout</button>
            </form>
        </div>
    </div>
</nav>

    
    <div class="content p-3 p-md-5 w-100" id="kontenku">
    <div class="forms d-flex">
        <div class="searchyName">
            <h4>Search by Customer </h4>
            <form action="#" method="POST" class="d-flex">
                <input type="text" name="searchName" id="" class="form-control" placeholder="Customer Name">
                <button class="btn ms-2" name="btnSearchName" style="background-color: #013221; color: white;">Search</button>
            </form> <br>
        </div>
        <div class="searchById ms-5">
            <h4>Search by ID </h4>
            <form action="#" method="POST" class="d-flex">
                <input type="text" name="searchID" id="" class="form-control" placeholder="Transaction ID">
                <button class="btn ms-2" name="btnSearchID" style="background-color: #013221; color: white;">Search</button>
            </form> <br>
        </div>
        <div class="filter ms-5">
            <h4>Filter :</h4>
            <select class="form-select" aria-label="Default select example" id="idselect">
                <option selected>All</option>
                <option value="1">Pending</option>
                <option value="2">In Process</option>
                <option value="3">Shipping</option>
                <option value="4">Completed</option>
                <option value="5">Cancelled</option>
            </select>
        </div>
    </div>
    <?php
        if(count($hTrans) > 0){
            ?>
            <div id="pen" class="mt-5">
                <h2>Pending</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <!-- <th>Points Used</th>
                            <th>Points Received</th> -->
                            <th>Customer</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($hTrans as $key => $value){
                                $idUser = $value["id_user"];
                                $stmt = $conn->query("SELECT * FROM users WHERE id_user='$idUser'");
                                $user = $stmt->fetch_assoc();
                                if($value["status"] == "Pending"){ 
                                ?>
                                <tr>
                                    <td><?= $value["id_htrans"] ?></td>
                                    <td><?= date("d/m/Y", strtotime($value["trans_date"])) ?></td>
                                    <td>Rp <?= number_format($value["total"],0,'.','.') ?></td>
                                    <!-- <td><?= $value["points_used"] ?></td>
                                    <td><?= $value["points_received"] ?></td> -->
                                    <td><?= $user["name"] ?></td>
                                    <td class="d-flex">
                                        <?php
                                            if($value["status"]=="In Process"){
                                                ?>
                                                <form action="admincontrol.php" method="post">
                                                    <button name="shipOrder" class="btn btn-sm btn-outline-dark" value='<?= $value["id_htrans"] ?>' style="background-color: #013221; color: white;">Ship Order</button>
                                                </form>
                                            <?php
                                            }
                                        ?>
                                        <form action="#" method="POST">
                                            <button class="btn btn-sm btn-outline-dark  btn-detail ms-1"style="background-color: #013221; color: white;" value='<?= $value["id_htrans"] ?>' name="btnDetTrans">Detail</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="in" class="mt-5">
                <h2>In Process</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <!-- <th>Points Used</th>
                            <th>Points Received</th> -->
                            <th>Customer</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($hTrans as $key => $value){
                                $idUser = $value["id_user"];
                                $stmt = $conn->query("SELECT * FROM users WHERE id_user='$idUser'");
                                $user = $stmt->fetch_assoc();
                                if($value["status"] == "In Process"){ 
                                ?>
                                <tr>
                                    <td><?= $value["id_htrans"] ?></td>
                                    <td><?= date("d/m/Y", strtotime($value["trans_date"])) ?></td>
                                    <td>Rp <?= number_format($value["total"],0,'.','.') ?></td>
                                    <!-- <td><?= $value["points_used"] ?></td>
                                    <td><?= $value["points_received"] ?></td> -->
                                    <td><?= $user["name"] ?></td>
                                    <td class="d-flex">
                                        <?php
                                            if($value["status"]=="In Process"){
                                                ?>
                                                <form action="admincontrol.php" method="post">
                                                    <button name="shipOrder" class="btn btn-sm btn-outline-dark" value='<?= $value["id_htrans"] ?>' style="background-color: #013221; color: white;">Ship Order</button>
                                                </form>
                                            <?php
                                            }
                                        ?>
                                        <form action="#" method="POST">
                                            <button class="btn btn-sm btn-outline-dark  btn-detail ms-1"style="background-color: #013221; color: white;" value='<?= $value["id_htrans"] ?>' name="btnDetTrans">Detail</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="ship" class="mt-5">
                <h2>Shipping</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <!-- <th>Points Used</th>
                            <th>Points Received</th> -->
                            <th>Customer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($hTrans as $key => $value){
                                $idUser = $value["id_user"];
                                $stmt = $conn->query("SELECT * FROM users WHERE id_user='$idUser'");
                                $user = $stmt->fetch_assoc();
                                if($value["status"] == "Shipping"){

                                
                                ?>
                                <tr>
                                    <td><?= $value["id_htrans"] ?></td>
                                    <td><?= date("d/m/Y", strtotime($value["trans_date"])) ?></td>
                                    <td>Rp <?= number_format($value["total"],0,'.','.') ?></td>
                                    <!-- <td><?= $value["points_used"] ?></td>
                                    <td><?= $value["points_received"] ?></td> -->
                                    <td><?= $user["name"] ?></td>
                                    <td>
                                        <form action="#" method="POST">
                                            <button class="btn btn-sm btn-outline-dark  btn-detail ms-1"style="background-color: #013221; color: white;" value='<?= $value["id_htrans"] ?>' name="btnDetTrans">Detail</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="com" class="mt-5">
                <h2>Completed</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <!-- <th>Points Used</th>
                            <th>Points Received</th> -->
                            <th>Customer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($hTrans as $key => $value){
                                $idUser = $value["id_user"];
                                $stmt = $conn->query("SELECT * FROM users WHERE id_user='$idUser'");
                                $user = $stmt->fetch_assoc();
                                if($value["status"] == "Completed"){
                                ?>
                                <tr>
                                    <td><?= $value["id_htrans"] ?></td>
                                    <td><?= date("d/m/Y", strtotime($value["trans_date"])) ?></td>
                                    <td>Rp <?= number_format($value["total"],0,'.','.') ?></td>
                                    <!-- <td><?= $value["points_used"] ?></td>
                                    <td><?= $value["points_received"] ?></td> -->
                                    <td><?= $user["name"] ?></td>
                                    <td>
                                        <form action="#" method="POST">
                                            <button class="btn btn-sm btn-outline-dark  btn-detail ms-1"style="background-color: #013221; color: white;" value='<?= $value["id_htrans"] ?>' name="btnDetTrans">Detail</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div id="cancel" class="mt-5">
                <h2>Cancelled</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <!-- <th>Points Used</th>
                            <th>Points Received</th> -->
                            <th>Customer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($hTrans as $key => $value){
                                $idUser = $value["id_user"];
                                $stmt = $conn->query("SELECT * FROM users WHERE id_user='$idUser'");
                                $user = $stmt->fetch_assoc();
                                if($value["status"] == "Cancelled"){
                                ?>
                                <tr>
                                    <td><?= $value["id_htrans"] ?></td>
                                    <td><?= date("d/m/Y", strtotime($value["trans_date"])) ?></td>
                                    <td>Rp <?= number_format($value["total"],0,'.','.') ?></td>
                                    <!-- <td><?= $value["points_used"] ?></td>
                                    <td><?= $value["points_received"] ?></td> -->
                                    <td><?= $user["name"] ?></td>
                                    <td>
                                        <form action="#" method="POST">
                                            <button class="btn btn-sm btn-outline-dark  btn-detail ms-1" style="background-color: #013221; color: white;" value='<?= $value["id_htrans"] ?>' name="btnDetTrans">Detail</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        }
        else{
            ?>
            <h1>No Results</h1>
        <?php
        }
    ?>
    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>