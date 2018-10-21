<div role="tabpanel" class="tab-pane fade" id="tab-5">
    <div class="row">
        <div class="form-group col-md-6">
            <label>Facebook</label>
            <input type="text" name="facebook" class="form-control" placeholder="Facebook adresinizi giriniz" value="<?php echo isset($form_error) ? set_value("facebook") : $item->facebook; ?>">
        </div>
        <div class="form-group col-md-6">
            <label>Twitter</label>
            <input type="text" name="twitter" class="form-control" placeholder="Twitter adresinizi giriniz" value="<?php echo isset($form_error) ? set_value("twitter") : $item->twitter; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Instagram</label>
            <input type="text" name="instagram" class="form-control" placeholder="Instagram adresinizi giriniz" value="<?php echo isset($form_error) ? set_value("instagram") : $item->instagram; ?>">
        </div>
        <div class="form-group col-md-6">
            <label>Linkedin</label>
            <input type="text" name="linkedin" class="form-control" placeholder="Linkedin adresinizi giriniz" value="<?php echo isset($form_error) ? set_value("linkedin") : $item->linkedin; ?>">
        </div>
    </div>
</div>