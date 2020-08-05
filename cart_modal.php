<!DOCTYPE html>


<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#cart').on('submit', function(e){  
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({

                url: "cart/cart.php",

                method: "POST",

                data: data,



                success: function (data) {
                    var parseddata =JSON.parse(data);
             
                    if (parseddata.error) {
                        $('#alert_Buy').hide(0);
                        $('#alert_Buy').show(100);
                        $('#alert_message_Buy').html(parseddata.message);
                    }
                    else {
                        $('#alert_Buy').show(100);
                        $('#alert_message_Buy').html(parseddata.message);
                        location.assign("./order.php");
                    }
                }



            });


        });

    });

</script>

</html>