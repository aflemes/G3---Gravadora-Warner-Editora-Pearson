function getDescrItem() {
    jQuery.ajax({
        type: "POST",
        url: "../controller/ctrl_item.php",
        data: {
            item: $("#item").val(),
            action: 'findUnique'
        },
        success: function (data) {
            if (data != "NaN") {

            }
        }
    });
}

jQuery(document).ready(function () {
    jQuery('#ajax_form').submit(function () {
        var dados = jQuery(this).serialize();

        jQuery.ajax({
            type: "POST",
            url: "../controller/ctrl_pedido.php",
            data: {
                data: dados,
                action: 'insert'
            },
            success: function (data) {
                alert(data);
                $('#ajax_form')[0].reset();
                getNextSequence();
            }
        });


        function getNextSequence() {
            jQuery.ajax({
                type: "POST",
                url: "../controller/ctrl_pedido.php",
                data: {
                    action: 'getSequence'
                },
                success: function (data) {
                    $("#cod-pedido").val(parseInt(data) + 1);
                }
            });
        }
    });
});