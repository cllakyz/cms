<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yeni Kullanıcı Ekle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('user/save'); ?>" method="post">
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input type="text" name="user_name" class="form-control" placeholder="Kullanıcı adını giriniz" value="<?php echo isset($form_error) ? set_value("user_name") : NULL; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('user_name'); ?></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <input type="text" name="full_name" class="form-control" placeholder="Ad soyad giriniz" value="<?php echo isset($form_error) ? set_value("full_name") : NULL; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('full_name'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>E-Posta Adresi</label>
                        <input type="email" name="email" class="form-control" placeholder="E-posta adresini giriniz" value="<?php echo isset($form_error) ? set_value("email") : NULL; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('email'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Yetki Grubu</label>
                        <select name="user_role" class="form-control">
                            <?php
                            foreach ($user_roles as $role){ ?>
                                <option<?php echo isset($form_error) && set_value("user_role") == $role->id ? ' selected' : NULL; ?> value="<?php echo $role->id; ?>"><?php echo $role->title; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('category_id'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Şifre</label>
                        <input type="password" name="password" class="form-control" placeholder="Şifre giriniz">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('password'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Şifre Tekrar</label>
                        <input type="password" name="re_password" class="form-control" placeholder="Şifreyi tekrar giriniz">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('re_password'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url('user'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>