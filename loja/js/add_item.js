jQuery(document).ready(function () {
    $("#btn-adicionar").click(function () {
        if (!$("#des-item").val()) {
            swal("Oops...", "Preencha a Descrição do Item.", "warning");
        } else if (!$("#cod-categ").val()) {
            swal("Oops...", "Preencha a Categoria do Item.", "warning");
        } else if (!$("#val-item").val()) {
            swal("Oops...", "Preencha o Preço do Item.", "warning");
        } else {
            $('#ajax_form').submit();
        }
    });

    $('#ajax_form').submit(function () {
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
            error: function (data) {
                swal("Erro...", data, "error");
            }
        });
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
    };
});