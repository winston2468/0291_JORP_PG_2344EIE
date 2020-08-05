<!DOCTYPE html>
<meta charset="UTF-8">
<head>

<?php 
 include ( "../db/db_connect.php" );
 $table_name = 'product';
 $name = $_POST['name'];
 $price = $_POST['price'];
 $stock = $_POST['stock'];
 $description = $_POST['description'];
 $video_rent = $_POST['video_rent'];
 $seller_id = $_POST['seller_id'];
 $category_combobox = $_POST['category_combobox'];
?>
</head>




</head>


<body>


<?php
     
    	$output = array('error' => false, 'message' => 'error');


    	try{

          $productImageName = time() . '-' . $_FILES["productImage"]["name"];

          $target_dir = "../image/";
          $target_file = $target_dir . basename($productImageName);
    
          // size in bytes
          if($_FILES['productImage']['size'] > 20000000) {
       
            $output['error'] = true;
            $output['message']  = "Image size should not be greater than 20000Kb";
            
          }
       
          if(file_exists($target_file)) {
        
            $output['error'] = true;
            $output['message']  = "File already exists";
          }
         
          if ( $output['error'] == false) {
            
            if(move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
              $pre = "INSERT INTO product SET seller = ? ,name = ? , image = ? , price = ? ,  stock = ? ,  description = ? , video = ?, category = ? ";


              $stmt = $mysqli->prepare($pre);
              $stmt->bind_param('issdissi', $seller_id, $name, $productImageName , $price , $stock , $description, $video_rent, $category_combobox );
                  		//if-else statement in executing our prepared statement
    		if ($stmt->execute()){
          $output['message'] = 'product added successfully, refresh page to see changes';
          
    		}
    		else{
    			$output['error'] = true;
    			$output['message'] = 'Something went wrong. Cannot add product';
    		} 

            } else {
              $output['error'] = true;
              $output['message']  = "There was an error uploading the file";
            }
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

