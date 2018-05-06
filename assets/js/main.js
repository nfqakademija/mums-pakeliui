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
