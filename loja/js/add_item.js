jQuery(document).ready(function () {
    jQuery('#ajax_form').submit(function () {
        var dados = jQuery(this).serialize();
		
        jQuery.ajax({
            type: "POST",
            url: "../controller/ctrl_item.php",
            data: {
                data: dados,
                codItem: $("#cod-item").val(),
                desItem: $("#des-item").val(),
                codCateg: $("#cod-categ").val(),
                valItem: $("#val-item").val(),
                obsItem: $("#obs-item").val(),
                action: 'insert'
            },
            success: function (data) {
                alert(data);
                $('#ajax_form')[0].reset();
                getNextSequence();
            },
			error: function (data){
				alert(data);
			}
        });


        function getNextSequence() {
            jQuery.ajax({
                type: "POST",
                url: "../controller/ctrl_item.php",
                data: {
                    action: 'getSequence'
                },
                success: function (data) {
                    $("#cod-item").val(parseInt(data) + 1);
                }
            });
        }
    });
});