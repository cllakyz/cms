$(document).ready(function () {
    $(document).on('click', '.remove-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
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
});