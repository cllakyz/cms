<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yeni Galeri Ekle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('gallery/save'); ?>" method="post">
                    <div class="form-group">
                        <label>Galeri Adı</label>
                        <input type="text" name="gallery_name" class="form-control" placeholder="Galeri Adı" value="<?php echo isset($form_error) ? set_value("gallery_name") : NULL; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('gallery_name'); ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    if(isset($form_error)){
                        if($gallery_type == 1){
                            $image_selected = ' selected';
                            $video_selected = NULL;
                            $file_selected = NULL;
                        } elseif($gallery_type == 2){
                            $image_selected = NULL;
                            $video_selected = ' selected';
                            $file_selected = NULL;
                        } else{
                            $image_selected = NULL;
                            $video_selected = NULL;
                            $file_selected = ' selected';
                        }
                    } else{
                        $image_selected = ' selected';
                        $video_selected = NULL;
                        $file_selected = NULL;
                    }
                    ?>
                    <div class="form-group">
                        <label>Galeri Türü</label>
                        <select name="gallery_type" class="form-control">
                            <option<?php echo $image_selected; ?> value="1">Resim</option>
                            <option<?php echo $video_selected; ?> value="2">Video</option>
                            <option<?php echo $file_selected; ?> value="3">Dosya</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url('gallery'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>