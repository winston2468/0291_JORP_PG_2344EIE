
<?php 
    include ( "../db/db_connect.php" );
    session_start();
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_login']; 
    $status = "New";
    

    $output = array('error' => false, 'message'=>'1');
    try{
        foreach($_POST['selectedProduct'] as $index =>  $checkboxId){
            $query01 = $mysqli->prepare("SELECT `cart`.`id` AS cart, `product`.`id` AS productId, `product`.`name` AS products, `product`.`stock` AS stock FROM `product` LEFT JOIN `cart` ON `cart`.`product` = `product`.id LEFT JOIN `account` AS `buyerAccount` ON `buyerAccount`.id = `cart`.`buyer` LEFT JOIN `account` AS `sellerAccount` ON `sellerAccount`.id = `product`.`seller` WHERE `cart`.`buyer` = ? AND `cart`.`id` = ? ORDER BY `cart`.id DESC");
            $query01->bind_param('ii', $user_id, $cartId[$checkboxId]);
            if ($query01->execute()){
                $result01 = $query01->get_result();
                $row01 = $result01->fetch_assoc();
                if ($row01 != NULL) {
                    if($quantity[$checkboxId] != ""){
                    if($row01['stock'] < $quantity[$checkboxId]){
                        $output['error'] = true;
                        $output['message'] = "Our Stock has only " . $row01["stock"] . " (units) for " . $row01["products"] . ".";
                    }
                    else{
                        $query02 = $mysqli->prepare("INSERT INTO `order_made` (`cart`, `order_time`, `status`, `quantity`) VALUES (?, NOW(), ?, ?)");
                        $query02->bind_param('isi', $cartId[$checkboxId], $status, $quantity[$checkboxId]);
                        if ($query02->execute()){
                            $temp = $row01["stock"] - $quantity[$checkboxId];
                            $query03 = $mysqli->prepare("UPDATE `product` SET `product`.`stock` = ? WHERE `product`.`id` = ?");
                            $query03->bind_param('is', $temp, $row01["productId"]);
                            if ($query03->execute()){
                            }
                            else{
                                $output['error'] = true;
                                $output['message'] = 'Databased failed';
                            }
                        }
                        else{
                            $output['error'] = true;
                            $output['message'] = 'Databased failed';
                        }
                    }
                }
                else{
                    $output['error'] = true;
					$output['message'] = 'Some quantities are null';
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
    }
    catch(mysqli_sql_exception  $e){
        $output['error'] = true;
        $output['message'] = $e->getMessage();
    }
    echo json_encode($output);
?>
