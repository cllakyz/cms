<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yeni Haber Ekle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('news/save'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" name="title" class="form-control" placeholder="Başlık">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('title'); ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>

                    <?php
                    if(isset($form_error)){
                        if($news_type == 1){
                            $image_class = NULL;
                            $video_class = ' hidden';
                            $image_selected = ' selected';
                            $video_selected = NULL;
                        } else{
                            $image_class = ' hidden';
                            $video_class = NULL;
                            $image_selected = NULL;
                            $video_selected = ' selected';
                        }
                    } else{
                        $image_class = NULL;
                        $video_class = ' hidden';
                        $image_selected = ' selected';
                        $video_selected = NULL;
                    }
                    ?>

                    <div class="form-group">
                        <label>Haber Türü</label>
                        <select name="news_type" class="form-control news-type">
                            <option<?php echo $image_selected; ?> value="1">Resim</option>
                            <option<?php echo $video_selected; ?> value="2">Video</option>
                        </select>
                    </div>

                    <div class="form-group image-container<?php echo $image_class; ?>">
                        <label>Görsel Seçiniz</label>
                        <input type="file" name="img_url" class="form-control">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('img_url'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group video-container<?php echo $video_class; ?>">
                        <label>Video URL</label>
                        <input type="text" name="video_url" class="form-control" placeholder="Video Bağlantısını Buraya Giriniz">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('video_url'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url('news'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>