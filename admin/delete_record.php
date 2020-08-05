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
                   $stmt = $mysqli->prepare("DELETE FROM  $table_name WHERE id = ?;");
                   $stmt->bind_param("s", $id);

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
                $stmt->close();
             
                echo json_encode($output['message']);
 
                    // Close connection
                   
                    ?>
</body>

</html>