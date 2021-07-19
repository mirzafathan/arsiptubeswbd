<?php
    require_once "../db_connect.php";
    if(!isset($_COOKIE["name"]) || !isset($_COOKIE["pass"])){
        header("location: login.php");
    }
    if(isset($_GET['search'])){
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
    <link rel="stylesheet" href="../css/style-navigation-bar.css">
    <link rel="stylesheet" href="../css/style-search.css">
</head>
<body class="detail">
    <div class="navBar">
        <div class="navBar-left">
            <a href="../index.php">Home</a>
            <?php
                if($_COOKIE["auth"] == "superuser"){
                    echo "<a href=''>Add New Chocolate</a>";
                }else{
                    echo "<a href='history.php'>History</a>";
                }
            ?>
        </div>
        <div class="navBar-center">
            <form action="" method="GET" class="search-boxs">
                <input type="text" placeholder="search..." name="search-box" value="<?php echo "{$_GET['cname']}";?>">
                <button type="submit" name="search">search</button>
            </form>
        </div>
        <div class="navBar-right">
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <?php
        $name = "{$_GET['cname']}";
        $query = "SELECT * FROM willy_wangky.coklat WHERE name LIKE '%$name%' LIMIT 10";
        $statement = $conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row){
            echo "<div class='search-container'>";
            echo "<a href='detail-{$_COOKIE['auth']}.php?id={$row['id']}'>";
            $dirImg = "../{$row['image']}";
            echo "<img src='{$dirImg}'>";
            echo "<div class='detail-cont'>";
            echo "<pre class='choco-name'>{$row['name']}</pre>";
            echo "<pre>Amount sold     : {$row['sold']}</pre>";
            echo "<pre>Price           : Rp{$row['price']}</pre>";
            echo "<pre>Amount remaining: {$row['amount']}</pre>";
            echo "<pre>Description</pre>";
            echo "<p id='desc'>{$row['description']}</p>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
        }
    ?>
</body>
</html>