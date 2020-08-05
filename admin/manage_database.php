<?php
    include_once("../db/db_connect.php");
    include_once("admin_template.html");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
if (!isset($_SESSION['user_login'])) {
    $user_id = "";
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . '/4432_project/index.php');
} else {
    $user_id = $_SESSION['user_login'];
}

    $sql = "SELECT table_name FROM information_schema.tables where TABLE_SCHEMA='4432_db';";
    $result = $mysqli->query($sql);
    ?>

<head>
 


    <style type="text/css">


        .wrapper {
            margin: 0 auto;
        }
    </style>

    
    <script type="text/javascript">
     /*   $(document).ready(function() {

            $('#db_dropdown').submit(function(e) {
               e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    url: "list_table.php",
                    method: "GET",
                    data: data,

                    success: function(data) {

                        $('#crud').html(data);
                    }

                });
            });
        });
        */
    </script>
</head>

<h1> <a href="../index.php" id="rth">Return to home page</a></h1>

<body>

    <div class="wrapper container-fluid">
        <div class="db_dropdown_wrapper">

            <div class=" db_dropdown_head"> Select Database:
            </div>
            <div class="db_dropdown_form">
                <form id="db_dropdown"  action="list_table.php" method = "GET">
                    <?php
                    echo "<select name='table_name' >";
                    while ($row = mysqli_fetch_array($result)) {
                      //  if($_GET['table_name'] = $row['table_name']){
                          //  echo "<option selected value='" . $row['table_name'] . "'>" . $row['table_name'] . " </option>";  

                    //    }
                       // else{
                        echo "<option value='" . $row['table_name'] . "'>" . $row['table_name'] . "</option>";
                        //}
                    }
                    echo "</select>";
                    ?>
                    <input type="submit" name="submit" value="Edit table" />
                </form>
            </div>
        </div>
        <div class="crud_wrapper" id="crud">
        </div>

    </div>
</body>
<script>



</script>



</html>