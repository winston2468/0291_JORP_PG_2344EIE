
<?php 
 include ( "../db/db_connect.php" );
 $cartId = $_POST['id'];
                   $stmt = $mysqli->prepare("DELETE FROM `cart` WHERE id = ?");
                   $stmt->bind_param('i', $cartId);

                   try{

                    if ($stmt->execute()){
                        $output['message'] = 'Record deleted successfully, refresh page to see changes';
                    }
                    else{
                        $output['error'] = true;
                        $output['message'] = 'Something went wrong. Cannot delete record';
                    } 
             
                }
                catch(mysqli_sql_exception  $e){
                    $output['error'] = true;
                     $output['message'] = $e->getMessage();
                }
                echo json_encode($output['message']);
 ?>