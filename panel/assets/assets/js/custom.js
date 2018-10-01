$(document).ready(function () {
    /* silme işlemi */
    $(document).on('click', '.remove-btn', function (e) {
        e.preventDefault();
        var thisEl = $(this);
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
                window.location.href = url;
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

            });
        }
    });

    /* Sıralama */
    $('.sortable').sortable();

    $('.sortable').on('sortupdate', function (event, ui) {
        var data = $(this).sortable('serialize');
        var url = $(this).attr('data-url');

        if(typeof url !== "undefined"){
            $.post(url, {data: data}, function (data) {

            });
        }
    });

    /* dropzone */
    var uploadSection = Dropzone.forElement("#prd-img-dropzone");

    uploadSection.on('complete', function () {
        var url = $('#prd-img-dropzone').attr('data-url');
        $.post(url, {status: status}, function (data) {
            $('.image_list_container').html(data);
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
                $('.image_list_container').html(data);
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
});