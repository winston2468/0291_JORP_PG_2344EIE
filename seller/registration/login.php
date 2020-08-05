
<?php 
session_start();
 include ( "../db/db_connect.php" );
 $uname = $_POST['uname'];
 //$pwhash = hash('sha256', $_POST['password']);

 $pwhash =$_POST['password'];
 $output = array('error' => false, 'message'=>'1');
 try{
            $stmt = $mysqli->prepare("SELECT * FROM account WHERE username =? AND password = ?");
            $stmt->bind_param('ss', $uname, $pwhash);




     //if-else statement in executing our prepared statement
     if ($stmt->execute()){
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if($row != NULL ){
            $_SESSION['user_login'] = $row['id'];
            $output['error'] = false;
            $output['message'] = 'Login successful, refreshing page';
    }
    else{
        $output['error'] = true;
        $output['message'] = 'Login failed';
    } 
     }
     else{
         $output['error'] = true;
         $output['message'] = 'Databased failed';
     } 

 }
 catch(mysqli_sql_exception  $e){
     $output['error'] = true;
      $output['message'] = $e->getMessage();
 }


 echo json_encode($output);

?>
