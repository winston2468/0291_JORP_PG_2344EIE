<?php 
 session_start();
 include ( "../db/db_connect.php" );
 $user_id = $_SESSION['user_login'];
 $product_id = $_POST['id'];
 $output = array('error' => false, 'message'=>'1');
 $check = $mysqli->prepare("SELECT `cart`.`id` FROM `cart` WHERE `buyer` = ? AND `product` = ? AND `cart`.`id` NOT IN (SELECT `order_made`.`cart` FROM `order_made`)");
 $check->bind_param("ii", $user_id, $product_id);
 if ($check->execute()){
    $result = $check->get_result();
    $row = $result->fetch_assoc();
    if ($row != NULL) {
        $output['error'] = true;
            $output['message'] = 'You have already added this product to the cart.';
    }
    else{
        $stmt = $mysqli->prepare("INSERT INTO `cart` (`buyer`, `product`) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $product_id);
        if($stmt->execute()){
            $output['message'] = 'Success'; 
        } 
        else{
            $output['error'] = true;
            $output['message'] = 'Error';
        }
    } 
}
else{
    $output['error'] = true;
    $output['message'] = 'Error';
}
echo json_encode($output);
?>