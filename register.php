<?php
require('dbconnect.php'); // เชื่อมต่อกับไฟล์ ฐานข้อมูล // Start the session
session_start();
$sql = "INSERT INTO `login`( `email`, `pass`) VALUES ('$_GET[email]','$_GET[pass]')"; //เอาข้อมูล เมลกับ พาสเวอร์ มาตรวจสอบ ว่าตรงไหม ถ้าตรงจะเข้าได้
$result = mysqli_query($con, $sql); // ดึงข้อมูลจาก บรรทัดบน มาแสดง   รันคำสั่งที่ถูกดห็บไว้ในตัวแปร$sql
echo $sql;


header( "location:http://localhost/project/new/index.php?noti=registersuccess" );
?> 