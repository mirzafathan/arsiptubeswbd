<!-- PHP Login -->
<?php
  // Connect DB
  require_once "../db_connect.php";

  // Check Cookie
  if(isset($_COOKIE["name"]) && isset($_COOKIE["pass"])){
    header("location: ../index.php");
  }

  // Get POST method from login
  if(isset($_POST["login"])){
    // Filtering input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
    // Compare input in DB
    $query = "SELECT * FROM willy_wangky.account WHERE email=:email";
    $statement = $conn->prepare($query);
    $parameter = array(':email' => $email);
    $statement->execute($parameter);
    $user = $statement->fetchAll();
    if(count($user) > 0){
      foreach($user as $row){
        if($password == $row["password"]){
          setcookie("name", $row["username"], time()+3600, '/');
          setcookie("pass", $row["password"], time()+3600, '/');
          setcookie("auth", $row["authorization"], time()+3600, '/');
          header("location: ../index.php");
        }else{
          $message = "Wrong Password";
          echo "<script name='text/javascript'>alert('$message');</script>";
        }
      }
    }
  }
?>
<!-- PHP Login -->

<!-- HTML Login -->
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="../css/style-login.css">
</head>
<body class="main">
<div >
  <!-- Form input -> POST -->
  <form class="modal-content" method="POST">
    <div class="container">
      <h1>Willy Wangky Choco Factory</h1>
      <hr>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <div class="clearfix">
        <button type="submit" class="loginbutton" name="login">Log In</button>
      </div>
      <p>Don't have account?</p>
      <a href="register.php">sign up</a>
    </div>
  </form>
</div>
</body>
</html>
<!-- HTML Login-->