
        // SWEET ALERT
        $(document).ready(function(){
            $( ".deleteButton" ).bind( "click", function() {
                var url = $(this).data('url');
                var message = $(this).data('confirm');
                var title = $(this).data('title');
                var type = $(this).data('type');
                swal({
                    title: title,
                    text: message,
                    icon: type,
                    buttons: ["Non","Oui"],
                    closeOnConfirm: true
                })
                .then((value) => {
                    if(value == true)
                        return window.location.href = url;
                });
            });
        });