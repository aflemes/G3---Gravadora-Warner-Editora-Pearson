jQuery(document).ready(function () {
    $("#btn-salvar").click(function () {
        if (!$("#item").val()) {
            swal("Oops...", "Preencha o Item.", "warning");
        } else if (!$("#qtde-item").val()) {
            swal("Oops...", "Preencha a Quantidade do Item.", "warning");
        } else {
            atualizaEstoque();
        }
    });
});

function getDescrItem() {    

    jQuery.ajax({
        type: "POST",
        url: "../controller/ctrl_item.php",
        data:{
            item: $("#item").val(),
            action: 'findUniqueByReference'
        },
        success: function( data )
        {
            if (data != ""){
                var obj = jQuery.parseJSON(data);
                var elements = new Array();

                for(i=1;;i++){
                    if (obj[i] != null)
                        elements.push(obj[i]["nm-item"]);
                    else break;
                }
                $("#item").autocomplete({                        
                    source: elements
                }); 
            }
        }   
    });
}
function atualizaEstoque(){
    jQuery.ajax({
        type: "POST",
        url: "../controller/ctrl_estoque.php",
        data:{
            item: $("#item").val(),
            qtde:  $("#qtde-item").val(),
            action: 'insert'
        },
        success: function( data )
        {
            if (data){
                $('#ajax_form')[0].reset();
                swal("Mensagem", "Estoque atualizado com sucesso!");
            }else swal("Error", "Item não cadastrado!");
        },
        fail: function( data )
        {
            swal("Error","Ocorre um erro inesperado");
        }
    });
}



