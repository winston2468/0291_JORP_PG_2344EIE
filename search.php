<!DOCTYPE html>
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include("./db/db_connect.php");


include_once("./template.html");
include_once("./login_modal.php");
include_once("./logout_modal.php");
include_once("./registration_modal.php");


if (!isset($_SESSION['user_login'])) {
  $user_id = "";


} else {
  $user_id = $_SESSION['user_login'];
}

$search = $_GET['search'];

echo "<input hidden  id='user_id' name='" . $user_id . "'/>";
?>

<link rel="stylesheet" type="text/css" href="./dependencies/DataTables/datatables.min.css" />
<script type="text/javascript" src="./dependencies/DataTables/datatables.min.js"></script>

<head>

  <title>Dashboard</title>

  <style type="text/css">
    .page-header h2 {
      margin-top: 0;
    }

    table tr td:last-child a {
      margin: 0 auto;
    }

    .field_action {
      white-space: nowrap;
    }

    .fa-eye {
      color: #536DFE;
    }

    .fa-eye:hover {
      color: #00BFFF;
      /* font-size:2em;
  transition: 0.1s ease-out;*/

    }

    .fa-edit {
      color: #DAA520;
    }

    .fa-edit:hover {
      color: #00BFFF;
      /* font-size:2em;
  transition: 0.1s ease-out;*/

    }

    .fa-trash-alt {
      color: red;
    }

    .fa-trash-alt:hover {
      color: #00BFFF;
      /* font-size:2em;
  transition: 0.1s ease-out;*/
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    .banner {
      background-color: rgb(19, 25, 33);
      padding: 1px 10px;
      position: fixed;
      width: 100%;
      margin: 0 auto;
      height: 60px;
      top: 0%;
    }

    span.welcome {
      background-color: #ffffff;
      display: inline-block;
      text-align: center;
      font-family: Georgia, 'Times New Roman', Times, serif;
      font-style: italic;
      font-size: 30px;
      height: 60px;
      width: 70%;
      padding: 0px 240px;
      margin: 0 auto;
    }

    .right {
      float: right;
      padding: 1px 10px;
    }

    #order.right {
      margin-top: 30px;
    }

    a.right:link {
      text-decoration: none;
      color: #ffffff;
    }

    a.right:visited {
      text-decoration: none;
      color: #ffffff;
    }

    a.right:hover {
      text-decoration: none;
      color: #ffffff;
    }

    a.right:active {
      text-decoration: none;
      color: #ffffff;
    }

    .container {
      display: inline-block;
      cursor: pointer;
      border: 1px solid #ABB2B9;
      margin: 5px 2px;
      padding: 2px 5px;
      border-radius: 5px;
    }

    .bar1,
    .bar2,
    .bar3 {
      width: 25px;
      height: 3px;
      background-color: #ffffff;
      margin: 5px 1px;
      transition: 0.2s;
    }

    .change .bar1 {
      -webkit-transform: rotate(-45deg) translate(-6px, 6px);
      transform: rotate(-45deg) translate(-6px, 6px);
    }

    .change .bar2 {
      opacity: 0;
    }

    .change .bar3 {
      -webkit-transform: rotate(45deg) translate(-6px, -6px);
      transform: rotate(45deg) translate(-6px, -6px);
    }

    .underline {
      border-bottom: 1px solid #D0D3D4;
    }

    .topnav {
      overflow: hidden;
      background-color: #e9e9e9;
      margin: 0px 0px 1px 0px;
      position: fixed;
      width: 100%;
      height: 60px;
      top: 60px;
    }

    .topnav a {
      float: left;
      display: block;
      color: black;
      text-align: center;
      padding: 10px 10px;
      text-decoration: none;
      font-size: 17px;
    }

    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }

    .topnav a.active {
      background-color: #2196F3;
      color: white;
    }

    .topnav .search-container {
      float: right;
    }

    .topnav input[type=text] {
      padding: 6px;
      margin-top: 8px;
      font-size: 17px;
      border: none;
    }

    .topnav .search-container button {
      float: right;
      padding: 6px 10px;
      margin-top: 8px;
      margin-right: 16px;
      background: #ddd;
      font-size: 17px;
      border: none;
      cursor: pointer;
    }

    .topnav .search-container button:hover {
      background: #ccc;
    }

    @media screen and (max-width: 600px) {
      .topnav .search-container {
        float: none;
      }

      .topnav a,
      .topnav input[type=text],
      .topnav .search-container button {
        float: none;
        display: block;
        text-align: left;
        width: 100%;
        margin: 0;
        padding: 14px;
      }

      .topnav input[type=text] {
        border: 1px solid #ccc;
      }
    }

    div.img-container_n {
      margin: 50px;
    }

    div.row_n {
      padding: 0 100px 0 100px;
      margin: 0 10px 0 10px;
    }

    div.col-sm_n {
      border: 2px solid #ddd;
      border-radius: 4px;
      padding: 0 80px 0 80px;
      display: inline-block;
      text-align: center;
    }

    div.picture_n {
      margin: 20px 10px;
    }

    p {
      display: block;
      margin: 20px;
    }

    #myBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      font-size: 18px;
      font-weight: bold;
      outline: none;
      cursor: pointer;
      padding: 15px;
      background-color: rgb(96, 208, 105);
      color: rgb(255, 255, 255);
      margin: 8px 0;
      opacity: 0.9;
      -moz-box-shadow: inset 0px 1px 3px 0px #c4ffc6;
      -webkit-box-shadow: inset 0px 1px 3px 0px #c4ffc6;
      box-shadow: inset 0px 1px 3px 0px #c4ffc6;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      border-radius: 7px;
      border: 1px solid #695656;

    }

    #myBtn:hover {
      background-color: #555;
    }
  </style>
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
      <a href="./index.php">
        <img id="amayan" src="./image/amayan_newlogo.png" aria-label="polyu" height="50" weight="50" tabindex="1">
      </a>
      <span class="welcome">Welcome to Amayon!</span>
      <div id="cartButton" style='display:inline'>
        <a href="./cart.php" aria-label="on the cart" class="right" id="nav-cart" tabindex="2">
          <span aria-hidden="true" class="fa fa-cart-plus" style="font-size:48px;color:#ffffff"></span>
          <span aria-hidden="true" class="nav-line-2">Cart</span>
        </a>
      </div>
      <a href="./order.php" class="right" id="order" tabindex="3">Order</a>
    </div>
  </div>
  <div class="topnav">
    <a class="active" href="./index.php"><i class="fa fa-home"></i>Home</a>
    <a href="./about.php">About</a>
    <a href="./contact.php">Contact</a>
    <div id="loginbox" style='display:inline'>
      <a class="active-login login" href="#"><i class="fa fa-lock"></i>Login</a>
    </div>
    <div id="logoutbox" style='display:none'>
      <a class="active-logout logout" href="#"><i class="fa fa-lock"></i>Logout</a>
    </div>


    <?php

    try {
      $stmt = $mysqli->prepare("SELECT * FROM account WHERE id=?");
      $stmt->bind_param('s', $user_id);
      if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row != NULL) {
          $uname_fullname = $row["fullName"];
          echo "<div  style='display:inline'> <a href='#'>Welcome " . $uname_fullname . "!</a></div>";
          echo "$('#logoutbox').css('display', 'inline')";
          echo " $('#loginbox').css('display', 'none')";
        }
      } else {
        echo "error";
      }
    } catch (mysqli_sql_exception  $e) {
      echo "error";
    }
    ?>

    <div class="search-container">
      <div class="currency_form" style='display:inline'>
        <form id="currency_dropdown" action="" method="post">
          <?php

          if (isset($_POST['currency_select'])) {
            $_SESSION['currency_select'] = $_POST['currency_select'];

          }


          $currency_name = array();
          array_push($currency_name,'HKD','CAD','USD','JPY','AUD','EUR','CNY','RUB','SGD');
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


    <div id="alert" class="alert alert-info text-center" style="display:none;">
      <span id="alert_message"></span>
      <button class="close"><span aria-hidden="true">&times;</span></button>

    </div>


    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div class="page-header clearfix">
            <h2 class="pull-left">Here are your search results:</h2>
          </div>
          <?php
          $sql = "SELECT account.fullname, product.name,    product.stock, product.image, product.price,  product.description, product.id as 'productId'  FROM product INNER JOIN account on account.id = product.seller;";

         $product_ids = array();
          if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) {

              echo "<table id='search_table' name='product' class='table table-bordered table-striped'>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>Seller</th>";
              echo "<th>Product Name</th>";
              echo "<th>Product Image</th>";
           
              echo "<th>Description</th>";
              echo "<th>Price</th>";

              echo "<th>Action</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              echo "<tr>";
              while ($row = $result->fetch_assoc()) {

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

                    echo  "<td>".$_SESSION['currency_select']." $". round($value*$currency_obj['rates'][$_SESSION['currency_select']], 2) ."</td>";
                  }
                   else   if ($column == 'description') {
                    echo  "<td>$value</td>";
                  } else   if ($column == 'fullname') {
                    echo  "<td>$value</td>";
                  }
               

                else if($column=='productId'){
                if ($user_id == "") {
                  echo "<td><a class='active-login login' href='#'>Login to add to cart</a></td>";
                } else {
                  echo "<td><a href='#addTocart' title='Add to cart' data-toggle='tooltip' class= 'addTocart' id=" . $value . ">Add To Cart</a></td>";
                  array_push(  $product_ids, $value);
                                               
                }
              }
 }
                echo "</tr>";
              }


              echo "</tbody>";
              echo "</table>";
          
              // Free result set
              mysqli_free_result($result);
              $_SESSION['product_ids'] =$product_ids;
            } else {
              echo "<p class='lead'><em>No products were found.</em></p>";
            }
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }

          // Close connection
          ?>

        </div>
      </div>
    </div>
</body>



<script type="text/javascript">
  $(document).ready(function() {
    $('#search_table').DataTable({});
    $('[data-toggle="tooltip"]').tooltip();


  });

  $('.addTocart').click(function() {
      var id = $(this).attr('id');
      var user_id = $('#user_id').attr('name');

      $.ajax({

        url: "./cart/addToCart.php",

        method: "POST",

        data: {
          id: id,
          user_id: user_id
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