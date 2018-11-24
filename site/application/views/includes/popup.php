<?php
$popup = getPopupService($viewFolder);
if($popup){
    $popup_cookie = get_cookie($popup->popup_unique_id);
    if($popup_cookie != "true"){ ?>
        <div class="modal fade" id="popup_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Kapat</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $popup->title; ?></h4>
                    </div>
                    <div class="modal-body"><?php echo $popup->description; ?></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Kapat</button>
                        <button
                            type="button"
                            class="btn btn-sm btn-default dontShowAgainBtn"
                            data-dismiss="modal"
                            data-url="<?php echo base_url("bir-daha-gosterme"); ?>"
                            data-popup-id="<?php echo $popup->popup_unique_id; ?>"
                            data-csrf-token="<?php echo $this->security->get_csrf_token_name(); ?>"
                            data-csrf-value="<?php echo $this->security->get_csrf_hash(); ?>">Tekrar Gösterme</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#popup_modal').modal("show");
            });
        </script>
    <?php
    }
}
?>