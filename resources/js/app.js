require('./bootstrap');
require('./jquery');
require('./chart');


$(document).ready(function () {
    $("#showBtton").click(function(){
        $("#tableContainer").css("display", "block");
        $(document).scrollTop(800);
    });
    $(".modalInformation").click(function(){
        $("#tableModal tr").remove(); 
        //Recibimos y parseamos los datos del blade
        rawData =  $(this).attr("value");
        var metadatos =JSON.parse(rawData);

        $("#tituloModal").text("Para el Metadato: " + metadatos['ruleKeyName']);
        $("#description").text(metadatos['description']);
        
        var metaString = metadatos['rejectMessages'];
        var urls = metadatos['url'];
        var rejectMessages =  metaString.split(",");
        var resource_url = urls.split(",");

        var table = document.getElementById("tableModal");
        var header = table.createTHead();
        var row = header.insertRow(0);    
        var description_header = row.insertCell(0);
        var url_header = row.insertCell(1);
        description_header.innerHTML = "<b>Mensajes de Error</b>"; 

        var tbodyRef = document.getElementById('tableModal').getElementsByTagName('tbody')[0];

        if (metaString !== "") {
            url_header.innerHTML = "<b>URL</b>"; 
            if (rejectMessages.length > 1) {
                rejectMessages.forEach(function(entry, index) {
                    var newRow = tbodyRef.insertRow();
                    var description_cell = newRow.insertCell();
                    var description_text = document.createTextNode(entry);
                    description_cell.appendChild(description_text);
                    var url_cell = newRow.insertCell();

                    var url_button = document.createElement('button');
                    var url_icon = document.createElement('i');
                    var link = "";
                    link = "window.open(" + '\'' + resource_url[index] + '\'' + ",'_blank')";

                    url_button.setAttribute('class', "btn btn-primary-outline");
                    url_button.setAttribute('onclick', link);
                    url_icon.setAttribute('class', "fas fa-link");
                    url_icon.setAttribute('aria-hidden', "true");

                    url_button.appendChild(url_icon);
                    url_cell.appendChild(url_button);
                }, this);
            }else{
                var newRow = tbodyRef.insertRow();
                var description_cell = newRow.insertCell();
                var description_text = document.createTextNode(rejectMessages[0]);
                description_cell.appendChild(description_text);
                var url_cell = newRow.insertCell();

                var url_button = document.createElement('button');
                var url_icon = document.createElement('i');
                var link = "";
                link = "window.open(" + '\'' + resource_url[0] + '\'' + ",'_blank')";

                url_button.setAttribute('class', "btn btn-primary-outline");
                url_button.setAttribute('onclick', link);
                url_icon.setAttribute('class', "fas fa-link");
                url_icon.setAttribute('aria-hidden', "true");

                url_button.appendChild(url_icon);
                url_cell.appendChild(url_button);
            }
        }else{
            var newRow = tbodyRef.insertRow();
            var description_cell = newRow.insertCell();
            var description_text = document.createTextNode("No se encontraron problemas con este metadato");
            description_cell.appendChild(description_text);

            var url_cell = newRow.insertCell();
                var url_text = document.createTextNode("");
                url_cell.appendChild(url_text);
        }

    });
})