<?php 
 include_once("../db/db_connect.php");
 session_start();
 $category_id = $_POST['id'];
 $user_id = $_SESSION['user_login'];
 $_SESSION['category_main'] = $category_id;
 if($user_id != ""){
    try {
      $query01 = $mysqli->prepare("SELECT `id`, `pressed_times` FROM `category_pressed_time` WHERE `category`= ? AND `user`= ?");
      $query01->bind_param('ii', $category_id, $user_id);
      if ($query01->execute()) {
          $result01 = $query01->get_result();
          $row01 = $result01->fetch_assoc();
          if ($row01 != NULL) {
            try {
              $calculation = $row01['pressed_times'];
              $calculation += 1;
              $setCategory = $mysqli->prepare("UPDATE `category_pressed_time` SET `pressed_times` = ? WHERE `id`=?");
              $setCategory->bind_param('ii', $calculation , $row01['id']);
              if ($setCategory->execute()) {
              } else {
                echo "error";
              }
            } catch (mysqli_sql_exception  $e) {
              echo "error";
            }
          }
          else{
            try {
              $temp = '1';
              $query02 = $mysqli->prepare("INSERT INTO `category_pressed_time` (`category`, `user`, `pressed_times`) VALUES(?, ?, ?)");
              $query02->bind_param('iii', $category_id, $user_id, $temp);
              if ($query02->execute()) {
              } else {
                echo "error";
              }
            } catch (mysqli_sql_exception  $e) {
              echo "error";
            }
          }

      } else {
        echo "error";
      }
    } catch (mysqli_sql_exception  $e) {
      echo "error";
    }
  }
 $output = array('error' => false, 'message'=>'1');
 $output['message'] = $_SESSION['category_main']; 
 echo json_encode($output);
?>