$(document).ready(function(){
    $('.spoiler-body3').hide();
    $('.spoiler-title3').click(function(){
        $(this).toggleClass('opened').toggleClass('closed').next().slideToggle();
        if($(this).hasClass('opened')) {
            $(this).html('<i class="fas fa-chevron-up colorYellow"></i> Greitoji paieška');
        }
        else {
            $(this).html('<i class="fas fa-chevron-down colorYellow"></i> Detalioji paieška');
        }
    });
});


$(window).scroll(function() {
    if ($(this).scrollTop() > 1){
        $('header').addClass("sticky");
    }
    else{
        $('header').removeClass("sticky");
    }
});

function init() {
        var input = document.getElementById('trip_search_departFrom', {
            componentRestrictions: { country: 'lt' }
    });
        var autocomplete = new google.maps.places.Autocomplete(input);
        var input2 = document.getElementById('trip_search_destination', {
        componentRestrictions: { country: 'lt' }
    });
        var autocomplete2 = new google.maps.places.Autocomplete(input2);

    }
google.maps.event.addDomListener(window, 'load', init);

var h_hght = 81;
var h_mrg = 0;

$(function(){

    var elem = $('#top_nav');
    var top = $(this).scrollTop();

    if(top > h_hght){
        elem.css('top', h_mrg);
    }

    $(window).scroll(function(){
        top = $(this).scrollTop();

        if (top+h_mrg < h_hght) {
            elem.css('top', (h_hght-top));
        } else {
            elem.css('top', h_mrg);
        }
    });

});
