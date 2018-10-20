<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Site Ayarı Düzenle</h4>
    </div>
    <div class="col-md-12">
        <form action="<?php echo base_url('setting/edit/'.$item->id); ?>" method="post" enctype="multipart/form-data">
            <div class="widget">
                <div class="m-b-lg nav-tabs-horizontal">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Site Bilgileri</a></li>
                        <li role="presentation"><a href="#tab-6" aria-controls="tab-6" role="tab" data-toggle="tab">Adres Bilgisi</a></li>
                        <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Hakkımızda</a></li>
                        <li role="presentation"><a href="#tab-3"  aria-controls="tab-3" role="tab" data-toggle="tab">Misyon</a></li>
                        <li role="presentation"><a href="#tab-4"  aria-controls="tab-4" role="tab" data-toggle="tab">Vizyon</a></li>
                        <li role="presentation"><a href="#tab-5"  aria-controls="tab-5" role="tab" data-toggle="tab">Sosyal Medya</a></li>
                        <li role="presentation"><a href="#tab-7"  aria-controls="tab-7" role="tab" data-toggle="tab">Logo</a></li>
                    </ul>

                    <div class="tab-content p-md">
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

                        <div role="tabpanel" class="tab-pane fade" id="tab-6">
                            <div class="form-group">
                                <label>Adres Bilgisi</label>
                                <textarea name="address" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("address") : $item->address; ?></textarea>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab-2">
                            <div class="form-group">
                                <label>Hakkımızda</label>
                                <textarea name="about_us" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("about_us") : $item->about_us; ?></textarea>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab-3">
                            <div class="form-group">
                                <label>Misyon</label>
                                <textarea name="mission" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("mission") : $item->mission; ?></textarea>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab-4">
                            <div class="form-group">
                                <label>Vizyon</label>
                                <textarea name="vision" class="m-0" data-plugin="summernote" data-options="{height: 200}"><?php echo isset($form_error) ? set_value("vision") : $item->vision; ?></textarea>
                            </div>
                        </div>

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

                        <div role="tabpanel" class="tab-pane fade" id="tab-7">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="<?php echo base_url("uploads/$viewFolder/$item->logo"); ?>" alt="<?php echo $item->company_name; ?>" class="img-responsive">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Görsel Seçiniz</label>
                                    <input type="hidden" name="old_logo" value="<?php echo $item->logo; ?>">
                                    <input type="file" name="logo" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-md">Kaydet</button>
            <a href="<?php echo base_url('setting'); ?>" class="btn btn-md btn-danger">İptal</a>
        </form>
    </div>
</div>