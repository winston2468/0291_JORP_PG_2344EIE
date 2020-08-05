<!DOCTYPE html>
<?php 

include("registration/login_modal.html");
?>


<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $('.login').click(function () {
            $('#login_modal').modal('show');

        });

    });





        $('#login_form').submit(function (e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({

                url: "registration/login.php",

                method: "POST",

                data: data,



                success: function (data) {
                    var parseddata =JSON.parse(data);
             
                    if (parseddata.error) {
                        $('#alert').hide(0);
                        $('#alert').show(100);
                        $('#alert_message').html(parseddata.message);
                    }
                    else {
                        $('#alert').show(100);
                        $('#alert_message').html(parseddata.message);
                        fetch();
                        location.reload();
                    }
                }



            });


        });
</script>

</html>