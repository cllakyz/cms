<div role="tabpanel" class="tab-pane fade" id="tab-7">
    <div class="row">
        <div class="col-md-2">
            <img src="<?php echo get_media($viewFolder, $item->logo, "300x70"); ?>" alt="<?php echo $item->company_name; ?>" class="img-responsive logo-img">
        </div>
        <div class="form-group col-md-6">
            <label>Logo Seçiniz</label>
            <input type="hidden" name="old_logo" value="<?php echo $item->logo; ?>">
            <input type="file" name="logo" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <img src="<?php echo get_media($viewFolder, $item->logo_mobile, "150x35"); ?>" alt="<?php echo $item->company_name; ?>" class="img-responsive logo-img">
        </div>
        <div class="form-group col-md-6">
            <label>Mobil Logo Seçiniz</label>
            <input type="hidden" name="old_logo_mobile" value="<?php echo $item->logo_mobile; ?>">
            <input type="file" name="logo_mobile" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <img src="<?php echo get_media($viewFolder, $item->favicon, "32x32"); ?>" alt="<?php echo $item->company_name; ?>" class="img-responsive logo-img">
        </div>
        <div class="form-group col-md-6">
            <label>Favicon Seçiniz</label>
            <input type="hidden" name="old_favicon" value="<?php echo $item->favicon; ?>">
            <input type="file" name="favicon" class="form-control">
        </div>
    </div>
</div>