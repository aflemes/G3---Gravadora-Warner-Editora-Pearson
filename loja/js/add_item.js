jQuery(document).ready(function () {
	$("#btn-adicionar").click(function () {
        if (!$("#des-item").val()) {
            swal("Oops...", "Preencha a Descrição do Item.", "warning");
        } else if (!$("#cod-categ").val()) {
            swal("Oops...", "Preencha a Categoria do Item.", "warning");
        } else if (!parseInt($("#val-item").val()) > 0) {
            swal("Oops...", "Preencha o Preço do Item.", "warning");
        } else {
            addItem();
        }
    });

    $("#btn-modificar").click(function () {
        if (!$("#des-item").val()) {
            swal("Oops...", "Preencha a Descrição do Item.", "warning");
        } else if (!$("#cod-categ").val()) {
            swal("Oops...", "Preencha a Categoria do Item.", "warning");
        } else if (!$("#val-item").val()) {
            swal("Oops...", "Preencha o Preço do Item.", "warning");
        } else {
            modifyItem();
        }
    });
	
	$("#val-item").keypress(function(){
		$("#val-item").val(mascaraValor($("#val-item").val()));
	});

	function addItem(){		
		jQuery.ajax({
            type: "POST",
            url: "../controller/ctrl_item.php",
            data: {
                codItem: $("#cod-item").val(),
                desItem: $("#des-item").val(),
                codCateg: $("#cod-categ").val(),
                valItem: $("#val-item").val(),
                obsItem: $("#obs-item").val(),
                action: 'insert'
            },
            success: function (data) {				
                swal("Item cadastrado com sucesso!","success");
                $('#ajax_form')[0].reset();
                getNextSequence();
            },
            error: function (data) {
                swal("Erro...", data, "error");			
            }
        });
    }

    function modifyItem(){
        jQuery.ajax({
            type: "POST",
            url: "../controller/ctrl_item.php",
            data: {
                codItem: $("#cod-item").val(),
                desItem: $("#des-item").val(),
                codCateg: $("#cod-categ").val(),
                valItem: $("#val-item").val(),
                obsItem: $("#obs-item").val(),
                action: 'modifyItem'
            },
            success: function (data) {
                swal("Item modificado com sucesso","success");
            },
            error: function (data) {
                swal("Erro...", data, "error");         
            }
        });    
    }

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
	function mascaraValor(valor) {
		valor = valor.toString().replace(/\D/g,"");
		valor = valor.toString().replace(/(\d)(\d{8})$/,"$1.$2");
		valor = valor.toString().replace(/(\d)(\d{5})$/,"$1.$2");
		valor = valor.toString().replace(/(\d)(\d{2})$/,"$1,$2");
		return valor                    
	}
});