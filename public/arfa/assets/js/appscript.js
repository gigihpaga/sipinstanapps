/** Object Loader
 *
 * Hirarki DOM Loader
 * ```html
 * <div id="loader">
 *   <div class="loader-box-wrapper">
 *       <div class="loader-box-shadow"></div>
 *       <div class="loader-box"></div>
 *   </div>
 * </div>
 * ```
 * @returns HTMLDivElement
 */
const Loader = {
    create: function () {
        let divLoader = document.createElement('div');
        let divLoaderBoxWrapper = document.createElement('div');
        let divLoaderBoxShadow = document.createElement('div');
        let divLoaderBox = document.createElement('div');

        divLoader.setAttribute('id', 'loader');
        divLoader.setAttribute('class', 'loader--show');

        divLoaderBoxWrapper.setAttribute('class', 'loader-box-wrapper');
        divLoaderBoxShadow.setAttribute('class', 'loader-box-shadow');
        divLoaderBox.setAttribute('class', 'loader-box');

        divLoaderBoxWrapper.append(divLoaderBoxShadow);
        divLoaderBoxWrapper.append(divLoaderBox);

        divLoader.prepend(divLoaderBoxWrapper);

        return divLoader;
    },

    show: function () {
        const elmLoader = document.getElementById('loader');
        if (elmLoader) {
            elmLoader.remove();
        }
        document.body.prepend(this.create());
    },

    hide: function () {
        let elmLoader = document.getElementById('loader');
        if (elmLoader) {
            const checkShowClass = elmLoader.classList.value.includes('loader--show');
            if (checkShowClass) {
                elmLoader.classList.remove('loader--show');
            }
            elmLoader.classList.add('loader--hidden');
            elmLoader.addEventListener(
                'transitionend',
                function (event) {
                    event.stopPropagation();
                    event.target.remove();
                },
                {
                    once: true,
                }
            );
        }
    },
};

// ============ EVENT LISTENER ============

// event when no connection ofline
window.onoffline = () => modules_toastr.notif('Connection', 'Sedang offline', 'error');
// event when connection online
window.ononline = () => modules_toastr.notif('Connection', 'Kembali online', 'success');
// catch all error on windows (gak usah digunain malah errornya gak bisa di click haha)
// window.onerror = (a, b, c, d, e) => {
//     console.table({ message: a, source: b, lineno: c, colno: d, error: e });
//     return true;
// };

// [Loader] event when document html fully downloaded and parsed
window.addEventListener(
    'load',
    function (event) {
        Loader.hide();
    },
    {
        once: true,
    }
);

// [Loader] event for user click back or forward navigation browser
window.addEventListener('pageshow', (event) => Loader.hide());

// [Loader] event for user click link navigation on sidebar (metode delegation)
document.querySelector('#app .sidebar-content').addEventListener('click', function (e) {
    e.stopPropagation();
    let [a, ai, as] = ['a.link', 'a.link i', 'a.link span'];
    let elmANav = (selector) => e.target.matches(selector);
    if (elmANav(a) || elmANav(ai) || elmANav(as)) {
        Loader.show();
    }
});

