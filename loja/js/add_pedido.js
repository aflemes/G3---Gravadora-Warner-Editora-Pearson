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

$(document).ready(function() {
    var table = $('#example').DataTable({
        "sDom": "r",
        "oLanguage": {
            "sEmptyTable": "Sem registro"
        }
    });

    $("#button-add").click(function(){
        addItemToDataTables();
    });

    $("#btn-salvar").click(function(){
        addItemToOrder();
    });

    function dTablesToArray(){
        var data = table.rows().data();
        var elements = new Array();
        var row = new Array();

        for(i=0;i < data.length;i++){
            elements.push({"cd-item":data[i][0],
                           "nm-item":data[i][1],
                           "qtd-item":data[i][2],
                           "val-item":data[i][3]});
        }
        
        return elements;    
    }
   
    function addItemToOrder(){
        var elements = dTablesToArray();

        jQuery.ajax({
            type: "POST",
            url: "../controller/ctrl_pedido.php",
            data:{
                elements: elements,
                pedido: $("#cod-pedido").val(),
                action: 'saveItemOrder'
            },
            success: function( data )
            {
                if (data == 1){
                    $('#ajax_form')[0].reset();
                    table.clear().draw();

                    getNextSequence();
                    swal("Pedido salvo com sucesso!","");

                }
                else
                    if (data == 2){
                        swal("Nao foi possivel incluir o pedido","error");
                    }
                    else
                        if (data == 3){
                            swal("O item a ser inserido, não possui estoque disponivel");
                        }


            }   
        });
    }

    function addItemToDataTables(){
        var qtde = $("#qtde-item").val();

        jQuery.ajax({
            type: "POST",
            url: "../controller/ctrl_item.php",
            data:{
                item: $("#item").val(),
                qtde: $("#qtde-item").val(),
                action: 'findUniqueByReference'
            },
            success: function( data )
            {
                if (!data){
                    swal("Item sem estoque suficiente");
                }
                else{
                    var obj = jQuery.parseJSON(data);
                    $('#ajax_form')[0].reset();

                    table.row.add([ obj[1]["cd-item"],
                                    obj[1]["nm-item"],
                                    qtde,  
                                    obj[1]["val-item"],
                                ]).draw( false );
                }
            }   
        });
    }
});

function getNextSequence() {
    /*jQuery.ajax({
        type: "POST",
        url: "../controller/ctrl_pedido.php",
        data: {
            action: 'getSequence'
        },
        success: function (data) {
            alert(data);
            $("#cod-pedido").val(parseInt(data) + 1);
        }
    });*/

    $("#cod-pedido").val(parseInt($("#cod-pedido").val()) + 1);
}
