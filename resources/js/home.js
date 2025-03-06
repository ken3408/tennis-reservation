$(document).ready(function() {
    var modal = $('#confirm-modal');
    var reserveButtons = $('.btn-primary.btn-full');
    var cancelButton = $('#cancel-button');

    reserveButtons.on('click', function() {
        modal.show();
    });

    cancelButton.on('click', function() {
        modal.hide();
    });

    $(window).on('click', function(event) {
        if ($(event.target).is(modal)) {
            modal.hide();
        }
    });
});
