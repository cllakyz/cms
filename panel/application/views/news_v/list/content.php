<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Haber Listesi
            <a href="<?php echo base_url('news/new_form'); ?>" class="btn btn-outline btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php
            if(empty($items)){ ?>
                <div class="alert alert-info text-center">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Herhangi bir veri bulunmamaktadır. Eklemek için <a href="<?php echo base_url('news/new_form'); ?>">tıklayınız</a></p>
                </div>
            <?php
            } else{ ?>
                <table class="table table-hover table-striped table-bordered content-table">
                    <thead>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="w50 text-center">#ID</th>
                    <th>Başlık</th>
                    <th>URL</th>
                    <?php /*<th>Açıklama</th> */ ?>
                    <th class="text-center">Haber Türü</th>
                    <th class="text-center">Görsel</th>
                    <th class="text-center">Durum</th>
                    <th class="text-center">İşlem</th>
                    </thead>
                    <tbody class="sortable" data-url="<?php echo base_url('news/sort'); ?>">
                        <?php
                        foreach($items as $item){ ?>
                            <tr id="sort-<?php echo $item->id; ?>">
                                <td class="order"><i class="fa fa-reorder"></i></td>
                                <td class="w50 text-center"><?php echo $item->id; ?></td>
                                <td><?php echo $item->title; ?></td>
                                <td><?php echo $item->url; ?></td>
                                <?php /*<td><?php echo $item->description; ?></td> */ ?>
                                <td class="text-center w100"><?php echo $item->news_type == 1 ? 'Image' : 'Video'; ?></td>
                                <td class="text-center w100">
                                    <?php
                                    if($item->news_type == 1){ ?>
                                        <img width="75" src="<?php echo get_media($viewFolder, $item->img_url, "513x289"); ?>" alt="" class="img-rounded">
                                    <?php
                                    } elseif($item->news_type == 2){ ?>
                                        <iframe width="75" src="<?php echo $item->video_url; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    <?php
                                    } else{
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td class="text-center w100">
                                    <input type="checkbox" class="change-item-status" data-url="<?php echo base_url('news/change_status/'.$item->id); ?>" data-switchery data-color="#10c469"<?php echo $item->isActive == 1 ? ' checked' : NULL; ?> />
                                </td>
                                <td class="text-center w200">
                                    <a data-url="<?php echo base_url('news/delete/'.$item->id); ?>" class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</a>
                                    <a href="<?php echo base_url('news/edit_form/'.$item->id); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
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