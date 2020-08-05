<!DOCTYPE html>
<meta charset="UTF-8">
<head>

</head>


<?php 
 include ( "../db/db_connect.php" );
 $table_name = 'order_made';
 $selected_action = $_POST['selected_action'];
 $id = $_POST['id'];

?>


</head>


<body>


<?php
    	$output = array('error' => false);
     

    	try{
        if($selected_action =='deliver'){
          $status = 'Delivered';

        }
        else{
          $status = 'Canceled and Refunded';
        }
                 
                  $pre = "UPDATE ". $table_name. " SET status = ? WHERE id = ?";
                   $stmt = $mysqli->prepare($pre);
                   $stmt->bind_param('si', $status,$id);




    		//if-else statement in executing our prepared statement
    		if ($stmt->execute()){
    			$output['message'] = 'Record updated successfully, refresh page to see changes';
    		}
    		else{
    			$output['error'] = true;
    			$output['message'] = 'Something went wrong. Cannot update record';
    		} 
     
    	}
    	catch(mysqli_sql_exception  $e){
    		$output['error'] = true;
     		$output['message'] = $e->getMessage();
    	}
     
     
    	echo json_encode($output['message']);
     
    ?>


</body>

</html>