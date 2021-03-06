<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Galeri Listesi
            <a href="<?php echo base_url('gallery/new_form'); ?>" class="btn btn-outline btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php
            if(empty($items)){ ?>
                <div class="alert alert-info text-center">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Herhangi bir veri bulunmamaktadır. Eklemek için <a href="<?php echo base_url('gallery/new_form'); ?>">tıklayınız</a></p>
                </div>
            <?php
            } else{ ?>
                <table class="table table-hover table-striped table-bordered content-table">
                    <thead>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="w50 text-center">#ID</th>
                    <th>Galeri Adı</th>
                    <th>Galeri Türü</th>
                    <th>Klasör Adı</th>
                    <th>URL</th>
                    <th class="text-center">Durum</th>
                    <th class="text-center">İşlem</th>
                    </thead>
                    <tbody class="sortable" data-url="<?php echo base_url('gallery/sort'); ?>">
                        <?php
                        foreach($items as $item){
                            if($item->gallery_type == 1){
                                $type = "Resim";
                                $button_icon = "image";
                                $href = 'gallery/upload_form/'.$item->id;
                            } elseif ($item->gallery_type == 2){
                                $type = "Video";
                                $button_icon = "play";
                                $href = 'gallery/gallery_video_list/'.$item->id;
                            } else{
                                $type = "Dosya";
                                $button_icon = "folder";
                                $href = 'gallery/upload_form/'.$item->id;
                            }
                            ?>
                            <tr id="sort-<?php echo $item->id; ?>">
                                <td class="order"><i class="fa fa-reorder"></i></td>
                                <td class="w50 text-center"><?php echo $item->id; ?></td>
                                <td class="text-center"><?php echo $item->gallery_name; ?></td>
                                <td class="text-center"><?php echo $type; ?></td>
                                <td class="text-center"><?php echo $item->folder_name; ?></td>
                                <td class="text-center"><?php echo $item->url; ?></td>
                                <td class="text-center w100">
                                    <input type="checkbox" class="change-item-status" data-url="<?php echo base_url('gallery/change_status/'.$item->id); ?>" data-switchery data-color="#10c469"<?php echo $item->isActive == 1 ? ' checked' : NULL; ?> />
                                </td>
                                <td class="text-center w300">
                                    <a data-url="<?php echo base_url('gallery/delete/'.$item->id); ?>" class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</a>
                                    <a href="<?php echo base_url('gallery/edit_form/'.$item->id); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <a href="<?php echo base_url($href); ?>" class="btn btn-sm btn-dark btn-outline"><i class="fa fa-<?php echo $button_icon; ?>"></i> Galeriye Gözat</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
</div>