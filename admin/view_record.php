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
                   $stmt = $mysqli->prepare("SELECT * FROM  $table_name WHERE id = ?;");
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