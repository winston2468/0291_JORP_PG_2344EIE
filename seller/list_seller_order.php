<!DOCTYPE html>
<?php
include("../db/db_connect.php");
include("seller_template.html");
include_once("../logout_modal.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_login'])) {
    $_SESSION['user_login'] = "";
    $user_id = "";
    die("PLEASE LOGIN");
} else {
    $user_id = $_SESSION['user_login'];
}


?>

<link rel="stylesheet" type="text/css" href="../4432_style.css">
<link rel="stylesheet" type="text/css" href="../dependencies/DataTables/datatables.min.css" />
<script type="text/javascript" src="../dependencies/DataTables/datatables.min.js"></script>

<head>

    <title>Dashboard</title>

    
    <meta name="viewport" content="width=device-width, initial-scale=1" >
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
    function openNav() {
  document.getElementById("myNav").style.width = "25%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
  </script>
  <div class="banner">
    <div class="left">
      <a href="../index.php">
        <img id="amayan" src="../image/amayan_newlogo.png" aria-label="polyu" height="50" weight="50" tabindex="1">
      </a>
      <div id="cartButton" style='display:none'>
        <a href="../cart.php" aria-label="on the cart" class="right" id="nav-cart" tabindex="2">
          <span aria-hidden="true" class="fa fa-cart-plus" style="font-size:48px;color:#ffffff"></span>
          <span aria-hidden="true" class="nav-line-2">Cart</span>
        </a>
      </div>
      <div id="orderButton" style='display:none'>
        <a href="../order.php" class="right" id="order" tabindex="3">Order</a>
      </div>
    </div>
  </div>
 
  <div class="topnav">
    <a class="active" href="./index.php"><i class="fa fa-home"></i>Home</a>
    <a href="../about.php">About</a>
    <a href="../contact.php">Contact</a>
    <div id="managebox" style='display:none'>
      <a href="./list_product.php">Product Management</a>
    </div>
    <div id="managebox1" style='display:none'>
      <a href="./list_seller_order.php">Order Management</a>
    </div>
    <div id="adminbox" style='display:none'>
      <a href="../admin/manage_database.php" class="admin_manage">Admin Management</a>
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

        $_SESSION['category_sub'] = "";


        $_SESSION['category_main'] = "";
      

        $_SESSION['currency_select'] = 'HKD';
      
  if (!isset($_SESSION['user_login'])) {
    $user_id = "";
    ?>
    <script>
      $('#adminbox').css('display', 'none');
      $('#managebox').css('display', 'none');
      $('#managebox1').css('display', 'none');
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
              $('#managebox1').css('display', 'inline');
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
      $('#managebox1').css('display', 'inline');
    </script>
  <?php
  } else {
    ?>
    <script>
      $('#managebox').css('display', 'none');
      $('#managebox1').css('display', 'none');
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
          <input type="submit" name="submit" value="Change Currency" />
        </form>
      </form>
    </div>
    </div>
    
  </div><br><br><br><br><br>

  <div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
  <?php
    if($_SESSION['category_main'] == 0|| $_SESSION['category_main'] ==""){
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
            echo "<a href='#back' data-toggle='tooltip' class= 'category_sub' id= \"0\">Back To All Orders</a>";     
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


<div class="container-fluid">

<div class="row">
    <div class="col-md-12">
        <div class="page-header clearfix">
            <h2 class="pull-left">Here are your current orders:</h2>
            <div id="alert" class="alert alert-info text-center" style="display:none;">
<span id="alert_message"></span>
<button class="close"><span aria-hidden="true">&times;</span></button>
</div>
        </div>
        <?php

          $sql = "SELECT order_made.id as 'Order ID', order_made.order_time as 'Order Time', product.name as 'Product Name', order_made.quantity as 'Quantity', product.price as 'Total Price', order_made.status as 'Status', account.username as 'Buyer' FROM order_made inner join cart on order_made.cart = cart.id inner join product on cart.product = product.id inner join account on account.id = cart.buyer WHERE product.seller = '" . $user_id . "';";

        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {

                echo "<table id='seller_order_table' name='order_made' class='table table-bordered table-striped'>";
                echo "<thead>";
                echo "<tr>";
                $fields = $result->fetch_fields();
                $field = array();
                $f = 0;
                foreach ($fields as $fields) {  //show first 4 fields
                    echo "<th>" . $fields->name . "</th>";
                    array_push($field, $fields->name);
                    $f += 1;
                    if ($f > 7) {
                        break;
                    }
                }

                echo "<th>Actions</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = $result->fetch_array(MYSQLI_BOTH)) {
                    echo "<tr>";
                    for ($i = 0; $i < $f; $i++) {  //show first 5 fields
                        if ($field[$i] == 'Quantity'){
                          $quantity_p = $row[$field[$i]];
                          echo "<td>" . $row[$field[$i]] . "</td>";
                      }
                        else if ($field[$i] == 'Total Price'){
                            $calculated = $quantity_p*$row[$field[$i]] * $currency_obj['rates'][$_SESSION['currency_select']];
                            echo  "<td>".$_SESSION['currency_select']." $". round($calculated, 2) ."</td>";
                        }
                        
                        else {
                            echo "<td>" . $row[$field[$i]] . "</td>";
                        }
                    }
                    echo "<td>";
                    echo "<p class='field_action'>";
                    //echo "<input type='button' title='View order' data-toggle='tooltip' class= 'view_seller_order_data' id=". $row[0] .">   ";
                    echo "<a href='#' title='View order' data-toggle='tooltip' class= 'update_seller_order_data' id=" . $row[0] . "><i class='fas fa-eye'></i></a>   ";
                    echo "</p>";
                    echo "</td>";

                    echo "</tr>";
                }


                echo "</tbody>";
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            } else {
                echo "<p class='lead'><em>No orders were found.</em></p>";
            }
        } else {
            echo "ERROR";
        }

        // Close connection
        ?>

    </div>
</div>
</div>
</body>



<script type="text/javascript">
$(document).ready(function() {
$('#seller_order_table').DataTable({});
$('[data-toggle="tooltip"]').tooltip();




$("#seller_order_table").on("click",".update_seller_order_data",function() {
var id = $(this).attr('id');
var table_name = $('#seller_order_table').attr('name');

$.ajax({

url: "update_order_info.php",

method: "POST",

data: {
id: id,
table_name: table_name
},

success: function(data) {

$('#update_form_info').html(data);
// Display the Bootstrap modal
$('#update_order_modal').modal('show');
}
});
});




$('#update_form').submit(function(e) {
e.preventDefault();


$.ajax({

url: "update_order.php",

method: "POST",

data: new FormData(this),

cache: false,
contentType: false,
processData: false,

success: function(data) {
$('#update_order_modal').modal('hide');
location.reload();
if (data.error) {
    $('#alert').show();
    $('#alert_message').html(data);
    location.reload();
} else {
    $('#alert').show();
    $('#alert_message').html(data);
    location.reload();
    //fetch();
}
}



});


});




});

$('#rtd').click(function() {
header("Location: index.php");
});



$('.category_main').click(function() {
      var id = $(this).attr('id');

      $.ajax({

        url: "../category/category.php",

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

        url: "../category/category_sub.php",

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












</script>



</html>


<!-- update modal -->

<div class="modal fade" id="update_order_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
<div class="modal-dialog  modal-lg">
<div class="modal-content">
    <div class="modal-header">
        <center>
            <h4 class="modal-title" id="basicModal">View order</h4>
        </center>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <form id="update_form" action="update_order.php" method="GET">
                <div id="update_form_info">
                </div>

        </div>
    </div>
    <div class="modal-footer">

        <button type="submit" class="btn btn-primary">Confirm actions</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

        </form>
    </div>
</div>
</div>
</div>
