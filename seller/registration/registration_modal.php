<!DOCTYPE html>




<head>



    <style type="text/css">
        .page-header h2 {
            margin-top: 0;
        }

        table tr td:last-child a {
            margin: 0 auto;
        }
    </style>

</head>
<body>
        <!-- login modal -->
        
        <div class="modal fade" id="registration_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="basicModal">Register</h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="registration_form" action="">
    
                            <div class='row form-group'>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Your Full name:</label>
                                </div><br>
                                <div class='col-auto'>
                                    <input type='text' class='form-control' id="fullName" name='fullName' required>
                                </div><br>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Your Username:</label><br>
                                </div><br>
                                <div class='col-auto'>
                                    <input type='text' class='form-control' id="username" name='username' required>
                                </div><br>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Your Password:</label>
                                </div><br>
                                <div class='col-auto'>
                                    <input type='password' class='form-control' id="password_reg" name='password_reg' required>
                                </div><br>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Double Confiirm Your Password:</label>
                                </div><br>
                                <div class='col-auto'>
                                    <input type='password' class='form-control' id="confirmPassword" name='confirmPassword' required>
                                </div><br>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Your Email:</label>
                                </div><br>
                                <div class='col-auto'>
                                    <input type='email' class='form-control' id="email" name='email' required>
                                </div><br>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Your Address:</label>
                                </div><br>
                                <div class='col-auto'>
                                    <input type='text' class='form-control' id="v" name='address' required>
                                </div><br>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Your Phone Number:</label>
                                </div><br>
                                <div class='col-auto'>
                                    <input type='text' class='form-control' id="phoneNo" name='phoneNo' required>
                                </div> <br>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Your Country:</label>
                                </div><br>
                                <div class='col-auto'>
                                <input list="country" class='form-control' name="country" required><br>
                                <datalist id="country">
                                    <?php
                                        $query = "select name from `4432_db`.`country`;";
                                        $conn = mysqli_connect("localhost", "root", "","4432_db");

                                        if ($conn->connect_error)  {
                                            echo "Unable to connect to database";
                                            exit;
                                        }
                                        
                                        $result01 = $conn->query($query);
                                        if (!$result01) die("No information");

                                        $result01->data_seek(0);
                                        while ($row=$result01->fetch_assoc())  {
                                            $country = $row["name"];
                                            echo"<option value=\"" . $country . "\">";
                                        }
                                    ?>    
                                </datalist>
                                </div><br>
                                <div class='col-auto'>
                                    <label class='control-label' style='position:relative; top:7px;'>Please Enter Your User Type:</label>
                                </div><br>
                                <div class='col-auto'>
                                    <div id="adminButton" style='display:none'>
                                        <input type="radio" name="userType" value="0" required> Admin
                                    </div>
                                    <input type="radio" name="userType" value="1" required> Seller
                                    <input type="radio" name="userType" value="2" required> Buyer
                                </div> 
                            </div>
    
    
                    </div>
                </div>
                <div class="modal-footer">
    
                    <button type="submit" class="btn btn-primary">Register</button>
    
                    </form>
                </div>
                <div id="alert_2" class="alert alert-info text-center" style="display:none;">
                        <span id="alert_message_2"></span>
                </div>
            </div>
        </div>
    </div>




</body>



</html>

