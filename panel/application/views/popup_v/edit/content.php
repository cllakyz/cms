<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Popup Düzenle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('popup/edit/'.$item->id); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Hedef Sayfa</label>
                        <select name="page" class="form-control">
                            <option value="">Seçiniz</option>
                            <?php
                            foreach(getPageList() as $page => $page_name){
                                $selected = NULL;
                                if(isset($form_error)){
                                    if(set_value("page") == $page){
                                        $selected = " selected";
                                    }
                                } else{
                                    if($item->page == $page){
                                        $selected = " selected";
                                    }
                                }
                                ?>
                                <option<?php echo $selected; ?> value="<?php echo $page; ?>"><?php echo $page_name; ?></option>
                                <?php
                            }
                            ?>

                        </select>
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('page'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" name="title" class="form-control" placeholder="Başlık" value="<?php echo isset($form_error) ? set_value("title") : $item->title; ?>">
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('title'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo isset($form_error) ? set_value("description") : $item->description; ?></textarea>
                        <?php
                        if(isset($form_error)){ ?>
                            <span class="pull-right input-form-errors"><?php echo form_error('description'); ?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                    <a href="<?php echo base_url('popup'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>