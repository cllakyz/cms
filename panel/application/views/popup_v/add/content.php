<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yeni Popup Ekle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('popup/save'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Hedef Sayfa</label>
                        <select name="page" class="form-control">
                            <option value="">Seçiniz</option>
                            <?php
                            foreach(getPageList() as $page => $page_name){ ?>
                                <option<?php echo isset($form_error) && set_value("page") == $page ? " selected" : NULL; ?> value="<?php echo $page; ?>"><?php echo $page_name; ?></option>
                                <?php
                            }
                            ?>

                        </select>
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('page'); ?></span>
                            <?php
                        }
                        ?>
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
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 150}"><?php echo isset($form_error) ? set_value("description") : NULL; ?></textarea>
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('description'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url('popup'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>