$(document).ready(function () {
    if($('form').not('.login-form').length > 0){
        $('form').not('.login-form').attr('autocomplete', 'off');
    }
    /* silme işlemi */
    $(document).on('click', '.remove-btn', function (e) {
        e.preventDefault();
        var thisEl = $(this);
        var thisTable = thisEl.parents('.content-table tbody');
        var url = thisEl.attr('data-url');
        swal({
            title: 'Emin misiniz?',
            text: "Bu kaydı silmek istediğinize emin misiniz?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'İptal',
            confirmButtonText: 'Evet, Sil!'
        }).then((result) => {
            if (result.value) {
                $.post(url, {}, function (data) {
                    var alert = $.parseJSON(data);
                    notify(alert.type, alert.title, alert.message);
                    if(alert.type == 'success'){
                        if(thisTable.find('tr').length > 1){
                            thisEl.parents('tr').remove();
                        } else{
                            window.location.reload();
                        }
                    }
                });
            }
        })
    });

    /* durum değiştirme */
    $(document).on('change', '.change-item-status', function () {
        var thisEl = $(this);
        var url = thisEl.attr('data-url');
        var status;
        if(thisEl.is(':checked')){
            status = 1;
        } else{
            status = 0;
        }

        if(typeof status !== "undefined" && typeof url !== "undefined"){
            $.post(url, {status: status}, function (data) {
                var alert = $.parseJSON(data);
                notify(alert.type, alert.title, alert.message);
            });
        }
    });

    /* Sıralama */
    $('.sortable').sortable();

    $(document).on('sortupdate', '.sortable', function (event, ui) {
        var data = $(this).sortable('serialize');
        var url = $(this).attr('data-url');

        if(typeof url !== "undefined"){
            $.post(url, {data: data}, function (data) {
                var alert = $.parseJSON(data);
                notify(alert.type, alert.title, alert.message);
            });
        }
    });

    /* dropzone */
    var uploadSection = Dropzone.forElement("#prd-img-dropzone");

    uploadSection.on('complete', function (data, response) {
        var url = $('#prd-img-dropzone').attr('data-url');
        $.post(url, {}, function (data) {
            $('.image_list_container').html(data);
            $('.sortable').sortable();
            $('[data-switchery]').each(function(){
                var $this = $(this),
                    color = $this.attr('data-color') || '#188ae2',
                    jackColor = $this.attr('data-jackColor') || '#ffffff',
                    size = $this.attr('data-size') || 'default'

                new Switchery(this, {
                    color: color,
                    size: size,
                    jackColor: jackColor
                });
            });
        });
    });

    uploadSection.on('success', function (file, response) {
        var alert = $.parseJSON(response);
        notify(alert.type, alert.title, alert.message);
    });

    /* kapak fotoğrafı değiştirme */
    $(document).on('change', '.change-product-cover', function () {
        var thisEl = $(this);
        var url = thisEl.attr('data-url');
        var set_cover;
        if(thisEl.is(':checked')){
            set_cover = 1;
        } else{
            set_cover = 0;
        }

        if(typeof set_cover !== "undefined" && typeof url !== "undefined"){
            $.post(url, {set_cover: set_cover}, function (data) {
                var response = data.split('@@');
                var alert = $.parseJSON(response[0]);
                notify(alert.type, alert.title, alert.message);
                if(alert.type == 'success'){
                    $.post(base_url+'product/refresh_image_list/'+alert.prd_id, {}, function (data) {
                        $('.image_list_container').html(data);
                        $('.sortable').sortable();
                        $('[data-switchery]').each(function(){
                            var $this = $(this),
                                color = $this.attr('data-color') || '#188ae2',
                                jackColor = $this.attr('data-jackColor') || '#ffffff',
                                size = $this.attr('data-size') || 'default'

                            new Switchery(this, {
                                color: color,
                                size: size,
                                jackColor: jackColor
                            });
                        });
                    });
                }
            });
        }
    });
});