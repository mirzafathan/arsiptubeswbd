<?php
	$id = $_GET['id'];
	$con = mysqli_connect("localhost","root","","tutorial");
	$query= "select * FROM buychoco WHERE id_choco=$id"; 
	$result=mysqli_query($con,$query); 
	$rows=mysqli_fetch_assoc($result);
 	echo $rows['img'];