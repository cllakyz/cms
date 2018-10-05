function notify(type, title, message) {
    var options = {
        title: title,
        message: message,
        position: 'topCenter',
        timeout: 1500,
    };
    if(type == 'success'){
        iziToast.success(options);
    }else if(type == 'error'){
        iziToast.error(options);
    }else if(type == 'info'){
        iziToast.info(options);
    } else if(type == 'warning'){
        iziToast.warning(options);
    }
}