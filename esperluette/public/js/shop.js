$(document).ready(function () {
    $('.carousel').carousel({
        indicators: true,
    });
    $('.prev').click(() => {
        $('.carousel').carousel('prev');
    })
    $('.next').click(() => {
        $('.carousel').carousel('next');
    })

    $('#product-image').click(() => {
        //Récupere le numéro des futurs champs
        const index = +$('#widgets-counter').val();
        console.log(index);
        //Recupere le prototype des entrées 
        const tmpl = $('#product_imagesShop').data('prototype').replace(/__name__/g, index);
        //J'injecte ce code dans la div 
        $('#product_imagesShop').append(tmpl);
        // Valeur de l'input +1
        $('#widgets-counter').val(index + 1);
        //Je gère le bouton supprimer
        handleDeleteButtons();
    })
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function () {
        const target = this.dataset.target;
        console.log(target);
        $(target).remove(alert("test"));
    });
}

function updateCompteur() {
    const count = +$('#product_imagesShop div.input-field').length;
    $('#widgets-counter').val(count);
}
updateCompteur();
handleDeleteButtons();