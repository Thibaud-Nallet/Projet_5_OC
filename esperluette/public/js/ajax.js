$.ajax({
    url: '/littlepanier', // La ressource ciblée
    type: 'GET', // Le type de la requête HTTP

    dataType: 'html', // Le type de données à recevoir, ici, du HTML.
    success: function (code_html, statut) {
        $("#panier").html(code_html);
    }
});

$.ajax({
    url: '/sidenav', // La ressource ciblée
    type: 'GET', // Le type de la requête HTTP

    dataType: 'html', // Le type de données à recevoir, ici, du HTML.
    success: function (code_html, statut) {
        $(".category").html(code_html);
    }
});

$.ajax({
    url: '/cartConnect', // La ressource ciblée
    type: 'GET', // Le type de la requête HTTP

    dataType: 'html', // Le type de données à recevoir, ici, du HTML.
    success: function (code_html, statut) {
        $("#cartConnect").html(code_html);
    }
});


