// this module is for helping server side rendered ui

const elementUIServerside = {
    /**
     * Loading button custom funtion jQuery: buttonCustomJQuery
     * const elmButton = $(.classSelectorButton)
     * #START LOADING WITH CUSTOM MSG
     * elmButton.button('loading');
     * #RESET LOADING WITH CUSTOM MSG
     * elmButton.button('reset');
     * */
    buttonCustomJQuery: function () {
        (function ($) {
            const dataLoadingIcon = `<i class="spinner-border spinner-border-sm align-middle"></i>`;
            const dataLoadingText = '&nbsp;Proses...';
            $.fn.button = function (action) {
                if (action === 'loading') {
                    /**
                     * [1] akan menyimpan value html dari button, biasanya berupa text "Simpan"|"Edit"|"Ubah"|<i>, kedalam dataset dengan key "original-text"
                     * [2] setelah itu,inject element dataLoadingIcon (berupa span) ke dalam element html <button></button>
                     * [3] menambah attribut "disableb"
                     */
                    let dataLoadingFix;

                    // cek apakah button punya text ?... jika tidak punya text, berarti button tersebut hanya memiliki icon
                    if (this[0].innerText.length > 0) {
                        dataLoadingFix = dataLoadingIcon + dataLoadingText;
                    } else {
                        dataLoadingFix = dataLoadingIcon;
                    }
                    this.data('original-text', this.html())
                        .html(dataLoadingFix)
                        .prop('disabled', true);
                }
                if (action === 'reset' && this.data('original-text')) {
                    /**
                     * [1] akan mereplace html button (element yang ada didalam tag <button>) dengan detaset original-text yang telah disimpan pada proses "loading"
                     * [2] menghapus attribut "disable"
                     */
                    this.html(this.data('original-text')).prop('disabled', false);
                }
            };
            // console.log(`elementUIServerside.custombuttonJQuery: JALAN!!!`);
        })(jQuery);
    },
};
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

// jika ajaxEror dan status = 401 (unauthorize) maka redirect ke halaman login
$(document).ajaxError(function (event, jqXHR, ajaxOptions) {
    if (jqXHR.status === 401) {
        window.location.href = '/login';
    }
});

