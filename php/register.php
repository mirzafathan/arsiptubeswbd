<!-- PHP Register -->
<?php
  // Connect DB
  require_once "../db_connect.php";

  // Check Cookie
  if(isset($_COOKIE["name"]) && isset($_COOKIE["pass"])){
    header("location: ../index.php");
  }

  // Get POST method from register
  if(isset($_POST["register"])){
    // Filtering input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirm = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_STRING);
    if($password == $confirm){
        // insert input in DB
        $query = "INSERT INTO willy_wangky.account (username, password, email, authorization) VALUES (:username, :password, :email, 'user')";
        $statement = $conn->prepare($query);
        $parameter = array(':username' => $username, ':password' => $password, ':email' => $email);
        $statement->execute($parameter);
        if($statement){
            setcookie("name", $username, time()+3600, '/');
            setcookie("pass", $password, time()+3600, '/');
            setcookie("auth", "user", time()+3600, '/');
            header("location: ../index.php");
        }
    }else{
        $message = "Password doesn't match";
        echo "<script name='text/javascript'>alert('$message');</script>";
    }
  }
?>
<!-- PHP Register -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-register.css">
    <title>Register</title>
</head>
<body class="register">
    <div>
        <form class="register-content" method="POST">
            <div class="container">
                <h1>Willy Wangky Choco Factory</h1>
                <hr>
                <label for="username">Username</label>
                <input type="text" placeholder="Enter username" name="username" required>
                <label for="email">Email</label>
                <input type="email" placeholder="Enter email" name="email" required>
                <label for="password">Password</label>
                <input type="password" placeholder="Enter password" name="password" required>
                <label for="confirm">Confirm Password</label>
                <input type="password" placeholder="Reenter password" name="confirm" required>
                <div>
                    <button type="submit" name="register">Register</button>
                </div>
            </div>
            <p>Already have an account?</p>
            <a href="login.php">login</a>
        </form>
    </div>
</body>
</html>