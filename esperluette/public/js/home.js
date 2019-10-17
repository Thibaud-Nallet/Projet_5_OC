$(document).ready(function () {
    $('.carousel').carousel({
        indicators: true,
    });
    setInterval(function () {
        $('.carousel').carousel('next');
    }, 3000);
});

$.ajax({
    url: '/cartConnect', // La ressource ciblée
    type: 'GET', // Le type de la requête HTTP

    dataType: 'html', // Le type de données à recevoir, ici, du HTML.
    success: function (code_html, statut) {
        $("#cartConnect").html(code_html);
    }
});
