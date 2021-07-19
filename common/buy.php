<?php 
include_once('connection.php');
$query= "SELECT * FROM buychoco"; 
$result=mysqli_query($con,$query); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy</title>
    <link rel="stylesheet" href="../css/detail-pengguna.css">
    <link rel="stylesheet" href="../css/style-navigation-bar.css">
    <link rel="stylesheet" href="../css/style-buy.css">
</head>
<body class="detail">
    <div class="navBar">
        <div class="navBar-left">
            <a href="">Home</a>
            <a href="">History</a>
        </div>
        <div class="navBar-center">
            <input type="text" placeholder="search...">
        </div>
        <div class="navBar-right">
            <a href="">Logout</a>
        </div>
    </div>
    <div class="image-placeholder">
        <img src="getImage.php?id=1" width="300" height="300" />     
    </div> 
    <div class="description">
        <?php
            while($row = mysqli_fetch_assoc($result)) {
                echo "<p'>" . $row['choco_name'] . "</p>";
                echo "<p'>"."Amount Sold:" . $row['amount_sold'] . "</p>";
                echo "<p'>"."Price:" . $row['price'] . "</p>";
                $price=(int)$row['price'];
                echo "<p'>"."Amount Remaining:" . $row['amount_remaining'] . "</p>";
                echo "<p'>"."description: </br>" . $row['description'] . "</p>";
   }
        ?>
    </div>

    <div class="add">
        <input type="button" value="-" id="minbutton" />
        <span id="displayCount">0</span>
        <input type="button" value="+" id="addbutton" />
        
        <div class="total">
            <h3>Total Price</h3>
            <span id="totalprice">0</span>   
        </div>
        <script>

            var count = 0;
            var countButton = document.getElementById("addbutton");
            var displayCount = document.getElementById("displayCount");
            var totalprice = document.getElementById("totalprice");
            var total = <?php echo $price?>;
            addbutton.onclick = function(){
              count++;
              displayCount.innerHTML = count;
              totalprice.innerHTML = count*total;
            }
            minbutton.onclick = function(){
              if (count != 0 ) { 
                count--;
                displayCount.innerHTML = count;
                totalprice.innerHTML = count*total;}
             
            }
        </script>
    </div>
    <div class="address">
        <label for="confirm">Address</label> </br>
        <input type="text" placeholder="insert your address" name="address"> </br>
        <button >Cancel</button>
        <button >Buy</button>
            
    </div>

</body>
</html>