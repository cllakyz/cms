<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Marka Düzenle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('testimonial/edit/'.$item->id); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ad Soyad</label>
                                <input type="text" name="full_name" class="form-control" placeholder="Ad Soyad" value="<?php echo isset($form_error) ? set_value("full_name") : $item->full_name; ?>">
                                <?php
                                if(isset($form_error)){ ?>
                                    <span class="pull-right input-form-errors"><?php echo form_error('full_name'); ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Şirket Adı</label>
                                <input type="text" name="company" class="form-control" placeholder="Şirket Adı" value="<?php echo isset($form_error) ? set_value("company") : $item->company; ?>">
                                <?php
                                if(isset($form_error)){ ?>
                                    <span class="pull-right input-form-errors"><?php echo form_error('company'); ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

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
                        <label>Mesaj</label>
                        <textarea name="description" class="form-control no-resize" placeholder="Mesajınızı Yazınız"><?php echo isset($form_error) ? set_value("description") : $item->description; ?></textarea>
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('description'); ?></span>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-1">
                            <img src="<?php echo get_media($viewFolder, $item->img_url, "90x90"); ?>" alt="<?php echo $item->img_url; ?>" class="img-responsive">
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
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?php echo base_url('testimonial'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>