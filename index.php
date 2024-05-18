<?php
require('dbconnect.php'); // เชื่อมต่อกับไฟล์ ฐานข้อมูล
session_start();

$sql = "SELECT ID,name, price, pic FROM food LIMIT 3";
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

  <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
"></script>
  <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css
" rel="stylesheet">
  <title>SUSHI</title>
  <script>
    function removeoder(i) {
      var x = document.getElementById("oder" + i).innerHTML - 1;
      if (x < 0) {
        x = 0;

      }
      document.getElementById("oder" + i).innerHTML = x;


    }

    function addoder(i) {

      var x = parseInt(document.getElementById("oder" + i).innerHTML) + 1;

      document.getElementById("oder" + i).innerHTML = x;


    }
    var t = `<?php
              if (isset($_SESSION["email"])) {
                echo $_SESSION["email"];
              } else {
                echo "";
              } ?>`

    function addstore(i) {

    }

    function buy() {


      if (t == '') {

        document.getElementById('login').click();
      }
    }

    function oder2() {
      var x = document.getElementById("oder" + i).innerHTML - 1;
      if (x < 0) {
        x = 0;

      }
      document.getElementById("oder" + i).innerHTML = x;




    }


    function validateForm(i) {

      console.log(i.target.elements.email.value)

      if (i.target.elements.pass.value != i.target.elements.cfpass.value) {
        alert("รหัสผ่าน และรหัสยืนยันรหัสผ่านไม่ถูกต้อง")
        return false
      }

    }

    document.addEventListener('DOMContentLoaded', function() {

      const urlParams = new URLSearchParams(window.location.search);
      const myParam = urlParams.get('noti');
      if (myParam == "registersuccess")
        Swal.fire({
          title: "สมัครบัญชีสำเร็จ!",
          text: "",
          icon: "success"
        })
      if (myParam == "loginsuccess") {
        Swal.fire({
          title: "ล๊อกอินสำเร็จ!",
          text: "",
          icon: "success"
        })
      }
      if (myParam == "loginerror") {
        Swal.fire({
          title: "รหัสผ่านไม่ถูกต้อง!",
          text: "",
          icon: "error"
        })
      }
      if (myParam == "logoutsuccess") {
        Swal.fire({
          title: "ล๊อกเอาท์สำเร็จ!",
          text: "",
          icon: "success"
        })
      }

    });
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

    <img src="pic/sushi1.jpg" alt="">
    <div>
      <br>
      <h2 style="text-align:center;">รายการอาหาร</h2>
      <div style=" text-align: center;">
        <span><img class="pic moving-image" src="pic/001.jpg" alt=""></span>
        <span><img class="pic moving-image" src="pic/002.jpg" alt=""></span>
        <span><img class="pic moving-image" src="pic/003.jpg" alt=""></span>
        <span><img class="pic moving-image" src="pic/004.jpg" alt=""></span>
        <span><img class="pic moving-image" src="pic/005.jpg" alt=""></span>
        <span><img class="pic moving-image" src="pic/005.jpg" alt=""></span>

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