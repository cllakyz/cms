<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yeni Portfolyo Ekle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <?php
                if(empty($categories)){ ?>
                    <div class="alert alert-info text-center">
                        <p>Yeni portfolyo ekleyebilmeniz için portfolyo kategorisi eklemeniz gerekmektedir. Eklemek için <a href="<?php echo base_url('portfolio_category/new_form'); ?>">tıklayınız</a></p>
                    </div>
                <?php
                } else{ ?>
                    <form action="<?php echo base_url('portfolio/save'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Başlık</label>
                                    <input type="text" name="title" class="form-control" placeholder="Başlık" value="<?php echo isset($form_error) ? set_value("title") : NULL; ?>">
                                    <?php
                                    if(isset($form_error)){ ?>
                                        <span class="pull-right input-form-errors"><?php echo form_error('title'); ?></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="category_id" class="form-control">
                                        <?php
                                        foreach ($categories as $category){ ?>
                                            <option<?php echo isset($form_error) && set_value("title") == $category->id ? ' selected' : NULL; ?> value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bitirme Tarihi</label>
                                    <input type="hidden" name="finishedAt" class="form-control" data-plugin="datetimepicker" data-options="{ inline: true, format: 'DD/MM/YYYY HH:mm:ss' }" value="<?php echo isset($form_error) ? set_value("finishedAt") : NULL; ?>">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group">
                                        <label>Müşteri</label>
                                        <input type="text" name="client" class="form-control" placeholder="Müşteri" value="<?php echo isset($form_error) ? set_value("client") : NULL; ?>">
                                        <?php
                                        if(isset($form_error)){ ?>
                                            <span class="pull-right input-form-errors"><?php echo form_error('client'); ?></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Yer/Mekan</label>
                                        <input type="text" name="place" class="form-control" placeholder="Yer/Mekan" value="<?php echo isset($form_error) ? set_value("place") : NULL; ?>">
                                        <?php
                                        if(isset($form_error)){ ?>
                                            <span class="pull-right input-form-errors"><?php echo form_error('place'); ?></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Yapılan İşin Bağlantısı (URL)</label>
                                        <input type="text" name="portfolio_url" class="form-control" placeholder="Portfolyo URL" value="<?php echo isset($form_error) ? set_value("portfolio_url") : NULL; ?>">
                                        <?php
                                        if(isset($form_error)){ ?>
                                            <span class="pull-right input-form-errors"><?php echo form_error('portfolio_url'); ?></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 150}"><?php echo isset($form_error) ? set_value("description") : NULL; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                        <a href="<?php echo base_url('portfolio'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>