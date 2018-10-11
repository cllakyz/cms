<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yeni Eğitim Ekle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('course/save'); ?>" method="post" enctype="multipart/form-data">
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
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 150}"></textarea>
                    </div>

                    <div class="form-group" style="position: relative;">
                        <label>Eğitim Tarihi</label>
                        <input type="text" name="event_date" class="form-control" data-plugin="datetimepicker" data-options="{ format: 'DD/MM/YYYY HH:mm:ss' }">
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
                    <a href="<?php echo base_url('course'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>