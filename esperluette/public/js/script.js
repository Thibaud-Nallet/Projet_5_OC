$(document).ready(function () {
    $('.carousel').carousel({
        indicators: true,
    });
    setInterval(function () {
        $('.carousel').carousel('next');
    }, 5000)

    $('.prev').click(() => {
        $('.carousel').carousel('prev');
    })
    $('.next').click(() => {
        $('.carousel').carousel('next');
    })

    $('.sidenav').sidenav();
    $('.tooltipped').tooltip();
    $('select').formSelect();
});