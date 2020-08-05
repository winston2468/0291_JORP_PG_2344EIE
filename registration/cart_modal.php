<!DOCTYPE html>
    <?php
        include("./db/db_connect.php");
    ?>



<head>
    <style type="text/css">
        .page-header h2 {
            margin-top: 0;
        }

        table tr td:last-child a {
            margin: 0 auto;
        }
    </style>
</head>
<body>
        
        <div class="modal fade" id="cart_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="basicModal">Cart</h4>
                    </center>
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="cart_form" action="">
    
                            <div class='row form-group'>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Product Name:</label>
                                </div>
                                <div class='col-auto'>
                                <input list="products" class='form-control' name="products" required>
                                <datalist id="products">
                                    <?php
                                        try {
                                            $user_id = $_SESSION['user_login'];
                                            $query = $mysqli->prepare("SELECT `product`.`name` AS product, `product`.`price` AS price, `product`.`stock` AS stock FROM `product` LEFT JOIN `cart` ON `cart`.`product` = `product`.id WHERE `cart`.`buyer` = ? AND `cart`.id NOT IN (SELECT `cart` FROM `order_made`) ORDER BY `cart`.id DESC");
                                            $query->bind_param('s', $user_id);
                                            $conn = mysqli_connect("localhost", "root", "","4432_db");

                                            if ($query->execute()) {
                                                $result = $query->get_result();
                                                $row = $result->fetch_assoc();
                                                if ($row != NULL) {
                                                    $result->data_seek(0);
                                                    while ($row=$result->fetch_assoc())  {
                                                        $product = $row["product"];
                                                        echo "<option value=\"" . $product . "\">";
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
                                    ?>    
                                </datalist>
                                </div>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Order Quantity:</label>
                                </div>
                                <div class='col-auto'>
                                    <input type='text' class='form-control' id="quantity" name='quantity' required>
                                </div>
                            </div>
    
    
                    </div>
                </div>
                <div class="modal-footer">
    
                    <button type="submit" class="btn btn-primary">Buy</button>
    
                    </form>
                </div>
                <div id="alert_3" class="alert alert-info text-center" style="display:none;">
                        <span id="alert_message_3"></span>
                </div>
            </div>
        </div>
    </div>




</body>



</html>
