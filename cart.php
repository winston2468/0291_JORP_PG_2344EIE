<!DOCTYPE html>
<?php


if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

    include_once("./db/db_connect.php");
    include_once("./template.html"); 
    include_once("./logout_modal.php");
    include_once("./cart_modal.php");
    if (!isset($_SESSION['user_login'])) {
      $user_id = "";
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . '/4432_project/index.php');
  } else {
      $user_id = $_SESSION['user_login'];
  }
?>
<link rel="stylesheet" type="text/css" href="./dependencies/DataTables/datatables.min.css" />
<script type="text/javascript" src="./dependencies/DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="./4432_style.css">



<head>
  <title>Cart</title>

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
 
  <meta name="viewport" content="width=device-width, initial-scale=1" >
</head>

<body>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<script>      
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

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
    <a href="./about.php">About</a>
    <a href="./contact.php">Contact</a>
    <div id="managebox" style='display:inline'>
      <a href="./seller/list_product.php">Seller Shop Management</a>
    </div>
    <div id="adminbox" style='display:inline'>
      <a href="./admin/manage_database.php">Admin Management</a>
    </div>
    <div id="loginbox" style='display:inline'>
      <a class="active-login login" href="#"><i class="fa fa-lock"></i>Login</a>
    </div>
    <div id="logoutbox" style='display:inline'>
      <a class="active-logout logout" href="#"><i class="fa fa-lock"></i>Logout</a>
    </div>
    <div id="registerbox" style='display:inline'>
      <a class="active-reg registration" href="#register"><i class="fa fa-user icon"></i>Register</a>
    </div>
    <?php

      $_SESSION['category_sub'] = "";

      $_SESSION['category_main'] = "";
    

      $_SESSION['currency_select'] = 'HKD';
    
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
      $('#registerbox').css('display', 'none');
      $('#loginbox').css('display', 'none');
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
            $('#cartButton').css('display', 'none');
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
<div class="search-container">
    <div class="currency_form"style='display:inline'>
    <form id="currency_dropdown" action="" method="post">
          <?php

          if (isset($_POST['currency_select'])) {
            $_SESSION['currency_select'] = $_POST['currency_select'];
            try {
              $setCurrency = $mysqli->prepare("UPDATE `account` SET `currency` = ? WHERE id=?");
              $setCurrency->bind_param('si', $_SESSION['currency_select'], $user_id);
              
      
      
              if ($setCurrency->execute()) {
              } else {
                echo "error";
              }
            } catch (mysqli_sql_exception  $e) {
              echo "error";
            }
          }
          else{
            if ($user_id != "") {
              $_SESSION['currency_select'] = $row['currency'];
            }
          }

          
          $currency_name = array();
          array_push($currency_name,'HKD', 'CAD','USD','JPY','AUD','EUR','CNY','RUB','SGD','IDR');
          echo "<select name='currency_select' >";
          foreach($currency_name as $currency_name){
            if($currency_name == $_SESSION['currency_select']){
          echo "<option selected value='". $currency_name. "'>".$currency_name."</option>";
        }
        else{
          echo "<option value='". $currency_name. "'>".$currency_name."</option>";

        }
          }
          echo "</select>";
          $currency_json = file_get_contents('https://api.exchangeratesapi.io/latest?base=HKD');
          $currency_obj = json_decode($currency_json, true);
  
          ?>
          <input type="submit" name="submit" value="Edit Currency" />
      </form>
    </div>
    </div>
  </div><br><br><br><br><br>

  <div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
  <?php
    if($_SESSION['category_main'] == "" || $_SESSION['category_main'] == 0){
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
<div id="alert_Buy" class="alert alert-info text-center" style="display:none;">
                        <span id="alert_message_Buy"></span>
                </div>
<div class="container-fluid">
  <?php
      $number = 1;      
                    try {
                        $cartQuery = $mysqli->prepare("SELECT `product`.`id` AS productIdInCart, `cart`.`id` AS cartId FROM `product` LEFT JOIN `cart` ON `cart`.`product` = `product`.id LEFT JOIN `account` ON `account`.id = `product`.`seller` WHERE `cart`.`buyer` =? AND `cart`.id NOT IN (SELECT `cart` FROM `order_made`) ORDER BY `cart`.id DESC");
                        $cartQuery->bind_param('s', $user_id);
                        if ($cartQuery->execute()) {
                            $cartResult = $cartQuery->get_result();
                            $cartRow = $cartResult->fetch_assoc();
                            if ($cartRow != NULL) {
                              
                                $cartResult->data_seek(0);
                                echo "<form id=\"cart\" action=\"\">";
                                echo "<table id='search_table' name='product' class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Number</th>";
                                echo "<th>Seller</th>";
                                echo "<th>Product Name</th>";
                                echo "<th>Product Image</th>";
                             
                                echo "<th>Price</th>";
                                echo "<th>Description</th>";
                                echo "<th>Stock</th>";
                                echo "<th>Quatity</th>";
                                echo "<th>Buy?</th>";
                                echo "<th>Delete</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
               
                                while ($cartRow=$cartResult->fetch_assoc())  {
                                  ?>
      <div class="row">
        <div class="col-md-12">
          <?php


            $sql = "SELECT account.fullname, product.name,    product.image, product.price,  product.description, product.stock, product.id as 'productId'  FROM product INNER JOIN account on account.id = product.seller WHERE `product`.`id` =".  $cartRow["productIdInCart"] . ";";
          
         $product_ids = array();
          if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {

                          
              
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo  "<td>" . $number . "</td>";
                foreach ($row as $column => $value) {
                  if ($column == 'name') {
                    echo  "<td>$value</td>";
                  }  else  if ($column == 'image') {
                    echo  "<td><div class='form-group'>
                              ";
                    echo "  <div class='form-group' style='position: relative;' >
                              <span class='img-div'>
                           
                                <img src='./image/" . $value . "'  class ='img-thumbnail'  id='productDisplay' >
                              </span>

                           </div></td>";
                  }
                  else   if ($column == 'price') {
                    $calculated = $value * $currency_obj['rates'][$_SESSION['currency_select']];
                    echo  "<td>".$_SESSION['currency_select']." $". round($calculated, 2) ."</td>";
                  }
                   else   if ($column == 'description') {
                    echo  "<td>$value</td>";
                  } else   if ($column == 'stock') {
                    echo  "<td>$value</td>";
                  }else   if ($column == 'fullname') {
                    echo  "<td>$value</td>";
                  }

                else if($column=='productId'){
                  $number -= 1;
                  echo "<input type='text' name=\"cartId[]\" value = \"" . $cartRow["cartId"] . "\" hidden>";
                  echo "<td><input type='text' name=\"quantity[]\"></td>";
                  echo "<td><input type = \"checkbox\" class = \"selectedProduct\" name=\"selectedProduct[]\" value=\"$number\"></td>";
                  echo "<td><a href='#' title='Delete Record' data-toggle='tooltip' class= 'delete_data' id=" . $cartRow["cartId"] . "><i class='fas fa-trash-alt'></i></a></td>";
                  $number += 1; 
                                               
                }
              }

              $number += 1; 
                echo "</tr>";
              }


              
          
              // Free result set
              mysqli_free_result($result);
              $_SESSION['product_ids'] =$product_ids;
            } else {
              echo"<h1><p><b>Oh NO! You have no item in your cart, Would you like to <a href = \"./index.php\">see the products</a>?</b></p</h1>";
            }
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }

          // Close connection
          ?>

        
      <?php
                                }
                                echo "</tbody>";
                            echo "</table>";
                            echo "<button hidden type=\"submit\" id='buy_hidden'>Buy</button>";
                          echo "<input type='button' value='Buy' class=\"buy-action\">";
                            echo "</form>";
                            }
                            else{
                              echo"<h1><p><b>Oh NO! You have no item in your cart, Would you like to <a href = \"./index.php\">see the products</a>?</b></p</h1>";
                            }
                         } 
                        else {
                            echo "error";
                        }
                    } 
                    catch (mysqli_sql_exception  $e) {
                        echo "error";
                    }
                    ?>
                    </div>
      </div>
    </div>
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#search_table').DataTable({});
    $('[data-toggle="tooltip"]').tooltip();
    $("#search_table").on("click",".delete_data",function() {
var id = $(this).attr('id');

$.ajax({

    url: "./cart/delete_alert.php",

    method: "POST",

    data: {
        id: id,
    },

    success: function(data) {

        $('#delete_form_info').html(data);
        // Display the Bootstrap modal
        $('#delete_record_modal').modal('show');
    }
});
});
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
            location.reload();
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
            location.reload();
          }
        }



      });


    });

    $('.buy-action').click(function () {


$.ajax({

    url: "./pay.php",

    method: "POST",

    data: {

    },

    success: function(data) {

        $('#pay_form_info').html(data);
        // Display the Bootstrap modal
        $('#pay_modal').modal('show');
    }
});

    });
       






        $(function(){
$('#delete_form').submit(function(e){
e.preventDefault();
var data = $(this).serialize();

$.ajax({

    url: "./cart/delete.php",

    method: "POST",

    data: data,


    success: function(data){
    $('#delete_record_modal').modal('hide');
    if(data.error){
        $('#alert_buy').show();
        $('#alert_message_buy').html(data);
    }
    else{
        $('#alert_buy').show();
        $('#alert_message_buy').html(data);
    }
    location.reload();
}



});


});

});



</script>
</html>

<div class="modal fade" id="delete_record_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <center><h4 class="modal-title" id="basicModal">Confirm Delete Cart Record</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form id="delete_form" action="" method="">
            <div id="delete_form_info">
            </div>
				
            </div> 
			</div>
            <div class="modal-footer">

            <button type="submit" class="btn btn-danger" >Delete</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                
			</form>
            </div>
            </div>
        </div>
    </div>


    <!-- pay modal -->



<div class="modal fade" id="pay_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <center><h4 class="modal-title" id="basicModal">Pay with Credit Card</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
            <div id="pay_form_info">
            </div>


            </div>
        </div>
    </div>
    </div>
    </div>
