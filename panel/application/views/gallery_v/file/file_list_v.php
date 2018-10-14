<?php
if(empty($items)){ ?>
    <div class="alert alert-info text-center">
        <h5 class="alert-title">Kayıt Bulunamadı</h5>
        <p>Herhangi bir veri bulunmamaktadır. Eklemek için yukarıdaki alana tıklayınız.</p>
    </div>
    <?php
} else{ ?>
    <table class="table table-bordered table-striped table-hover content-table">
        <thead>
        <th class="order"><i class="fa fa-reorder"></i></th>
        <th class="w50 text-center">#ID</th>
        <th class="text-center">Görsel</th>
        <th>Dosya Yolu/Adı</th>
        <th class="text-center">Durumu</th>
        <th class="text-center">İşlem</th>
        </thead>
        <tbody class="sortable" data-url="<?php echo base_url('gallery/file_sort/'.$gallery_type); ?>">
        <?php
        foreach ($items as $item){ ?>
            <tr id="sort-<?php echo $item->id; ?>">
                <td class="order"><i class="fa fa-reorder"></i></td>
                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                <td class="w100 text-center">
                    <?php
                    if($gallery_type == 1){ ?>
                        <img width="30" src="<?php echo base_url($item->url); ?>" alt="<?php echo $item->url; ?>" class="img-responsive">
                    <?php
                    } elseif ($gallery_type == 3){ ?>
                        <i class="fa fa-folder fa-2x"></i>
                    <?php
                    }
                    ?>

                </td>
                <td><?php echo $item->url; ?></td>
                <td class="w100 text-center">
                    <input type="checkbox" class="change-item-status" data-url="<?php echo base_url('gallery/change_file_status/'.$item->id.'/'.$gallery_type); ?>" data-switchery data-color="#10c469"<?php echo $item->isActive == 1 ? ' checked' : NULL; ?> />
                </td>
                <td class="w100 text-center">
                    <a data-url="<?php echo base_url('gallery/delete_file/'.$item->id.'/'.$gallery_type); ?>" class="btn btn-sm btn-danger btn-block btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</a>
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