<?php

$sName = "localhost";
$uName = "root";   //Sesuai pengguna
$pass = "";     //Sesuai pengguna
$db_name = "willy_wangky";

try{
    $conn = new PDO("mysql:host=$sName;db_name=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "[CONNECTION FAILED] : ". $e->getMessage();
}