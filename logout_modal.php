<!DOCTYPE html>
<?php 

include_once("registration/logout_modal.html");
?>


<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
         
        $('.logout').click(function () {
            $('#logout_modal').modal('show');

        });
    });





        $('#logout_form').submit(function (e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({

                url: "./registration/logout.php",

                method: "POST",

                data: data,



                success: function (data) {
                    var parseddata =JSON.parse(data);
             
                    if (parseddata.error) {
                        $('#alert').show();
                        $('#alert_message').html(parseddata.message);
                    }
                    else {
                        $('#alert').show();
                        $('#alert_message').html(parseddata.message);
                        fetch();
                        location.assign("./index.php");
                        //$('#logout_modal').modal('hide');
                    }
                }



            });


        });
</script>

</html>