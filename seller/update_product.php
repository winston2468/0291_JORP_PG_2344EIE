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
 $video = $_POST['video'];
 $id = $_POST['id'];
 $image_old= $_POST['image_old'];
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

            if($_FILES["productImage"]["name"] !='')
            {
              $target_image_old = $target_dir .  $image_old;
            if(move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
              unlink($target_image_old);
              $pre = "UPDATE product SET name = ? , image = ? , price = ? ,  stock = ? ,  description = ? , video = ?, category = ? WHERE id = ?";


              $stmt = $mysqli->prepare($pre);
              $stmt->bind_param('ssdissii',  $name, $productImageName , $price , $stock , $description, $video_rent, $category_combobox,$id );
                  		//if-else statement in executing our prepared statement
    		if ($stmt->execute()){
          $output['message'] = 'product updated successfully, refresh page to see changes';
          
    		}
    		else{
    			$output['error'] = true;
    			$output['message'] = 'Something went wrong. Cannot update product';
    		} 

            }
            
            
            else {
              $output['error'] = true;
              $output['message']  = "There was an error uploading the file";
            }


          }

          else{
            $pre = "UPDATE product SET name = ? , price = ? ,  stock = ? ,  description = ? , video = ? , category = ?  WHERE id = ?";


            $stmt = $mysqli->prepare($pre);
            $stmt->bind_param('sdissii',  $name , $price , $stock , $description, $video, $category_combobox, $id );
                    //if-else statement in executing our prepared statement
      if ($stmt->execute()){
        $output['message'] = 'product updated successfully, refresh page to see changes';
        
      }
      else{
        $output['error'] = true;
        $output['message'] = 'Something went wrong. Cannot update product';
      } 

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
