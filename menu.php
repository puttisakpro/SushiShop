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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
"></script>
    <link href="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css
" rel="stylesheet">
    <title>สินค้าของเรา</title>

    <script>
        function removeoder(i) {
            var x = document.getElementById("oder" + i).innerHTML - 1;
            if (x < 0) {
                x = 0;

            }
            document.getElementById("oder" + i).innerHTML = x;


        }

        function addoder(i) {
            var x = parseInt(document.getElementById("oder" + i).innerHTML) //oder คือไอดี เรียกไอดี  i คือ databade  รับค่ามาจากบรรทัดที่ 137

            x = x + 1;

            document.getElementById("oder" + i).innerHTML = x;



        }

        var checklogin = `<?php
                            if (isset($_SESSION["email"])) {
                                echo $_SESSION["email"];
                            } else {
                                echo "";
                            } ?>`


        function basket(i) {

            if (checklogin == "") {
                Swal.fire({
                    title: "คุณไม่ได้ล๊อกอินกรุณาล๊อกอินก่อน",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "ล๊อกอิน",
                    denyButtonText: `สมัครมาชิก`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */

                    if (result.isConfirmed) {
                        document.getElementById('login').click();
                    } else if (result.isDenied) {
                        document.getElementById('register').click();
                    }

                });
            } else {



                let x = parseInt(document.getElementById("oder" + i).innerHTML);
                document.getElementById("oder" + i).innerHTML = 0;
                let img = (document.getElementById("img" + i).getAttribute("src"));
                let name = (document.getElementById("name" + i).innerHTML);
                let price = parseInt(document.getElementById("price" + i).innerHTML);

                let y = parseInt(document.getElementById("quantity").innerHTML);


                let z = x + y;

                document.getElementById("quantity").innerHTML = z;

                sessionStorage.setItem("quantity", z);

                let oderAddCart = {
                    orderId: i,
                    quantity: x,
                    img: img,
                    name: name,
                    price: price

                }
                console.log(sessionStorage.getItem("inCart"))
                if (sessionStorage.getItem("inCart")) {

                    let inCart = JSON.parse(sessionStorage.getItem("inCart"))
                    let indexInCart = inCart.findIndex(function(e) {
                        return e.orderId == i
                    })

                    if (indexInCart >= 0) {
                        console.log(inCart)
                        console.log(oderAddCart)
                        oderAddCart.quantity = oderAddCart.quantity + inCart[indexInCart].quantity

                        inCart[indexInCart] = oderAddCart
                        sessionStorage.setItem("inCart", JSON.stringify(inCart))
                    } else {
                        inCart.push(oderAddCart)
                        sessionStorage.setItem("inCart", JSON.stringify(inCart))
                    }
                } else {
                    let inCart = [oderAddCart]
                    sessionStorage.setItem("inCart", JSON.stringify(inCart))
                }

            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (sessionStorage.getItem("quantity"))
                document.getElementById("quantity").innerHTML = sessionStorage.getItem("quantity");


        });

        function showmodalcart(


        ) {
            document.getElementById("pic88").innerHTML = ""
            if (sessionStorage.getItem("inCart")) {
                var email = document.getElementById("email").innerHTML
                let inCart = JSON.parse(sessionStorage.getItem("inCart"))
                for (let index = 0; index < inCart.length; index++) {
                    const element = inCart[index];
                    console.log(inCart);
                    document.getElementById("pic88").innerHTML += ` <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label"><img class="pic23" src="${element.img}"></label>
                        <label for="exampleInputEmail1" class="form-label pic23 menu4">${element.name}</label>
                        <label for="exampleInputEmail1" class="form-label pic23">ราคา ${element.price} บาท</label>
                        <label for="exampleInputEmail1" class="form-label pic23"> <button type="button" onclick="removeoderincart(${element.orderId})" style="height: 30px; width:30px;">-</button>
                            <span id="inCartOder${element.orderId}"> ${element.quantity}</span> ชิ้น
                            <button type="button" onclick="addoderincart(${element.orderId})" style="height: 30px; width: 30px;">+</button>
                        </label>
                      
                        <input type="text" name="quantity[]"value="${element.quantity}" hidden>
                        <input type="text" name="email"value="${email}" hidden>
                        <input type="text" name="foodid[]"value="${element.orderId}" hidden>

                    </div>`
                }

            }
        }

        function removeoderincart(i) {
            var x = document.getElementById("inCartOder" + i).innerHTML - 1;
            console.log(document.getElementById("inCartOder" + i).innerHTML);
            if (x < 0) {
                x = 0;

            }
            document.getElementById("inCartOder" + i).innerHTML = x;


        }

        function addoderincart(i) {
            var x = parseInt(document.getElementById("inCartOder" + i).innerHTML) //oder คือไอดี เรียกไอดี  i คือ databade  รับค่ามาจากบรรทัดที่ 137

            x = x + 1;

            document.getElementById("inCartOder" + i).innerHTML = x;



        }

        function buyclear() {
            sessionStorage.setItem("inCart", JSON.stringify([]))
            sessionStorage.setItem("quantity", 0);

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
                    </li> <?php } else { ?> <li class="logo3"><a id="email"><?php echo (($_SESSION["email"])) ?></a></li> <?php }  ?>
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
        <h2 style="text-align:center;">เมนูอาหาร</h2>
    </div>
    <br>
    <div class="nav nav3">
        <?php if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="nav">
                    <div>


                        <div><img id="img<?php echo $row['ID']  ?>" class="pic22" src="<?php echo "pic/" . $row["pic"] ?>"></div>
                        <br>
                        <p id="name<?php echo $row['ID']  ?>"><?php echo $row["name"] ?> </p>

                        <p id="price<?php echo $row['ID']  ?>"><?php echo $row["price"] . " บาท." ?> </p>
                        <div class="">

                            <button onclick="removeoder(<?php echo $row['ID']  ?>)" style="height: 50px; width: 50px;">-</button>

                            <span id="oder<?php echo $row['ID']  ?>">0</span>

                            <button onclick="addoder(<?php echo $row['ID']  ?>)" style="height: 50px; width: 50px;">+</button>

                            <button class="menu3" onclick="basket(<?php echo $row['ID']  ?>)">เพิ่มใส่ตะกร้า</button>



                        </div>

                    </div>


                </div>
        <?php
            }
        } else {
            echo "0 results";
        }
        ?>

        <!-- Modal -->
        <div class="modal fade" id="basket2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width: 850px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="Orders.php" onsubmit="return buyclear()" method="get">
                        <div class="modal-header">
                            <h2>ตะกร้าสินค้า</h2>
                        </div>
                        <div class="modal-body" id="pic88">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">สั่งสินค้า</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <!-- ตระกล้าสินค้า -->
            <div class="market footer2">
                <span class="market2" id="quantity">0</span>

                <i class="fa-solid fa-cart-shopping" onclick="showmodalcart()" style="font-size: 30px; padding:15px;">

                    <br>

                    <h5 data-bs-target="#basket2" data-bs-toggle="modal" id="basket2">ตะกร้าสินค้า</h5>
                </i>
            </div>
            <!-- ตระกล้าสินค้า -->
        </div>
    </div>

    <div class="">


        <div class="footer2">

            <div class="footer3">
                <ul class="footer4">
                    <li class="logo3"><img src="pic/logo1.jpg" class="conten3 logo"></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


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