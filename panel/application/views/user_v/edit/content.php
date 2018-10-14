<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Referans Düzenle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('reference/edit/'.$item->id); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" name="title" class="form-control" placeholder="Başlık" value="<?php echo $item->title; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('title'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 150}"><?php echo $item->description; ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-1">
                            <img src="<?php echo base_url('uploads/'.$viewFolder.'/'.$item->img_url); ?>" alt="<?php echo $item->img_url; ?>" class="img-responsive">
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
                    <a href="<?php echo base_url('reference'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>