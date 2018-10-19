<div id="back-to-home">
    <a href="<?php echo base_url(); ?>" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>
<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="index.html">
            <span><i class="fa fa-gg"></i></span>
            <span>CMS</span>
        </a>
    </div>
    <div class="simple-page-form animated flipInY" id="reset-password-form">
        <h4 class="form-title m-b-xl text-center">Şifrenizi mi unuttunuz ?</h4>
        <form action="<?php echo base_url('reset-password'); ?>" method="post">
            <div class="form-group">
                <input id="reset-password-email" name="email" type="email" class="form-control" placeholder="E-Posta Adresini Giriniz" value="<?php echo isset($form_error) ? set_value("email") : NULL; ?>">
                <?php
                if(isset($form_error)){ ?>
                    <span class="pull-right input-form-errors"><?php echo form_error('email'); ?></span>
                    <?php
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Şifre Sıfırla</button>
        </form>
    </div>
</div>