<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Slayt Düzenle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('slide/edit/'.$item->id); ?>" method="post" enctype="multipart/form-data">
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
                    
                    <div class="row">
                        <div class="form-group col-md-1">
                            <img src="<?php echo get_media($viewFolder, $item->img_url, "1920x650"); ?>" alt="<?php echo $item->img_url; ?>" class="img-responsive">
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

                    <div class="form-group">
                        <label>Buton Kullanımı</label><br>
                        <input type="checkbox" name="allowBtn" class="btn_usage" data-switchery data-color="#10c469"<?php echo $item->allowButton == 1 ? ' checked' : NULL; ?> />
                    </div>

                    <div class="button-information-container" style="display: <?php echo $item->allowButton == 1 ? 'block' : 'none'; ?>">
                        <div class="form-group">
                            <label>Buton Başlık</label>
                            <input type="text" name="button_caption" class="form-control" placeholder="Buton başlığını giriniz" value="<?php echo isset($form_error) ? set_value("button_caption") : $item->button_caption; ?>">
                            <?php
                            if(isset($form_error)){ ?>
                                <span class="pull-right input-form-errors"><?php echo form_error('button_caption'); ?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Buton URL</label>
                            <input type="text" name="button_url" class="form-control" placeholder="Buton bağlantısını giriniz" value="<?php echo isset($form_error) ? set_value("button_url") : $item->button_url; ?>">
                            <?php
                            if(isset($form_error)){ ?>
                                <span class="pull-right input-form-errors"><?php echo form_error('button_url'); ?></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?php echo base_url('slide'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>