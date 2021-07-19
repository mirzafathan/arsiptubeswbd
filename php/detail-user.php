<?php
    require_once "../db_connect.php";
    if(!isset($_COOKIE["name"]) || !isset($_COOKIE["pass"])){
        header("location: login.php");
    }
    if($_COOKIE["auth"] == "superuser"){
        header("location: detail-superuser.php?id={$_GET['id']}");
    }
    if(isset($_GET["search"])){
        $cname = filter_input(INPUT_GET, 'search-box', FILTER_SANITIZE_STRING);
        header("location: search.php?cname={$cname}");
    }
    if(isset($_POST['buy-choco'])){

        $idc = $_GET['id'];
        $query = "SELECT * FROM willy_wangky.coklat WHERE id=:idc";
        $statement = $conn->prepare($query);
        $parameter = array(':idc' => $idc);
        $statement->execute($parameter);
        $result = $statement->fetchAll();
        foreach($result as $row){
            $price = $row['price'];
            $name = $row['name'];
        }
        // insert input in DB
        $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_STRING);
        $tot_price = $price * $amount;
        $dates = date('Y-m-d');
        $times = date('h:i:s');
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $user = $_COOKIE["name"];

        $query = "SELECT * FROM willy_wangky.coklat WHERE id=:idc";
        $statement = $conn->prepare($query);
        $parameter = array(':idc' => $idc);
        $statement->execute($parameter);
        $result = $statement->fetchAll();
        foreach($result as $row){
            $old_amount = $row['amount'];
        }
        if($old_amount >= $amount){
            // update DB
            $query = "UPDATE willy_wangky.coklat SET amount=amount-:new_amount, sold=sold+:new_amount WHERE id=:idc";
            $statement = $conn->prepare($query);
            $parameter = array(':new_amount' => $amount, ':idc' => $idc);
            $statement->execute($parameter);
    
            $query = "INSERT INTO willy_wangky.history (name, amount, total_price, date, time, address, username) VALUES (:name, :amount, :total_price, :date, :time, :address, :username)";
            $statement = $conn->prepare($query);
            $parameter = array(':name' => $name, ':amount' => $amount, ':total_price' => $tot_price, ':date' => $dates, ':time' => $times, ':address' => $address, ':username' => $_COOKIE["name"]);
            $statement->execute($parameter);
            if($statement){
                header("location: ../index.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willy Wangky</title>
    <link rel="stylesheet" href="../css/style-detail-pengguna.css">
    <link rel="stylesheet" href="../css/style-navigation-bar.css">
</head>
<body class="detail">
    
    <!-- Navigation Bar -->
    <div class="navBar">
        <div class="navBar-left">
            <a href="../index.php">Home</a>
            <a href="history.php">History</a>
        </div>
        <div class="navBar-center">
            <form action="" method="GET" class="search-boxs">
                <input type="text" placeholder="search..." name="search-box">
                <button type="submit" name="search">search</button>
            </form>
        </div>
        <div class="navBar-right">
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <!-- Navigation Bar -->

    <div class="detail-pengguna">
        <div class="choco-container">
            <?php
                $idc = $_GET['id'];
                $query = "SELECT * FROM willy_wangky.coklat WHERE id=:idc";
                $statement = $conn->prepare($query);
                $parameter = array(':idc' => $idc);
                $statement->execute($parameter);
                $result = $statement->fetchAll();
                foreach($result as $row){
                    echo "<p id='choco-name'>{$row['name']}</p>";
                    echo "<div id='choco-img'>";
                    $dirImg = "../{$row['image']}";
                    echo "<img src='{$dirImg}'>";
                    echo "</div>";
                    echo "<div id='choco-detail'>";
                    echo "<pre>Amount sold: {$row['sold']}</pre>";
                    echo "<pre>Price      : Rp {$row['price']}</pre>";
                    echo "<pre>Amount     : {$row['amount']}</pre>";
                    echo "<pre>Description</pre>";
                    echo "<p id='desc'>{$row['description']}</p>";
                    echo "</div>";
                }
            ?>
        </div>
        <div id="buy-active">
            <div id="buy-detail-1">
                <p>Amount to Buy:</p>
                <p>Total Price:</p>
            </div>
            <div id="buy-detail-2">
                </div>
                <?php
                    $idc = $_GET['id'];
                    $query = "SELECT * FROM willy_wangky.coklat WHERE id=:idc";
                    $statement = $conn->prepare($query);
                    $parameter = array(':idc' => $idc);
                    $statement->execute($parameter);
                    $result = $statement->fetchAll();
                    foreach($result as $row){
                        $price = $row['price'];
                        $name = $row['name'];
                    }
                ?>
                <form action="" method="POST">
                    <button class="count-box-button" onclick="countM(<?php echo $price?>)">-</button>
                    <input type="text" id="count-box" name="amount" value="0">
                    <button class="count-box-button" onclick="countP(<?php echo $price?>)">+</button>
                    <p id="total-price">Rp0</p>
                    <div id="address-box">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="addr" placeholder="Insert your address" required>
                    </div>
                    <button class="button-active" name="buy-choco">Buy</button>
                </form>
                <button  class="button-active" onclick="buyCanceled()">Cancel</button>
            </div>
        <button id="buy" onclick="buyActived()">Buy now</button>
        <script src="../js/script-detail-pengguna.js"></script>
    </div>
</body>
</html>