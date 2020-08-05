<!DOCTYPE html>
<?php
include_once("manage_database.php");


$table_name = $_GET["table_name"];
//$table_name = "account";
?>

<link rel="stylesheet" type="text/css" href="../dependencies/DataTables/datatables.min.css" />
<script type="text/javascript" src="../dependencies/DataTables/datatables.min.js"></script>

<head>

    <title>Dashboard</title>

    <style type="text/css">
        .page-header h2 {
            margin-top: 0;
        }

        table tr td:last-child a {
            margin: 0 auto;
        }

        .field_action {
            white-space: nowrap;
        }

        .fa-eye {
            color: #536DFE;
        }

        .fa-eye:hover {
            color: #00BFFF;
            /* font-size:2em;
  transition: 0.1s ease-out;*/

        }

        .fa-edit {
            color: #DAA520;
        }

        .fa-edit:hover {
            color: #00BFFF;
            /* font-size:2em;
  transition: 0.1s ease-out;*/

        }

        .fa-trash-alt {
            color: red;
        }

        .fa-trash-alt:hover {
            color: #00BFFF;
            /* font-size:2em;
  transition: 0.1s ease-out;*/

        }
    </style>

</head>

<body>
<div id="alert" class="alert alert-info text-center" style="display:none;">
<span id="alert_message"></span>
            	<button class="close"><span aria-hidden="true">&times;</span></button>
               
            </div>  


    <div class="container-fluid">
 
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Table: <?php echo $table_name; ?></h2>
                    <a href='#' title='Add Record' data-toggle='tooltip' class="btn btn-success pull-right add_data">Add New '<?php echo $table_name; ?>' Record</a>
                </div>
                <?php
                $sql = "SELECT * FROM " . $table_name . ";";


                if ($result = $mysqli->query($sql)) {
                    echo "<input hidden disabled id='db_table_name' name='" . $table_name . "'/>";
                    if ($result->num_rows > 0) {
                        
                        echo "<table id='db_table' name=" . $table_name . " class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        $fields = $result->fetch_fields();
                        $field = array();
                        $f =0;
                        foreach ( $fields as $fields) {  //show first 4 fields
                            echo "<th>" . $fields->name . "</th>";
                             array_push($field, $fields->name);
                            $f+=1;
                            if ($f>4){
                            break;
                            }
                        }

                        echo "<th>Actions</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = $result->fetch_array(MYSQLI_BOTH)) {
                            echo "<tr>";
                            for ($i = 0; $i < $f; $i++) {  //show first 4 fields
                                echo "<td>" . $row[$field[$i]] . "</td>";


                            }
                            echo "<td>";
                            echo "<p class='field_action'>";
                            //echo "<input type='button' title='View Record' data-toggle='tooltip' class= 'view_data' id=". $row[0] .">   ";
                            echo "<a href='#' title='View Record' data-toggle='tooltip' class= 'view_data' id=" . $row[0] . "><i class='fas fa-eye'></i></a>   ";
                            echo "<a href='#' title='Update Record' data-toggle='tooltip' class= 'update_data' id=" . $row[0] . "><i class='fas fa-edit'></i></a>   ";
                            echo "<a href='#' title='Delete Record' data-toggle='tooltip' class= 'delete_data' id=" . $row[0] . "><i class='fas fa-trash-alt'></i></a>   ";
                            echo "</p>";
                            echo "</td>";

                            echo "</tr>";
                        }


                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo "<p class='lead'><em>No records were found.</em></p>";
                        
                    }
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }

                // Close connection
                ?>

            </div>
        </div>
    </div>
</body>



