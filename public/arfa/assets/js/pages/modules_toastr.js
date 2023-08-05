const modules_toastr = {
    //
    notif: function (title = '', message = '', type = '') {
        let dataToast = {
            title: title,
            message: message,
            position: 'topRight',
            transitionIn: 'fadeInDown',
        };
        switch (type) {
            case 'show':
                iziToast.show(dataToast);
                break;
            case 'success':
                iziToast.success(dataToast);
                break;
            case 'info':
                iziToast.info(dataToast);
                break;
            case 'warning':
                iziToast.warning(dataToast);
                break;
            case 'error':
                iziToast.error(dataToast);
                break;
            default:
                dataToast.type = 'show';
                iziToast.show(dataToast);
                break;
        }
    },
};

