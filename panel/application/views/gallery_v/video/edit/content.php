<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Video Düzenle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('gallery/gallery_video_edit/'.$item->id.'/'.$item->gallery_id); ?>" method="post">
                    <div class="form-group">
                        <label>Video URL</label>
                        <input type="text" name="url" class="form-control" placeholder="Video url giriniz" value="<?php echo isset($form_error) ? set_value("url") : $item->url; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('url'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?php echo base_url('gallery/gallery_video_list/'.$item->gallery_id); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>