<?php
require('dbconnect.php'); // เชื่อมต่อกับไฟล์ ฐานข้อมูล
session_start();

$sql = "SELECT ID,name, price, pic FROM food";
$result = mysqli_query($con, $sql);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>เกี่ยวกับเรา</title>

    <script>
        function removeoder(i) {
            var x = document.getElementById("oder" + i).innerHTML - 1;

            document.getElementById("oder" + i).innerHTML = x;

        }

        function addoder(i) {
            var x = parseInt(document.getElementById("oder" + i).innerHTML) + 1;

            document.getElementById("oder" + i).innerHTML = x;

        }
    </script>
</head>

<body>

    <div>
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
    </div>
    <!-- Modal เข้าสู่ระบบ-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="login.php" method="get">
                    <div class="modal-header">
                        <h5 class="modal-title">เข้าสู่ระบบ</h5>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>


                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Modal เข้าสู่ระบบ-->
    <!-- Button trigger modal สมัครสมาชิก-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="register.php" onsubmit="return validateForm(event)" method="get">
                    <div class="modal-header">
                        <h5 class="modal-title">สมัครสมาชิก</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">confirmPassword</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="cfpass">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Button trigger modal สมัครสมาชิก-->



    <div>
        <div class="nav">
            <div><img class="pic4 menu3" src="pic/0001.jpg"></div>
            <div class="menu3 pic5">
                ร้านซูชิที่เราเปิดมาแล้ว 4 ปี ได้กลายเป็นสถานที่ที่ผู้คนต้องการมาลิ้มลองความอร่อยของซูชิและประสบการณ์ที่สะอาดสะอ้านไปพร้อมกัน ด้วยรสชาติที่นุ่มละมุนและความสดของส่วนผสมที่คัดสรรอย่างดี ร้านซูชิของเราเสนอแนวคิดใหม่ที่เน้นความสดใหม่และคุณภาพสูง เพื่อให้ลูกค้าได้สัมผัสประสบการณ์การทานอาหารที่น่าประทับใจและอร่อยอีกครั้ง ด้วยบริการที่เป็นมืออาชีพและบรรยากาศที่อบอุ่นเป็นกันเอง เรามุ่งมั่นที่จะให้ทุกคนมีประสบการณ์ที่ยิ่งใหญ่ในการรับประทานอาหารที่ร้านของเราแห่งนี้ โดยเรามุ่งมั่นในการรักษาคุณภาพของอาหารและความสะอาดในทุกขั้นตอนของการทำอาหาร นอกจากนี้เรายังให้ความสำคัญกับการตอบสนองต่อความต้องการและความพึงพอใจของลูกค้าในทุกๆ รายละเอียด ด้วยทีมงานที่มีความสามารถและประสบการณ์ เรามั่นใจว่าทุกท่านจะได้รับประสบการณ์ที่ดีที่สุดที่นี่ ร้านซูชิของเรายินดีต้อนรับทุกท่านทุกครั้งที่เข้ามาสัมผัสประสบการณ์การทานอาหารที่เราให้ได้สมบูรณ์แบบและอร่อยที่สุดในท้องทะเล!
            </div>
        </div>
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





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>