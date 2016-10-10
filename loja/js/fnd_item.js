function mountDataGrid(data) {
    var obj = jQuery.parseJSON(data);

    //convert an objet to array
    var array = $.map(obj, function (value, index) {
        return [value];
    });

    var tabela = document.getElementById("tb-data-grid");
    tabela.innerHTML = "";

    if (array.length > 0) {
        tabela.innerHTML += "<tr>" +
            "   <th>Código do item</th>" +
            "   <th>Nome do item</th>" +
            "   <th>Valor do item</th>" +
            "   <th>Qtde.</th>" +
            "   <th>Categoria</th>" +
            "   <th>Excluir</th>" +
            "   <th>Editar</th>" +
            "</tr>";
    }

    for (i = 0, len = array.length; i < len; i++) {
        tabela.innerHTML += "<tr id='" + array[i]['cd-item'] +"'>" +
            "   <td>" + array[i]['cd-item'] + "</td>" +
            "   <td>" + array[i]['nm-item'] + "</td>" +
            "   <td>" + array[i]['val-item'] + "</td>" +
            "   <td>" + array[i]['qtde-item'] + "</td>" +
            "   <td>" + (array[i]['cd-categ'] == 1 ? "Livro" : "CD") + "</td>" +
            "   <td><i class='fa fa-trash icon-excluir' onclick='removeItem("+array[i]['cd-item']+")'></i></td>" +
            "   <td><i class='fa fa-pencil icon-editar' onclick='modifyItem("+array[i]['cd-item']+")'></i></td>" +
            "</tr>";
    }
}

function removeItem(codItem){
	var resposta = confirm("Voce tem certeza que deseja remover este item?");
	
	if (resposta){
       //remove nodo
       jQuery.ajax({
            type: "POST",
            url: "../controller/ctrl_item.php",
            data: {
                codItem: codItem,
                action: 'removeUniqueItem'
            },
            success: function (data) {            
                swal("Item removido com sucesso","");
                $("#"+codItem).css("display","none");
            },
            error: function (data) {
                swal("Oops...", "Aconteceu um erro na aplicação.", "error");
            }
        });
	}
}

function modifyItem(codItem){
    jQuery.ajax({
        type: "POST",
        url: "../controller/ctrl_item.php",
        data: {
            codItem: codItem,
            action: 'beforeModify'
        },
        success: function (data){
            location.href = "../view/add_item.php";
        },
        error: function (data) {
            swal("Oops...", "Aconteceu um erro na aplicação.", "error");
        }
    });
}

function getAllInformation() {
    jQuery.ajax({
        type: "POST",
        url: "../controller/ctrl_item.php",
        data: {
            desItem: $("#buscar").val(),
            action: 'find'
        },
        success: function (data) {            
            mountDataGrid(data);
        },
        error: function (data) {
            swal("Oops...", "Aconteceu um erro na aplicação.", "error");
        }
    });
}

function verifyEnterSearch(evt) {
    if (evt.keyCode == 13) {
        getAllInformation();
        evt.preventDefault();
    }
}