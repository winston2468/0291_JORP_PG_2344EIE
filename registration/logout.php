
<?php 


session_start();



     if (session_unset()){

            $output['error'] = false;
            $output['message'] = 'Logout successful, refreshing page';
    

     }
     else{
         $output['error'] = true;
         $output['message'] = 'failed';
     } 

 



 echo json_encode($output);

?>
