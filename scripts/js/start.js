
$(window).load(function(){
    $('#loading').delay(500).fadeOut(1000);
});

$(document).ready(function() {
    
    $("#picture").height($(window).height());

    $(window).scroll(function (event) {
        
    });

    $(window).resize(function(){
        $("#picture").height($(window).height());
    });
});