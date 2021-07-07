require('./bootstrap');
require('./jquery');


$(document).ready(function () {
    $("#showBtton").click(function(){
        $("#tableContainer").css("display", "block");
        $(document).scrollTop(800);
    });
})