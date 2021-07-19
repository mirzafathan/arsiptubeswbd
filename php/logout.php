<!-- Logout -->
<?php
    setcookie("name", "", time()-3600, '/');
    setcookie("pass", "", time()-3600, '/');
    setcookie("authorization", "", time()-3600, '/');
    header("location:login.php");
    exit();
?>