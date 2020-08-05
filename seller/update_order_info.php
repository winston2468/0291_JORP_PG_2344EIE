<!DOCTYPE html>
<meta charset="UTF-8">
<head>
<?php 
 include ( "../db/db_connect.php" );
 $table_name = $_POST['table_name'];
 $id = $_POST['id'];
?>
</head>

					<?php
				$sql = "SELECT order_made.id as 'Order ID',
				        order_made.order_time as 'Order Time',
			            product.name as 'Product Name',
						order_made.quantity as 'Quantity',
				  		product.price as 'Total Price',
						order_made.status as 'Status',
					    account.username as 'Buyer',
					    account.fullname as 'Full Name',
					    account.email as 'Email Address',
					    account.phone as 'Phone Number',
						account.address as 'Delivery Address'
						FROM order_made 
						inner join cart on order_made.cart = cart.id
						inner join product on cart.product = product.id
						inner join account on account.id = cart.buyer
						WHERE order_made.id = ?;";

                   $stmt = $mysqli->prepare($sql);
                   $stmt->bind_param("s", $id);


                    if($stmt->execute()){
                        $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            if($row != NULL){
                            foreach ($row as $column => $value) {

               
                                    echo  $column . ":<br>";
                                    echo "<input disabled value='" . $value . "'>";
                                    echo "<p></p>";
                                
                            }
                            echo "<input type='hidden'  name='table_name' value ='" .$table_name . "'/>";
							echo "<input type='hidden'  name='id' value ='" .$id . "'/>";
							echo "<select class='form-control' name='selected_action'>";
							echo "<option value='deliver'>Confirm payment recieved and deliver product</option>";
							echo "<option value='cancel_order'>Cancel Order</option>";
							echo "</input>";
                        }
                        else{

                            echo "Invalid ID.";
                        }
                            // Free result set
                            mysqli_free_result($result);
                        
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    $stmt->close();
                    ?>
</body>

</html>