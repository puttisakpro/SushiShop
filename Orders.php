<?php
date_default_timezone_set("Asia/Bangkok");
$foodid=$_GET['foodid'];
$quantity=$_GET['quantity'];
print_r($foodid);

require('dbconnect.php'); // เชื่อมต่อกับไฟล์ ฐานข้อมูล // Start the session
session_start();
$date = date("Y-m-d H:i:s");
$sql = "INSERT INTO `newtableoder`(`loginid`, `updatatime`) VALUES ((select ID from login where email = '$_GET[email]'),'$date')"; //เอาข้อมูล เมลกับ พาสเวอร์ มาตรวจสอบ ว่าตรงไหม ถ้าตรงจะเข้าได้
echo $sql;
$result = mysqli_query($con, $sql); // ดึงข้อมูลจาก บรรทัดบน มาแสดง   รันคำสั่งที่ถูกดห็บไว้ในตัวแปร$sql

$sql = "SELECT  * FROM newtableoder order by ID desc limit 1"; //เอาข้อมูล เมลกับ พาสเวอร์ มาตรวจสอบ ว่าตรงไหม ถ้าตรงจะเข้าได้
$result = mysqli_query($con, $sql); // ดึงข้อมูลจาก บรรทัดบน มาแสดง   รันคำสั่งที่ถูกดห็บไว้ในตัวแปร$sql
$text = "";

while ($row = $result->fetch_assoc()) {
    
    for ($i = 0; $i < count($foodid); $i++) {
        $text .= "('$date','$foodid[$i]','$quantity[$i]','$row[ID]'),";
    }
}

$text = substr($text,0,-1);

$sql = "INSERT INTO `oderdetail`( `updatatime`, `foodid`, `quantity`, `oderid`) VALUES ".$text; //เอาข้อมูล เมลกับ พาสเวอร์ มาตรวจสอบ ว่าตรงไหม ถ้าตรงจะเข้าได้
echo $sql;
$result = mysqli_query($con, $sql);
header( "location:http://localhost/project/new/myOrder.php?noti=ordersuccess" ); 

?>