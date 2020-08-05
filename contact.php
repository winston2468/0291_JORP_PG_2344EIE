<!DOCTYPE html>
<?php


if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

include_once("./db/db_connect.php");
include_once("./template.html");
include_once("./login_modal.php");
include_once("./registration_modal.php");
include_once("./logout_modal.php");
?>


<link rel="stylesheet" type="text/css" href="./4432_style.css">
<link rel="stylesheet" type="text/css" href="./dependencies/DataTables/datatables.min.css" />
<script type="text/javascript" src="./dependencies/DataTables/datatables.min.js"></script>



<head>
  <title>eCommerce Shop</title>

  <script>
    function myFunction(x) {
      x.classList.toggle("change");
    }
    function openNav() {
  document.getElementById("myNav").style.width = "25%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
  </script>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
  <script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
      scrollFunction()
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>
  <div class="banner">
    <div class="left">
    <div class="container">
        <span style="font-size:30px;cursor:pointer;  color: transparent;  
  text-shadow: 0 0 0 white;" onclick="openNav()">&#9776;</span>

      </div>
      <a href="./index.php">
        <img id="amayan" src="./image/amayan_newlogo.png" aria-label="polyu" height="50" weight="50" tabindex="1">
      </a>
      <div id="cartButton" style='display:inline'>
        <a href="./cart.php" aria-label="on the cart" class="right" id="nav-cart" tabindex="2">
          <span aria-hidden="true" class="fa fa-cart-plus" style="font-size:48px;color:#ffffff"></span>
          <span aria-hidden="true" class="nav-line-2">Cart</span>
        </a>
      </div>
      <div id="orderButton" style='display:inline'>
        <a href="./order.php" class="right" id="order" tabindex="3">Your Orders</a>
      </div>
    </div>
  </div>
  <div class="topnav">
    <a class="active" href="./index.php"><i class="fa fa-home"></i>Home</a>
    <a href="./about.php">About Us</a>
    <div id="managebox" style='display:inline'>
      <a href="./seller/list_product.php">Seller Shop Management</a>
    </div>
    <div id="adminbox" style='display:inline'>
      <a href="./admin/manage_database.php" class="admin_manage">Admin Management</a>
    </div>
    <div id="loginbox" style='display:inline'>
      <a class="active-login login" href="#"><i class="fa fa-lock"></i>Login</a>
    </div>
    <div id="logoutbox" style='display:none'>
      <a class="active-logout logout" href="#"><i class="fa fa-lock"></i>Logout</a>
    </div>
    <div id="registerbox" style='display:inline'>
      <a class="active-reg registration" href="#register"><i class="fa fa-user icon"></i>Register</a>
    </div>
    <?php
      if (!isset($_SESSION['category_sub'])) {
        $_SESSION['category_sub'] = "";
      }
      if (!isset($_SESSION['category_main'])) {
        $_SESSION['category_main'] = "";
      }
  if (!isset($_SESSION['user_login'])) {
    $_SESSION['user_login'] = "";
    $user_id = "";
    ?>
    <script>
      $('#adminbox').css('display', 'none');
      $('#managebox').css('display', 'none');
      $('#orderButton').css('display', 'none');
      $('#logoutbox').css('display', 'none');
      $('#cartButton').css('display', 'none');
      $('#registerbox').css('display', 'inline');
      $('#loginbox').css('display', 'inline');
    </script>

    <?php
    } else {
      $user_id = $_SESSION['user_login'];


      try {
        $stmt = $mysqli->prepare("SELECT * FROM account WHERE id=?");
        $stmt->bind_param('s', $user_id);



        if ($stmt->execute()) {

          $result = $stmt->get_result();
          $row = $result->fetch_assoc();
          if ($row != NULL) {
            $uname_fullname = $row['fullName'];
            echo "<div  style='display:inline'> <a href='#'>Welcome " . $uname_fullname . "!</a></div>";
            ?>
          <script>
            
            $('#loginbox').css('display', 'none');
            $('#registerbox').css('display', 'none');
            $('#orderButton').css('display', 'inline');
            $('#cartButton').css('display', 'inline');
            $('#logoutbox').css('display', 'inline');
          </script>
          <?php
                  if ($row['type'] == '1') {
                    ?>
            <script>
              $('#managebox').css('display', 'inline');
            </script>
  <?php
          }
        } else { }
      } else {
        echo "error";
      }
    } catch (mysqli_sql_exception  $e) {
      echo "error";
    }
  }
  ?>
  <?php
  if ($row['type'] == '1') {
    ?>
    <script>
      $('#managebox').css('display', 'inline');
    </script>
  <?php
  } else {
    ?>
    <script>
      $('#managebox').css('display', 'none');
    </script>
  <?php
  }
  if ($row['type'] == '0') {
    ?>
    <script>
      $('#adminbox').css('display', 'inline');
    </script>
  <?php
  } else {
    ?>
    <script>
      $('#adminbox').css('display', 'none');
    </script>
  <?php
  }
  ?>
</div><br><br><br><br><br>
<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
  <?php
    if($_SESSION['category_main'] == ""){
      try{
        $main = "main";
        $others = "Others";
        $categoryQuery01 = $mysqli->prepare("SELECT * FROM `category` WHERE otherinfo = ? AND `name` != ?");
        $categoryQuery01->bind_param('ss', $main, $others);
        if ($categoryQuery01->execute()) {
          $categoryResult01 = $categoryQuery01->get_result();
          $categoryRow01 = $categoryResult01->fetch_assoc();
          if ($categoryRow01 != NULL) {
            $categoryResult01->data_seek(0);
            while ($categoryRow01 = $categoryResult01->fetch_assoc()) {
              echo "<a href='#" . $categoryRow01["name"] . "' data-toggle='tooltip' class= 'category_main' id=" . $categoryRow01["id"] . ">" . $categoryRow01["name"] . "</a>";                     
          }
        }
        } 
        else {
          echo "error";
        }
      } 
      catch (mysqli_sql_exception  $e) {
        echo "error";
      }
      try{
        $main = "main";
        $others = "Others";
        $categoryQuery01 = $mysqli->prepare("SELECT * FROM `category` WHERE otherinfo = ? AND `name` = ?");
        $categoryQuery01->bind_param('ss', $main, $others);
        if ($categoryQuery01->execute()) {
          $categoryResult01 = $categoryQuery01->get_result();
          $categoryRow01 = $categoryResult01->fetch_assoc();
          if ($categoryRow01 != NULL) {
            $categoryResult01->data_seek(0);
            while ($categoryRow01 = $categoryResult01->fetch_assoc()) {
              echo "<a href='#" . $categoryRow01["name"] . "' data-toggle='tooltip' class= 'category_main' id=" . $categoryRow01["id"] . ">" . $categoryRow01["name"] . "</a>";                     
          }
        }
        } 
        else {
          echo "error";
        }
      } 
      catch (mysqli_sql_exception  $e) {
        echo "error";
      }
    }
    else{
          try{
            echo "<a href='#back' data-toggle='tooltip' class= 'category_sub' id= \"0\">Back To All Product</a>";     
            $others = "Others";
            $categoryQuery02 = $mysqli->prepare("SELECT * FROM `category` WHERE `parent` = ? AND `name` != ?");
            $categoryQuery02->bind_param('is', $_SESSION['category_main'], $others);
            if ($categoryQuery02->execute()) {
              $categoryResult02 = $categoryQuery02->get_result();
              $categoryRow02 = $categoryResult02->fetch_assoc();
              if ($categoryRow02 != NULL) {
                $categoryResult02->data_seek(0);                
                while ($categoryRow02 = $categoryResult02->fetch_assoc()) {
                  echo "<a href='#" . $categoryRow02["name"] . "' data-toggle='tooltip' class= 'category_sub' id=" . $categoryRow02["id"] . ">" . $categoryRow02["name"] . "</a>";                     
              }
            }
            } 
            else {
              echo "error";
            }
          } 
          catch (mysqli_sql_exception  $e) {
            echo "error";
          }
          try{
            $others = "Others";
            $categoryQuery02 = $mysqli->prepare("SELECT * FROM `category` WHERE `parent` = ? AND `name` = ?");
            $categoryQuery02->bind_param('is', $_SESSION['category_main'], $others);
            if ($categoryQuery02->execute()) {
              $categoryResult02 = $categoryQuery02->get_result();
              $categoryRow02 = $categoryResult02->fetch_assoc();
              if ($categoryRow02 != NULL) {
                $categoryResult02->data_seek(0);                   
                while ($categoryRow02 = $categoryResult02->fetch_assoc()) {
                  echo "<a href='#" . $categoryRow02["name"] . "' data-toggle='tooltip' class= 'category_sub' id=" . $categoryRow02["id"] . ">" . $categoryRow02["name"] . "</a>";                     
              }
            }
            } 
            else {
              echo "error";
            }
          } 
          catch (mysqli_sql_exception  $e) {
            echo "error";
          }
          if($_SESSION['category_sub'] == ""){
          ?>
          <script type="text/javascript">
              openNav();
          </script>
          <?php
          }
        }
  ?>
</div>
</div>       

<h1>Contact Us</h1>
  <div class="row_n">
  <img src="./image/polyU003.jpg" style="width:300px; float:left; margin:0 35px;">
  <p><br>
      Amayon Fake Ltd.<br>
      Address: Room CF503, Department of Electronic and Information Engineering, <br>
      Hong Kong Polytechnic University, Hung Hom, Hong Kong<br>
      Tel: +852 2766 6223<br>
      Fax: +852 2362 8439<br>
      E-mail: <a href='mailto:eie.enquiry@polyu.edu.hk'>eie.enquiry@polyu.edu.hk</a> <br>
      More infomation: <a href='http://www.eie.polyu.edu.hk/~nflaw/eie4432.htm'>click here</a> <br>
      </p>
  </div>
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

  });


      $('.category_main').click(function() {
      var id = $(this).attr('id');

      $.ajax({

        url: "./category/category.php",

        method: "POST",

        data: {
          id: id,
        },



        success: function(data) {
          var parseddata = JSON.parse(data);
          if (parseddata.error) {} else {
            location.assign("./index.php");
          }
        }



      });


    });

    $('.category_sub').click(function() {
      var id = $(this).attr('id');

      $.ajax({

        url: "./category/category_sub.php",

        method: "POST",

        data: {
          id: id,
        },



        success: function(data) {
          var parseddata = JSON.parse(data);
          if (parseddata.error) {} else {
            location.assign("./index.php");
          }
        }



      });


    });






</script>
</html>