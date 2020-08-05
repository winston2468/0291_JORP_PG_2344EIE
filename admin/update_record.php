<!DOCTYPE html>
<meta charset="UTF-8">
<head>

</head>


<?php 
 include ( "../db/db_connect.php" );
 $table_name = $_POST['table_name'];
 $id = $_POST['id'];
 $fields = $_POST['fields'];
?>


</head>


<body>


<?php
     array_push($fields ,$id);
    	$output = array('error' => false);
     

    	try{

            $sql = 'SHOW COLUMNS FROM '. $table_name;
$res = $mysqli->query($sql);


while($row = $res->fetch_assoc()){
    $columns[] = $row['Field'];
}

                  $pre = "UPDATE ". $table_name. " SET ";
                  foreach ( $columns as $column){
                    if($column!="id"){

                    
                    $pre .= $column . "= ?,";
                    }
                  }
                  $pre = substr($pre, 0, -1);
                  $pre .= " WHERE id = ?";
                  $q_count = substr_count($pre, '?'); 
                  $bind ="";
                for ($i =0; $i< $q_count ; $i++){
                    $bind .= 's';
                }
                   $stmt = $mysqli->prepare($pre);
                   $stmt->bind_param($bind, ...$fields);




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