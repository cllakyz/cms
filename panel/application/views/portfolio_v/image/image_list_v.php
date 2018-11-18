<?php
if(empty($item_images)){ ?>
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
        <th>Görsel Adı</th>
        <th class="text-center">Durumu</th>
        <th class="text-center">Kapak</th>
        <th class="text-center">İşlem</th>
        </thead>
        <tbody class="sortable" data-url="<?php echo base_url('portfolio/image_sort'); ?>">
        <?php
        foreach ($item_images as $image){ ?>
            <tr id="sort-<?php echo $image->id; ?>">
                <td class="order"><i class="fa fa-reorder"></i></td>
                <td class="w50 text-center">#<?php echo $image->id; ?></td>
                <td class="w100">
                    <img width="30" src="<?php echo get_media($viewFolder, $image->img_url, "255x157"); ?>" alt="<?php echo $image->img_url; ?>" class="img-responsive">
                </td>
                <td><?php echo $image->img_url; ?></td>
                <td class="w100 text-center">
                    <input type="checkbox" class="change-item-status" data-url="<?php echo base_url('portfolio/change_image_status/'.$image->id); ?>" data-switchery data-color="#10c469"<?php echo $image->isActive == 1 ? ' checked' : NULL; ?> />
                </td>
                <td class="w100 text-center">
                    <input type="checkbox" class="change-portfolio-cover" data-url="<?php echo base_url('portfolio/change_portfolio_cover/'.$image->id.'/'.$image->portfolio_id); ?>" data-switchery<?php echo $image->isCover == 1 ? ' checked' : NULL; ?> />
                </td>
                <td class="w100 text-center">
                    <a data-url="<?php echo base_url('portfolio/delete_image/'. $image->id); ?>" class="btn btn-sm btn-danger btn-block btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</a>
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