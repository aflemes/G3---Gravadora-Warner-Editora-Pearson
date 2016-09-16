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
            "   <th>Categoria</th>" +
            "   <th>Excluir</th>" +
            "   <th>Editar</th>" +
            "</tr>";
    }

    for (i = 0, len = array.length; i < len; i++) {
        tabela.innerHTML += "<tr>" +
            "   <td>" + array[i]['cd-item'] + "</td>" +
            "   <td>" + array[i]['nm-item'] + "</td>" +
            "   <td>" + array[i]['val-item'] + "</td>" +
            "   <td>" + (array[i]['cd-categ'] == 1 ? "Livro" : "CD") + "</td>" +
            "   <td><i class='fa fa-trash icon-excluir'></i></td>" +
            "   <td><i class='fa fa-pencil icon-editar'></i></td>" +
            "</tr>";
    }
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
            alert("Aconteceu um erro na aplicacao");
        }
    });
}

function verifyEnterSearch(evt) {
    if (evt.keyCode == 13) {
        getAllInformation();
        evt.preventDefault();
    }
}