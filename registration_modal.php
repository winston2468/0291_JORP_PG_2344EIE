<!DOCTYPE html>
<?php 

include_once("registration/registration_modal.php");
?>


<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $('.registration').click(function () {
            $('#registration_modal').modal('show');

        });


        $('#registration_form').submit(function (e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({

                url: "./registration/registrate.php",

                method: "POST",

                data: data,



                success: function (data) {
                    var parseddata =JSON.parse(data);
             
                    if (parseddata.error) {
                        $('#alert_2').hide(0);
                        $('#alert_2').show(100);
                        $('#alert_message_2').html(parseddata.message);
                    }
                    else {
                        $('#alert_2').show(100);
                        $('#alert_message_2').html(parseddata.message);
                        fetch();
                        location.reload();
                    }
                }



            });


        });
    });
</script>

</html>