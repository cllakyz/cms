<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Haber Düzenle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('news/edit/'.$item->id); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" name="title" class="form-control" placeholder="Başlık" value="<?php echo isset($form_error) ? set_value("title") : $item->title; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('title'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 150}"><?php echo isset($form_error) ? set_value("description") : $item->description; ?></textarea>
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
                        if($item->news_type == 1){
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
                    }
                    ?>

                    <div class="form-group">
                        <label>Haber Türü</label>
                        <select name="news_type" class="form-control news-type">
                            <option<?php echo $image_selected; ?> value="1">Resim</option>
                            <option<?php echo $video_selected; ?> value="2">Video</option>
                        </select>
                    </div>
                    
                    <div class="row image-container<?php echo $image_class; ?>">
                        <div class="form-group col-md-1">
                            <img src="<?php echo get_media($viewFolder, $item->img_url, "513x289"); ?>" alt="<?php echo $item->img_url; ?>" class="img-responsive">
                        </div>
                        <div class="form-group col-md-11">
                            <label>Görsel Seçiniz</label>
                            <input type="hidden" name="old_img_url" value="<?php echo $item->img_url; ?>">
                            <input type="file" name="img_url" class="form-control">
                            <?php
                            if(isset($form_error)){ ?>
                                <span class="pull-right input-form-errors"><?php echo form_error('img_url'); ?></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group video-container<?php echo $video_class; ?>">
                        <label>Video URL</label>
                        <input type="text" name="video_url" class="form-control" placeholder="Video Bağlantısını Buraya Giriniz" value="<?php echo isset($form_error) ? set_value("video_url") : $item->video_url; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('video_url'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?php echo base_url('news'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>