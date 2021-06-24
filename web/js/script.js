$(document).ready(function(){
    var link = $('.nav__burger');
    var menu = $('.nav__body');
    var nav_link = $('.nav__link');
    var wrapper = $('body');

    link.click(function(){
        link.toggleClass('active');
        menu.toggleClass('active');
        wrapper.toggleClass('lock');
    });

    nav_link.click(function(){
        link.toggleClass('active');
        menu.toggleClass('active');
        wrapper.toggleClass('lock');
    });

});