$(document).ready(function() {
    var modal = $('#confirm-modal');
    var reserveButtons = $('.js-reservation-button');
    var cancelButton = $('#cancel-button');

    reserveButtons.on('click', function() {
        modal.fadeIn();
    });

    cancelButton.on('click', function() {
        modal.fadeOut();
    });

    $(window).on('click', function(event) {
        if ($(event.target).is(modal)) {
            modal.hide();
        }
    });
});
