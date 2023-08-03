// this module is for helping server side rendered ui

// grab tooltip data on class button-action. (button-action is my custom class name)
let elmTooltip = {
    store: function () {
        $('.btn-action').ready(function (e) {
            var tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]')
            );
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    },
    remove: function () {
        $('.tooltip').remove();
        // $('.tooltip').removeClass('show');
    },
};

// ajax complete
$(document).ajaxComplete(function () {
    elmTooltip.store();
});

// ajax start
$(document).ajaxStart(function () {
    elmTooltip.remove();
});

