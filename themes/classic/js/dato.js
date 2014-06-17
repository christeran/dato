
$(document).ready(function() { 
$('a').tooltip();
$('.like-button').live('click', function(e) {
    var button = $(this)
    var datoID = $(this).attr('rel');
    $('.dislike' + datoID).removeClass('label-danger');
    $('.dislike' + datoID).addClass('label-dislike');
    button.removeClass('label-like');
    $.ajax({
        url: baseUrl + '/likeDato/like',
        type: 'POST',
        data: {
            dato_id: datoID,
            act: 'like'
        },
        success: function(count) {
            button.addClass('label-success');

        },
        error: function() {
            button.addClass('label-like');
            BootstrapDialog.show({
                title: 'El Dato',
                type: BootstrapDialog.INFO,
                message: 'Por favor inicie su session para poder votar.',
                cssClass: 'login-dialog',
                buttons: [{
                        label: 'Cerrar',
                        cssClass: 'btn-sm btn-primary',
                        action: function(dialog) {
                            dialog.close();
                        }
                    }]
            });
        }
    });
    return false;
});
$('.dislike-button').live('click', function(e) {
    var button = $(this)
    var datoID = $(this).attr('rel');
    $('.like' + datoID).removeClass('label-success');
    $('.like' + datoID).addClass('label-like');
    button.removeClass('label-dislike');
    $.ajax({
        url: baseUrl + '/likeDato/like',
        type: 'POST',
        data: {
            dato_id: datoID,
            act: 'dislike'
        },
        success: function(count) {
            button.addClass('label-danger');
        },
        error: function() {
            button.addClass('label-dislike');
            BootstrapDialog.show({
                title: 'El Dato',
                type: BootstrapDialog.INFO,
                message: 'Por favor inicie su session para poder votar.',
                cssClass: 'login-dialog',
                buttons: [{
                        label: 'Cerrar',
                        cssClass: 'btn-sm btn-primary',
                        action: function(dialog) {
                            dialog.close();
                        }
                    }]
            });
        }
    });
    return false;
});


//window.onresize = function() {
//    $(function() {
//        var $affixElement = $('div[data-spy="affix"]');
//        $affixElement.width($affixElement.parent().width());
//    });
//
//};
//
//$(function() {
//    var $affixElement = $('div[data-spy="affix"]');
//    $affixElement.width($affixElement.parent().width());
//});
//
//$(function() {       
//    $('#nav').affix({
//        offset: {  top: $('#nav').offset().top}
//    });
//});


});