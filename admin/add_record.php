<!DOCTYPE html>
<meta charset="UTF-8">
<head>

</head>


<?php 
 include ( "../db/db_connect.php" );
 $table_name = $_POST['table_name'];
 $fields = $_POST['fields'];
?>


</head>


<body>


<?php
     
    	$output = array('error' => false);
     

    	try{

            $sql = 'SHOW COLUMNS FROM '. $table_name;
$res = $mysqli->query($sql);


while($row = $res->fetch_assoc()){
    $columns[] = $row['Field'];
}

                  $pre = "INSERT INTO ". $table_name. " VALUES(";
                  foreach ( $columns as $column){
                    $pre .= "?,";
                  }
                  $pre = substr($pre, 0, -1);
                  $pre .= ")";
                  $q_count = substr_count($pre, '?'); 
                  $bind ="";
                for ($i =0; $i< $q_count ; $i++){
                    $bind .= 's';
                }

                   $stmt = $mysqli->prepare($pre);
                   $stmt->bind_param($bind, ...$fields);




    		//if-else statement in executing our prepared statement
    		if ($stmt->execute()){
    			$output['message'] = 'Record added successfully, refresh page to see changes';
    		}
    		else{
    			$output['error'] = true;
    			$output['message'] = 'Something went wrong. Cannot add record';
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