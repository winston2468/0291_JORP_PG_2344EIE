
<?php 
 include ( "../db/db_connect.php" );
 $id = $_POST['id'];
                   $stmt = $mysqli->prepare("SELECT * FROM  `cart` WHERE id = ?;");
                   $stmt->bind_param("i", $id);


                    if($stmt->execute()){
                        $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            if($row != NULL){
                            foreach ($row as $column => $value) {
                                echo  $column . ":<br>";
                                echo "<input type='text' name=\"fields[]\" value = \"" . $value . "\" disabled>";
                                echo "<p></p>";

                            }
                            echo "<input type='hidden'  name='id' value ='" . $id . "'/>";
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