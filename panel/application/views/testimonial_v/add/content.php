<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yeni Ziyaretçi Notu Ekle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('testimonial/save'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ad Soyad</label>
                                <input type="text" name="full_name" class="form-control" placeholder="Ad Soyad" value="<?php echo isset($form_error) ? set_value("full_name") : NULL; ?>">
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
                                <input type="text" name="company" class="form-control" placeholder="Şirket Adı" value="<?php echo isset($form_error) ? set_value("company") : NULL; ?>">
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
                        <input type="text" name="title" class="form-control" placeholder="Başlık" value="<?php echo isset($form_error) ? set_value("title") : NULL; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('title'); ?></span>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="form-group">
                        <label>Mesaj</label>
                        <textarea name="description" class="form-control no-resize" placeholder="Mesajınızı Yazınız"><?php echo isset($form_error) ? set_value("description") : NULL; ?></textarea>
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('description'); ?></span>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="form-group">
                        <label>Görsel Seçiniz</label>
                        <input type="file" name="img_url" class="form-control">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('img_url'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url('testimonial'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>