<div role="tabpanel" class="tab-pane fade" id="tab-8">
    <div class="form-group">
        <label>Referans Açıklama</label>
        <input type="text" name="homepage_reference" class="form-control" placeholder="Referanslar için açıklama yazısı giriniz" value="<?php echo isset($form_error) ? set_value("homepage_reference") : $item->homepage_reference; ?>">
        <?php
        if(isset($form_error)){ ?>
            <span class="pull-right input-form-errors"><?php echo form_error('homepage_reference'); ?></span>
            <?php
        }
        ?>
    </div>
</div>