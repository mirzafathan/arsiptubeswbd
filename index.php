<?php
    require_once "db_connect.php";
    if(!isset($_COOKIE["name"]) || !isset($_COOKIE["pass"])){
        header("location: php/login.php");
    }
    if(isset($_GET["search"])){
        $cname = filter_input(INPUT_GET, 'search-box', FILTER_SANITIZE_STRING);
        header("location: php/search.php?cname={$cname}");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willy Wangky</title>
    <link rel="stylesheet" href="css/style-navigation-bar.css">
    <link rel="stylesheet" href="css/style-dashboard-pengguna.css">
</head>
<body class="detail">
    <div class="navBar">
        <div class="navBar-left">
            <a href="index.php">Home</a>
            <?php
                if($_COOKIE["auth"] == "superuser"){
                    echo "<a href=''>Add New Chocolate</a>";
                }else{
                    echo "<a href='php/history.php'>History</a>";
                }
            ?>
        </div>
        <div class="navBar-center">
            <form action="" method="GET" class="search-boxs">
                <input type="text" placeholder="search..." name="search-box">
                <button type="submit" name="search">search</button>
            </form>
        </div>
        <div class="navBar-right">
            <a href="php/logout.php">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="top">
            <?php
                echo "<p id='hello'>Hello {$_COOKIE['name']}</p>";
                echo "<button type='submit' id='all-choco'>All chocolate</button>";
            ?>
        </div>
        <!-- Generate chocolate based on amount -->
        <?php
            $query = "SELECT * FROM willy_wangky.coklat ORDER BY sold DESC LIMIT 10";
            $statement = $conn->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row){
                echo "<div class='dashboard-container'>";
                echo "<div class='choco-pic'>";
                if($_COOKIE["auth"] == "superuser"){
                    echo "<a href='php/detail-superuser.php?id={$row['id']}'><img src='{$row['image']}'></a>";
                    echo "</div>";
                    echo "<div class='choco-des'>";
                    echo "<a href='php/detail-superuser.php?id={$row['id']}'class='name-on-hover'>{$row['name']}</a>";
                }else{
                    echo "<a href='php/detail-user.php?id={$row['id']}'><img src='{$row['image']}'></a>";
                    echo "</div>";
                    echo "<div class='choco-des'>";
                    echo "<a href='php/detail-user.php?id={$row['id']}'class='name-on-hover'>{$row['name']}</a>";
                }
                echo "<pre>Amount sold: {$row['sold']}</pre>";
                echo "<pre>Price      : Rp{$row['price']}</pre>";
                echo "</div>";
                echo "</div>";
            }
        ?>
    <!-- Generate chocolate based on amount -->
    </div>
</body>
</html>