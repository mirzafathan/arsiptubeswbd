<?php
    require_once "../db_connect.php";
    if(!isset($_COOKIE["name"]) || !isset($_COOKIE["pass"])){
        header("location: php/login.php");
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
    <title>History</title>
    <link rel="stylesheet" href="../css/detail-pengguna.css">
    <link rel="stylesheet" href="../css/style-navigation-bar.css">
    <link rel="stylesheet" href="../css/table.css">
</head>
<body class="detail" style="margin:0;">
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

    <h1 style="padding:20px 0 20px 150px;  margin: 50px 30px 30px 30px;">Transaction History</h1>
    <table align="center" rules="rows">
        <tr>
            <td><b>Chocolate Name</td>
            <td><b>Amount</td>
            <td><b>Total Price</td>
            <td><b>Date</td>
            <td><b>Time</td>
            <td><b>Address</td>
        </tr>
        <?php
            $query = "SELECT * FROM willy_wangky.history WHERE username=:username";
            $statement = $conn->prepare($query);
            $parameter = array(':username' => $_COOKIE["name"]);
            $statement->execute($parameter);
            $result = $statement->fetchAll();
            foreach($result as $row){
                echo "<tr>";
                echo "<td>{$row['name']}</td> ";
                echo "<td>{$row['amount']}</td> ";
                echo "<td>{$row['total_price']}</td> ";
                echo "<td>{$row['date']}</td> ";
                echo "<td>{$row['time']}</td> ";
                echo "<td>{$row['address']}</td> ";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>