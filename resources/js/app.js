require('./bootstrap');
require('./jquery');


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
        var rejectMessages =  metaString.split(",");

        var table = document.getElementById("tableModal");
        var header = table.createTHead();
        var row = header.insertRow(0);    
        var cell = row.insertCell(0);
        cell.innerHTML = "<b>Mensajes de Error</b>"; 

        var tbodyRef = document.getElementById('tableModal').getElementsByTagName('tbody')[0];

        if (metaString !== "") {
            
            if (rejectMessages.length > 1) {
                rejectMessages.forEach(function(entry) {
                    var newRow = tbodyRef.insertRow();
                    var newCell = newRow.insertCell();
                    var newText = document.createTextNode(entry);
                    newCell.appendChild(newText);
                }, this);
            }else{
                var newRow = tbodyRef.insertRow();
                var newCell = newRow.insertCell();
                var newText = document.createTextNode(rejectMessages[0]);
                newCell.appendChild(newText);
            }
        }else{
            var newRow = tbodyRef.insertRow();
            var newCell = newRow.insertCell();
            var newText = document.createTextNode("No se encontraron problemas con este metadato");
            newCell.appendChild(newText);
        }

    });
})