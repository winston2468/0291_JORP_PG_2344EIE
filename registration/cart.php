
<?php 
    include ( "../db/db_connect.php" );
    session_start();
    $product = $_POST['products'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_login']; 
    $status = "stocking";
    $cartId = null; 
    

    $output = array('error' => false, 'message'=>'1');
    try{
        $query01 = $mysqli->prepare("SELECT `cart`.`id` AS cart, `product`.`stock` AS stock FROM `product` LEFT JOIN `cart` ON `cart`.`product` = `product`.id LEFT JOIN `account` AS `buyerAccount` ON `buyerAccount`.id = `cart`.`buyer` LEFT JOIN `account` AS `sellerAccount` ON `sellerAccount`.id = `product`.`seller` WHERE `cart`.`buyer` = ? AND `cart`.id NOT IN (SELECT `cart` FROM `order_made`) AND `product`.`name` = ? ORDER BY `cart`.id DESC");
        $query01->bind_param('is', $user_id, $product);
        if ($query01->execute()){
            $result01 = $query01->get_result();
            $row01 = $result01->fetch_assoc();
            if ($row01 != NULL) {
                $cartId = $row01['cart'];
                if($row01['stock'] < $quantity){
                    $output['error'] = true;
                    $output['message'] = "Our Stock has only " . $row01["stock"] . " (units).";
                }
                else{
                    $query02 = $mysqli->prepare("INSERT INTO `order_made` (`cart`, `delivery`, `status`, `quantity`) VALUES (?, NOW(), ?, ?)");
                    $query02->bind_param('isi', $cartId, $status , $quantity);
                    if ($query02->execute()){
                        $output['message'] = 'Order successfully.';
                    }
                    else{
                        $output['error'] = true;
                        $output['message'] = 'Databased failed';
                    }
                }
            }
            else{
                $output['error'] = true;
                $output['message'] = 'Please select the product in the list.';
            }
        }
        else{
            $output['error'] = true;
            $output['message'] = 'Databased failed';
        }
    }
    catch(mysqli_sql_exception  $e){
        $output['error'] = true;
        $output['message'] = $e->getMessage();
    }
    echo json_encode($output);
?>
