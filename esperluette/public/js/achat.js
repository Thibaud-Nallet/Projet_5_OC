$(document).ready(function () {

    $('.formAdress').hide();

    $('.liv').click(() => {

        $('.formAdress').toggle(() => {
            $(this).show();
        }, () => {
            $(this).hide();
        });

        $('.renseignement').toggle(() => {
            $(this).show();
        }, () => {
            $(this).hide();
        });

        $('.choix').toggle(() => {
            $(this).hide();
        }, () => {
            $(this).show();
        });

        $('.retrait').toggle(() => {
            $(this).hide();
        }, () => {
            $(this).show();
        });
    });

    $('.ret').click(() => {
        $('.livre').toggle(() => {
            $(this).hide();
        }, () => {
            $(this).show();
        });
    });

});