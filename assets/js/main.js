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
