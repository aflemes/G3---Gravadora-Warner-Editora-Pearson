function mountDataGrid(data) {
    var obj = jQuery.parseJSON(data);

    //convert an objet to array
    var array = $.map(obj, function (value, index) {
        return [value];
    });

    document.getElementById("tb-data-grid").innerHTML = "";

    if (array.length > 0) {
        document.getElementById("tb-data-grid").innerHTML = "<tr>";
        document.getElementById("tb-data-grid").innerHTML += "<th>Código do item</th>" +
            "<th>Nome do item</th>" +
            "<th>Valor do item</th>" +
            "<th>Categoria</th>" +
            "</tr>";
    }

    for (i = 0; i < array.length; i++) {
        document.getElementById("tb-data-grid").innerHTML += "<tr>";

        if (array[i]['cod-categ'] == 1) {
            document.getElementById("tb-data-grid").innerHTML += "	<td>" + array[i]['cd-item'] + "</td>" +
                "<td>" + array[i]['nm-item'] + "</td>" +
                "<td>" + array[i]['val-item'] + "</td>" +
                "<td>Livro</td>" +
                "<td><img class='ico-rm'></img></td>" +
                "</tr>";
        } else {
            document.getElementById("tb-data-grid").innerHTML += "	<td>" + array[i]['cd-item'] + "</td>" +
                "<td>" + array[i]['nm-item'] + "</td>" +
                "<td>" + array[i]['val-item'] + "</td>" +
                "<td>CD</td>" +
                "<td><img class='ico-rm'></img></td>" +
                "</tr>";
        }
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