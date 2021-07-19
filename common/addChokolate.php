<?php
    require_once "../db_connect.php";
    if(!isset($_COOKIE["name"]) || !isset($_COOKIE["pass"])){
        header("location: php/login.php");
    }
    if($_COOKIE["auth"] == "superuser"){
        header("location: detail-superuser.php?id={$_GET['id']}");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willy Wangky</title>
    <link rel="stylesheet" href="../css/detail-pengguna.css">
    <link rel="stylesheet" href="../css/style-navigation-bar.css">
<style>

.Input{
    width: 500px;
    margin-left:  50px;
}
.Amount{
    width: 500px;
    margin-left:  25px;
}
.description{
    width: 500px;
    height: 200px;
    margin-left:  80px;
}
.Sumbit_image{
    width: 100px
    float : right;
    margin-left:  40px;
}
.Sumbit_ADD{
    width: 100px
    float : right;
    margin-left:  520px; 
}


</style>
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
    <form method="POST">
        <label for="name">name</label>
        <input class = "Input" placeholder="name" name="name" required>
        <br></br>
        <label for="price">price</label>
        <input class = "Input" placeholder="Enter price" name="price" required>
        <br></br>
        <label for="description">description</label>
        <br></br>
        <textarea class = "description" placeholder="description" name="description" required></textarea>
        <br></br>
        <label for="image">image</label>
        <input class = "Sumbit_image" type="file" name="Sumbit_image" id="Sumbit_image" value="Sumbit_image">
        <br><br>
        <label for="Amount">Amount</label>
        <input class = "Amount" placeholder="Amount" name="Amount" required>
        <br></br>
        <tr>
        <td>
        <input calss = "Sumbit_ADD" type="submit" name="simpan" value="Simpan">
        </td>
        </tr>
 </form>
    <?php
        $sold = 0
        $nama = @$_POST['name'];
        $price = @$_POST['price'];
        $description = @$_POST['description'];
        $Amount = @$_POST['Amount'];
        $nama_file = @$_FILES['Sumbit_image']['name'];
        $tipe_file = @$_FILES['Sumbit_image']['type'];
        $path = "img/".$nama_file;
        $tmp_file = $_FILES['Sumbit_image']['tmp_name'];
        

          if (isset($_POST['simpan'])) {
               if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
                    if(move_uploaded_file($tmp_file, $path)){
                        echo "upload";
                        $sql_simpan = mysqli_query ($conn,"INSERT into coklat VALUES ('$nama','$sold', '$price','$Amount','$description','$path')");
                        if ($sql_simpan) {
            
                            echo "data berhasil disimpan";
                    }else{
                            echo "data gagal disimpan".mysqli_error($conn);
                    }
                }
               }
          }

        
    ?>

        
</body>
</html>