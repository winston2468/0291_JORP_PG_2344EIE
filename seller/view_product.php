<!DOCTYPE html>
<meta charset="UTF-8">
<head>
<?php 
 include ( "../db/db_connect.php" );
 $table_name = 'product';
 $id = $_POST['id'];
 
function categoryTreeView($id = 0, $sub_mark = ''){
    global   $mysqli;
    $query = $mysqli->query("SELECT * FROM category WHERE id = $id AND id != 0 ORDER BY name ASC");
   
    if(  isset($query->num_rows)  && $query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            echo "<input disabled value='" . $sub_mark.$row['name'] . "' class='form-control'>";
            categoryTreeView($row['parent'], $sub_mark.'../');
        }
    }
 }


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
                                if($column == 'seller'){
                                }

                                else if($column == 'image'){
                                    echo  "<div class='form-group'>
                                    <label>" . $column . ":</label>";
                                      echo "<input readonly='readonly' name='" . $column . "_old' value='" . $value . "'class='form-control'>";
                                      echo "</div>";
                                      echo"  
                                      <div class='form-group' style='position: relative;' >
                                      <span class='img-div'>
                                     
                                          <h4>Product Image:</h4>
                                          
                                          <img src='../image/". $value ."'  class ='img-thumbnail'  id='productDisplay' >
                                      </span>

                                    </div>";
  
                                  }
   
                                
                                else if($column == 'category') {
                                    echo  "<div class='form-group'>
                                    <label>".  $column . ": </label>";
                                echo "<input hidden value='" . $value . "' class='form-control'>";
                                echo categoryTreeView($value);
                                echo "</div>";
                                }
                                else if($column == 'price') {
                                    echo  "<div class='form-group'>
                                    <label>Price (in HKD):</label>";
                                echo "<input disabled value='" . $value . "' class='form-control'>";
                                echo "</div>";
                                }
                                else if($column == 'description') {
                                    echo  "<div class='form-group'>
                                    <label>".  $column . ":</label>";
                                echo "<textarea disabled value='" . $value . "' class='form-control'>$value</textarea>";
                                echo "</div>";
                                }
                                else{
                                    echo  "<div class='form-group'>
                                    <label>".  $column . ":</label>";
                                echo "<input disabled value='" . $value . "' class='form-control'>";
                                echo "</div>";
                                }
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