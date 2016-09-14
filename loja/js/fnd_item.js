function mountDataGrid(data) {
    var obj = jQuery.parseJSON(data);

    //convert an objet to array
    var array = $.map(obj, function (value, index) {
        return [value];
    });

    var tbDataGrid = document.getElementById("tb-data-grid");
    console.log(obj)
    tbDataGrid.innerHTML = "";

    if (array.length > 0) {
        tbDataGrid.innerHTML = "<tr>";
        tbDataGrid.innerHTML += "<th>Código do item</th>" +
            "<th>Nome do item</th>" +
            "<th>Valor do item</th>" +
            "<th>Categoria</th>" +
            "</tr>";
    }

    for (i = 0; i < array.length; i++) {
        tbDataGrid.innerHTML += "<tr>";

        if (array[i]['cod-categ'] == 1) {
            tbDataGrid.innerHTML += "	<td>" + array[i]['cd-item'] + "</td>" +
                "<td>" + array[i]['nm-item'] + "</td>" +
                "<td>" + array[i]['val-item'] + "</td>" +
                "<td>Livro</td>" +
                "<td><img class='ico-rm'></img></td>" +
                "</tr>";
        } else {
            tbDataGrid.innerHTML += "	<td>" + array[i]['cd-item'] + "</td>" +
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

function verifyEnterSearch(evt) {
    if (evt.keyCode == 13) {
        getAllInformation();
        evt.preventDefault();
    }
}