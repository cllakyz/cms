<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yeni Video Ekle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('gallery/gallery_video_save/'.$gallery_id); ?>" method="post">
                    <div class="form-group">
                        <label>Video URL</label>
                        <input type="text" name="url" class="form-control" placeholder="Video linkini giriniz">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('url'); ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url('gallery/gallery_video_list/'.$gallery_id); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>