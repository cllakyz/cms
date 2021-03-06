<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">E-Mail Ayar Düzenle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('email/edit/'.$item->id); ?>" method="post">
                    <div class="form-group">
                        <label>Protokol</label>
                        <input type="text" name="protocol" class="form-control" placeholder="Protokol" value="<?php echo isset($form_error) ? set_value("protocol") : $item->protocol; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('protocol'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>E-Posta Sunucu Bilgisi</label>
                        <input type="text" name="host" class="form-control" placeholder="Hostname" value="<?php echo isset($form_error) ? set_value("host") : $item->host; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('host'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Port Numarası</label>
                        <input type="text" name="port" class="form-control" placeholder="Port Numarası" value="<?php echo isset($form_error) ? set_value("port") : $item->port; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('port'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>E-Posta Adresi (User)</label>
                        <input type="email" name="user" class="form-control" placeholder="User" value="<?php echo isset($form_error) ? set_value("user") : $item->user; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('user'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>E-Posta Adresine Ait Şifre</label>
                        <input type="password" name="password" class="form-control" placeholder="Şifre" value="<?php echo isset($form_error) ? set_value("password") : $item->password; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('password'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Kimden Gidecek (From)</label>
                        <input type="email" name="from" class="form-control" placeholder="From" value="<?php echo isset($form_error) ? set_value("from") : $item->from; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('from'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Kime Gidecek (To)</label>
                        <input type="email" name="to" class="form-control" placeholder="To" value="<?php echo isset($form_error) ? set_value("to") : $item->to; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('to'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>E-Posta Başlık</label>
                        <input type="text" name="user_name" class="form-control" placeholder="Başlık" value="<?php echo isset($form_error) ? set_value("user_name") : $item->user_name; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('user_name'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?php echo base_url('email'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>