<?php
require('dbconnect.php'); // เชื่อมต่อกับไฟล์ ฐานข้อมูล // Start the session
session_start();
$sql = "SELECT * FROM `login` WHERE email= '$_GET[email]'  AND pass='$_GET[pass]';"; //เอาข้อมูล เมลกับ พาสเวอร์ มาตรวจสอบ ว่าตรงไหม ถ้าตรงจะเข้าได้
$result = mysqli_query($con, $sql); // ดึงข้อมูลจาก บรรทัดบน มาแสดง   รันคำสั่งที่ถูกดห็บไว้ในตัวแปร$sql
echo $sql;

if ($result->num_rows > 0) {
  $_SESSION["email"] = "$_GET[email]";
  echo $_SESSION["email"] ;
  header( "location:http://localhost/project/new/index.php?noti=loginsuccess" );
} else {
  header( "location:http://localhost/project/new/index.php?noti=loginerror" );
}


?>