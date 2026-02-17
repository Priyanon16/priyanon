<?php

    $host = "localhost";
	   $user = "root";
	   $pwd = "";
	   $db = "2608db";
       $conn = mysqli_connect($host, $user, $pwd, $db) or die ("เชื่อมต่อฐานข้อมูลไม่ได้"); //เชื่อมฐานข้อมูลดาต้าเบส
	   mysqli_query($conn, "SET NAMES utf8"); //อ่านหรือบันทึกข้อมูลภาษาไทยได้

?>