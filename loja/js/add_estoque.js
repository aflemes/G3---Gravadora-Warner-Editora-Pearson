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
    $("#btn-salvar").click(function(){
        alert("oi");

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
                if (data != ""){
                    $('#ajax_form')[0].reset();
                    alert(data);
                }
            }   
        });
    });
});



