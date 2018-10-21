<div role="tabpanel" class="tab-pane in active fade" id="tab-1">
    <div class="row">
        <div class="form-group col-md-6">
            <label>Şirket Adı</label>
            <input type="text" name="company_name" class="form-control" placeholder="Şirketinizin yada sitenizin adını giriniz" value="<?php echo isset($form_error) ? set_value("company_name") : $item->company_name; ?>">
            <input type="hidden" name="old_company_name" value="<?php echo $item->company_name; ?>">
            <?php
            if(isset($form_error)){ ?>
                <span class="pull-right input-form-errors"><?php echo form_error('company_name'); ?></span>
                <?php
            }
            ?>
        </div>
        <div class="form-group col-md-6">
            <label>E-Posta Adresi</label>
            <input type="email" name="email" class="form-control" placeholder="Şirketinizin yada sitenizin e-posta adresini giriniz" value="<?php echo isset($form_error) ? set_value("email") : $item->email; ?>">
            <?php
            if(isset($form_error)){ ?>
                <span class="pull-right input-form-errors"><?php echo form_error('email'); ?></span>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Telefon 1</label>
            <input type="text" name="phone_1" class="form-control" placeholder="Telefon numaranızı giriniz" value="<?php echo isset($form_error) ? set_value("phone_1") : $item->phone_1; ?>">
            <?php
            if(isset($form_error)){ ?>
                <span class="pull-right input-form-errors"><?php echo form_error('phone_1'); ?></span>
                <?php
            }
            ?>
        </div>
        <div class="form-group col-md-6">
            <label>Telefon 2</label>
            <input type="text" name="phone_2" class="form-control" placeholder="Diğer telefon numaranızı giriniz" value="<?php echo isset($form_error) ? set_value("phone_2") : $item->phone_2; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Fax 1</label>
            <input type="text" name="fax_1" class="form-control" placeholder="Fax numaranızı giriniz" value="<?php echo isset($form_error) ? set_value("fax_1") : $item->fax_1; ?>">
        </div>
        <div class="form-group col-md-6">
            <label>Fax 2</label>
            <input type="text" name="fax_2" class="form-control" placeholder="Diğer fax numaranızı giriniz" value="<?php echo isset($form_error) ? set_value("fax_2") : $item->fax_2; ?>">
        </div>
    </div>
</div>