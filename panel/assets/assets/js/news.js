$(document).ready(function () {
    $(document).on('change', '.news-type', function () {
        var thisEl = $(this);
        if(thisEl.val() == 1){
            $('.image-container').removeClass('hidden');
            $('.video-container').addClass('hidden');
        } else if(thisEl.val() == 2){
            $('.image-container').addClass('hidden');
            $('.video-container').removeClass('hidden');
        } else{
            return false;
        }
    });
});