<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yeni Site Ayarı Ekle</h4>
    </div>
    <div class="col-md-12">
        <form action="<?php echo base_url('user/save'); ?>" method="post">
            <div class="widget">
                <div class="m-b-lg nav-tabs-horizontal">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Site Bilgileri</a></li>
                        <li role="presentation"><a href="#tab-6" aria-controls="tab-6" role="tab" data-toggle="tab">Adres Bilgisi</a></li>
                        <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Hakkımızda</a></li>
                        <li role="presentation"><a href="#tab-3"  aria-controls="tab-3" role="tab" data-toggle="tab">Misyon</a></li>
                        <li role="presentation"><a href="#tab-4"  aria-controls="tab-4" role="tab" data-toggle="tab">Vizyon</a></li>
                        <li role="presentation"><a href="#tab-5"  aria-controls="tab-5" role="tab" data-toggle="tab">Sosyal Medya</a></li>
                    </ul>

                    <div class="tab-content p-md">
                        <div role="tabpanel" class="tab-pane in active fade" id="tab-1">
                            <div class="form-group">
                                <label>Şirket Adı</label>
                                <input type="text" name="company_name" class="form-control" placeholder="Şirketinizin yada sitenizin adını giriniz" value="<?php echo isset($form_error) ? set_value("company_name") : NULL; ?>">
                                <?php
                                if(isset($form_error)){ ?>
                                    <span class="pull-right input-form-errors"><?php echo form_error('company_name'); ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Telefon 1</label>
                                    <input type="text" name="phone_1" class="form-control" placeholder="Telefon numaranızı giriniz" value="<?php echo isset($form_error) ? set_value("phone_1") : NULL; ?>">
                                    <?php
                                    if(isset($form_error)){ ?>
                                        <span class="pull-right input-form-errors"><?php echo form_error('phone_1'); ?></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Telefon 2</label>
                                    <input type="text" name="phone_2" class="form-control" placeholder="Diğer telefon numaranızı giriniz" value="<?php echo isset($form_error) ? set_value("phone_2") : NULL; ?>">
                                    <?php
                                    if(isset($form_error)){ ?>
                                        <span class="pull-right input-form-errors"><?php echo form_error('phone_2'); ?></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Fax 1</label>
                                    <input type="text" name="fax_1" class="form-control" placeholder="Fax numaranızı giriniz" value="<?php echo isset($form_error) ? set_value("fax_1") : NULL; ?>">
                                    <?php
                                    if(isset($form_error)){ ?>
                                        <span class="pull-right input-form-errors"><?php echo form_error('fax_1'); ?></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fax 2</label>
                                    <input type="text" name="fax_2" class="form-control" placeholder="Diğer fax numaranızı giriniz" value="<?php echo isset($form_error) ? set_value("fax_2") : NULL; ?>">
                                    <?php
                                    if(isset($form_error)){ ?>
                                        <span class="pull-right input-form-errors"><?php echo form_error('fax_2'); ?></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab-6">
                            <div class="form-group">
                                <label>Adres Bilgisi</label>
                                <textarea name="address" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("address") : NULL; ?></textarea>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab-2">
                            <div class="form-group">
                                <label>Hakkımızda</label>
                                <textarea name="about_us" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("about_us") : NULL; ?></textarea>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab-3">
                            <div class="form-group">
                                <label>Misyon</label>
                                <textarea name="mission" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("mission") : NULL; ?></textarea>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab-4">
                            <div class="form-group">
                                <label>Vizyon</label>
                                <textarea name="vision" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("vision") : NULL; ?></textarea>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab-5">
                            <h4 class="m-b-md">Third Tab Content</h4>
                            <p class="lh-lg">Lorem ipsum dolor sit amet. ipsum dolor sit amet, consectetur adipisicing elit. Officia illo aspernatur facilis, nisi commodi dolor?</p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-md">Kaydet</button>
            <a href="<?php echo base_url('user'); ?>" class="btn btn-md btn-danger">İptal</a>
        </form>
    </div>
</div>