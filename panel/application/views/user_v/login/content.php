<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="index.html">
            <span><i class="fa fa-gg"></i></span>
            <span>CMS</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">Bilgileriniz İle CMS'e Giriş Yapın</h4>
        <form action="<?php echo base_url('userop/do_login'); ?>" method="post">
            <div class="form-group">
                <input type="text" name="user_email" class="form-control" placeholder="E-Posta veya Kullanıcı Adı" value="<?php echo isset($form_error) ? set_value("user_email") : NULL; ?>">
                <?php
                if(isset($form_error)){ ?>
                    <span class="pull-right input-form-errors"><?php echo form_error('user_email'); ?></span>
                    <?php
                }
                ?>
            </div>

            <div class="form-group">
                <input type="password" name="user_password" class="form-control" placeholder="Şifre" value="<?php echo isset($form_error) ? set_value("user_password") : NULL; ?>">
                <?php
                if(isset($form_error)){ ?>
                    <span class="pull-right input-form-errors"><?php echo form_error('user_password'); ?></span>
                    <?php
                }
                ?>
            </div>

            <div class="form-group m-b-xl">
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" name="remember_me" value="1" checked/>
                    <label>Beni Hatırla</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Giriş Yap</button>
        </form>
    </div>

    <div class="simple-page-footer">
        <p><a href="password-forget.html">Şifremi Unuttum ?</a></p>
    </div>
</div>