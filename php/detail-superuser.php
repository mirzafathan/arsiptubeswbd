<?php
    require_once "../db_connect.php";
    if(!isset($_COOKIE["name"]) || !isset($_COOKIE["pass"])){
        header("location: login.php");
    }
    if($_COOKIE["auth"] == "user"){
        header("location: detail-user.php?id={$_GET['id']}");
    }
    if(isset($_GET["search"])){
        $cname = filter_input(INPUT_GET, 'search-box', FILTER_SANITIZE_STRING);
        header("location: search.php?cname={$cname}");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willy Wangky</title>
    <link rel="stylesheet" href="../css/style-detail-superuser.css">
    <link rel="stylesheet" href="../css/style-navigation-bar.css">
</head>
<body class="detail">
    
    <!-- Navigation Bar -->
    <div class="navBar">
        <div class="navBar-left">
            <a href="../index.php">Home</a>
            <a href="">Add New Chocolate</a>
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

    <div class="detail-superuser">
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
        <div id="add-active">
            <div id="add-detail-1">
                <p>Amount to Add:</p>
            </div>
            <div id="add-detail-2">
                <button class="count-box-button">-</button>
                <p id="count-box">0</p>
                <button class="count-box-button">+</button>
            </div>
            <button class="button-active">Add</button>
            <button  class="button-active" onclick="addCanceled()">Cancel</button>
        </div>
        <button id="add" onclick="addActived()">Add Stock</button>
        <script src="../js/script-detail-superuser.js"></script>
    </div>
</body>
</html>