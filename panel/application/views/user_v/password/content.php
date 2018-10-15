<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Şifre Değiştir</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('user/edit_password/'.$item->id); ?>" method="post">
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