<script type="text/javascript">
    $(document).ready(function() {
        $('#db_table').DataTable({});
        $('[data-toggle="tooltip"]').tooltip();


        $("#db_table").on("click",".view_data",function() {

var id = $(this).attr('id');
var table_name = $('#db_table_name').attr('name');

$.ajax({

    url: "view_record.php",

    method: "POST",

    data: {
        id: id,
        table_name: table_name
    },

    success: function(data) {

        $('#view_result').html(data);
        // Display the Bootstrap modal
        $('#view_record_modal').modal('show');
    }
});

});






$(".add_data").on("click", function() {
var table_name = $('#db_table_name').attr('name');

$.ajax({

    url: "add_record_info.php",

    method: "POST",

    data: {
        table_name: table_name
    },

    success: function(data) {

        $('#add_form_info').html(data);
        // Display the Bootstrap modal
        $('#add_record_modal').modal('show');
    }
});
});





    });






   
    $("#db_table").on("click",".update_data",function() {
var id = $(this).attr('id');
var table_name = $('#db_table_name').attr('name');

$.ajax({

    url: "update_record_info.php",

    method: "POST",

    data: {
        id: id,
        table_name: table_name
    },

    success: function(data) {

        $('#update_form_info').html(data);
        // Display the Bootstrap modal
        $('#update_record_modal').modal('show');
    }
});
});













$("#db_table").on("click",".delete_data",function() {
var id = $(this).attr('id');
var table_name = $('#db_table_name').attr('name');

$.ajax({

    url: "delete_record_info.php",

    method: "POST",

    data: {
        id: id,
        table_name: table_name
    },

    success: function(data) {
        $('#delete_form_info').html("");
        $('#delete_form_info').html(data);
        // Display the Bootstrap modal
        $('#delete_record_modal').modal('show');
    }
});



});




$(function(){
$('#delete_form').submit(function(e){
e.preventDefault();
var data = $(this).serialize();

$.ajax({

    url: "delete_record.php",

    method: "POST",

    data: data,


    success: function(data){
        
    $('#delete_record_modal').modal('hide');
    $('#delete_form_info').html("");
     //location.reload();
    if(data.error){
        $('#alert').show();
        $('#alert_message').html(data);
    }
    else{
        $('#alert').show();
        $('#alert_message').html(data);
        fetch();
        location.reload();
    }
}



});


});


$('#update_form').submit(function(e){
e.preventDefault();
var data = $(this).serialize();

$.ajax({

    url: "update_record.php",

    method: "POST",

    data: data,


    success: function(data){
    $('#update_record_modal').modal('hide');
     //location.reload();
    if(data.error){
        $('#alert').show();
        $('#alert_message').html(data);
    }
    else{
        $('#alert').show();
        $('#alert_message').html(data);
        fetch();
    }
}



});


});

$('#add_form').submit(function(e){
e.preventDefault();
var data = $(this).serialize();

$.ajax({

    url: "add_record.php",

    method: "POST",

    data: data,


    success: function(data){
    $('#add_record_modal').modal('hide');
     //location.reload();
    if(data.error){
        $('#alert').show();
        $('#alert_message').html(data);
    }
    else{
        $('#alert').show();
        $('#alert_message').html(data);
        fetch();
    }
}



});


});

});





</script>



</html>

<!-- view modal -->
<div class="modal fade" id="view_record_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
    <div class="modal-dialog modal-lg modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="basicModal">'<?php echo $table_name;?>' Record Details</h4>
               

            </div>
            <div class="modal-body">
                <div id="view_result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- add modal -->



<div class="modal fade" id="add_record_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <center><h4 class="modal-title" id="basicModal">Add <?php echo $table_name;?> Record</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form id="add_form" action="" method="">
            <div id="add_form_info">
            </div>
				
            </div> 
			</div>
            <div class="modal-footer">

            <button type="submit" class="btn btn-primary" >Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                
			</form>
            </div>
            </div>
        </div>
    </div>


<!-- update modal -->

<div class="modal fade" id="update_record_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <center><h4 class="modal-title" id="basicModal">Update <?php echo $table_name;?> Record</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form id="update_form" action="" method="">
            <div id="update_form_info">
            </div>
				
            </div> 
			</div>
            <div class="modal-footer">

            <button type="submit" class="btn btn-primary" >Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                
			</form>
            </div>
            </div>
        </div>
    </div>

    
<!-- delete modal -->

<div class="modal fade" id="delete_record_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <center><h4 class="modal-title" id="basicModal">Confirm Delete <?php echo $table_name;?> Record</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form id="delete_form" action="" method="">
            <div id="delete_form_info">
            </div>
				
            </div> 
			</div>
            <div class="modal-footer">

            <button type="submit" class="btn btn-danger" >Delete</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                
			</form>
            </div>
            </div>
        </div>
    </div>