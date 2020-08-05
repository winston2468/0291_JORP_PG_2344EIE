<!DOCTYPE html>
<meta charset="UTF-8">
<head>
<?php 
 include ( "../db/db_connect.php" );
 $table_name = $_POST['table_name'];

?>
</head>

                    <?php

$sql = 'SHOW COLUMNS FROM '. $table_name;





                    if($res = $mysqli->query($sql)){
                        while($row = $res->fetch_assoc()){
                            $columns[] = $row['Field'];
                        }
                            foreach ($columns as $column) {

                                echo  $column . ":<br>";
                                echo "<input type='text' name='fields[]'>";
                                echo "<p></p>";
                            
                            }
                            echo "<input type='hidden'  name='table_name' value ='" .$table_name . "'/>";
                        

                            // Free result set
                            $res->free();
                        
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    ?>
</body>

</html>