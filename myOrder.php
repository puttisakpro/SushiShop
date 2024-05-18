<?php
require('dbconnect.php'); // เชื่อมต่อกับไฟล์ ฐานข้อมูล
session_start();

$sql = "select  newtableoder.creathtime,food.pic,food.name,food.price,oderdetail.quantity from oderdetail left join newtableoder on newtableoder.ID = oderdetail.oderid left join food on food.ID = oderdetail.foodid where loginid = ( select ID from login where email = '$_SESSION[email]')";
$result = mysqli_query($con, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css.css">
    <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
        "></script>
    <link href="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css
        " rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const urlParams = new URLSearchParams(window.location.search);
            const myParam = urlParams.get('noti');
            if (myParam == "ordersuccess") {
                Swal.fire({
                    title: "สั่งอาหารสำเร็จ!",
                    text: "",
                    icon: "success"
                });
                // alert("สั่งอาหารสำเร็จ")
            }


        });
    </script>
</head>

<body>
    <div class="">

        <ul class="nav nav4">
            <li class=" "><img src="pic/logo2.jpg" class="logo"></li>
            <li class=" "><a href="index.php">หน้าแรก</a></li>
            <li class=" "><a href="menu.php">สินค้าของเรา</a></li>
            <?php if (!isset($_SESSION["email"])) { ?> <?php } else { ?> <li class="logo3"><a href="myOrder.php">คำสั่งซื้อทั้งหมด</a></li> <?php }  ?>
            <li class=" "><a href="aboutMe.php">เกี่ยวกับเรา</a></li>

            <li class=" "><a href="contactMe.php">ติดต่อเรา</a></li>
            <?php if (!isset($_SESSION["email"])) { ?><li class="logo3" style="margin: auto 0;">
                    <a href="#" data-bs-target="#exampleModal" data-bs-toggle="modal" id="login">เข้าสู่ระบบ</a>
                </li> <?php } else { ?> <li class="logo3"><a href="logout.php">ออกจากระบบ</a></li> <?php }  ?>


            <?php if (!isset($_SESSION["email"])) { ?>
                <li class="logo3" style="margin: auto 0;">
                    <a href="#" data-bs-target="#exampleModal2" data-bs-toggle="modal" id="register">สมัครสมาชิก</a>
                </li> <?php } else { ?> <li class="logo3"><a><?php echo (($_SESSION["email"])) ?></a></li> <?php }  ?>

        </ul>
    </div>
    <div class="">

        <h2 class="nav">คำสั่งซื้อ</h2>


        <div>
            <form action="">
                <div class="row">
                    <div class="card cardnoborder card-bg theme-font mb-lg-3 card-cart-list2">
                        <div class="col-12 d-lg-none border-top"></div>
                        <div class="card-header px-0 pt-3 pb-2 p-lg-3 mb-3 mb-lg-0 nat2">
                            <table class=" wt40">

                                <tr>
                                    <th>วันที่สั่งสินค้า</th>
                                    <th>สินค้า</th>
                                    <th>ราคา/ชิ้น</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                </tr>
                                <?php if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['creathtime']  ?></td>
                                            <td><?php echo $row['name']  ?></td>
                                            <td><?php echo $row['price']  ?></td>
                                            <td><?php echo $row['quantity']  ?></td>
                                            <td><?php echo $row['price'] * $row['quantity']  ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </table>


                        </div>
                    </div>
                </div>

            </form>

        </div>


        <div class="">


            <div class="footer2">

                <div class="footer3">
                    <ul class="footer4">
                        <li class="logo3"><img src="pic/logo2.jpg" class="conten3 logo"></li>
                    </ul>
                </div>

                <div class="footer5">รายละเอียด
                    <ul class="footer22">
                        <li>หจก.บีลั้ค.กี้ เลขที่ 3 ซ.เย็นจิต 12</li>
                        <li>แขวงทุ่งวัดดอน เขตสาทร</li>
                        <li>กรุงเทพฯ 10120</li>
                    </ul>
                </div>

                <div class="footer5">รายละเอียด
                    <ul class="footer22 ">
                        <li>Tel : 02-212-2410-4</li>
                        <li>Fax : 02-212-3074</li>
                        <li>Email : Sale@belucky.co.th</li>
                    </ul>

                </div>

            </div>
            <ul class="footer2 ">
                <li><a href="" class="logo3"><i class="fa-brands fa-facebook"></i> facebook</a> </li>
                <li><a href="" class="logo3"><i class="fa-brands fa-twitter"></i> X</a></li>
                <li><a href="" class="logo3"><i class="fa-brands fa-youtube"></i> youtube</a></li>
                <li><a href="" class="logo3"><i class="fa-solid fa-map"></i> map</a></li>


            </ul>
        </div>
    </div>

</body>

</html>