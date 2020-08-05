<?php 
session_start();
include ( "../db/db_connect.php" );
$fullName = $_POST['fullName'];
$username = $_POST['username'];
$password = $_POST['password_reg'];
$confirmPassword = $_POST['confirmPassword'];
$email = $_POST['email'];
$address = $_POST['address'];
$phoneNo = $_POST['phoneNo'];
$country = $_POST['country'];
$userType = $_POST['userType'];
$countryId = null;

$output = array('error' => false, 'message'=>'1');
if($password == $confirmPassword){
    try{
        $query01 = $mysqli->prepare("SELECT `username` FROM `4432_db`.`account` where `username` = ?");
        $query01->bind_param('s', $username);

        if ($query01->execute()){
            $result01 = $query01->get_result();
            $row01 = $result01->fetch_assoc();
            if($row01 != NULL ){
                $output['error'] = true;
                $output['message'] = 'Sorry, this username has already registered by others';     
            }
            else{
                $query02 = $mysqli->prepare("SELECT `name`, `id` FROM `4432_db`.`country` where `name` = ?");
                $query02->bind_param('s', $country);

                if ($query02->execute()){
                    $result02 = $query02->get_result();
                    $row02 = $result02->fetch_assoc();
                    if($row02 == NULL ){
                        $output['error'] = true;
                        $output['message'] = 'Please select the country in the list';
                    }
                    else{
                        $countryId = $row02["id"];
                        $query03 = $mysqli->prepare("INSERT INTO `account` (`fullname`, `username`, `password`, `email`, `address`, `phone`, `country`, `type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                        $query03->bind_param('ssssssss', $fullName, $username, $password, $email, $address, $phoneNo, $countryId, $userType);
                        if ($query03->execute()){
                            $output['message'] = 'registered successfully.';

                            $query04 = $mysqli->prepare("SELECT `id` FROM `4432_db`.`account` where `username` = ?");
                            $query04->bind_param('s', $username);
                            if ($query04->execute()){
                                $result04 = $query04->get_result();
                                $row04 = $result04->fetch_assoc();
                                if($row04 != NULL ){
                                    $_SESSION['user_login'] = $row04['id'];
                                }
                            }
                            else{
                                $output['error'] = true;
                                $output['message'] = 'Databased failed';
                            }
                        }
                        else{
                            $output['error'] = true;
                            $output['message'] = 'Databased failed';
                        }
                    }
                }
                else{
                    $output['error'] = true;
                    $output['message'] = 'Databased failed';
                }
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
}
else{
    $output['error'] = true;
    $output['message'] = 'The passwords are not the same. Please input again.';
}
echo json_encode($output);
?>
