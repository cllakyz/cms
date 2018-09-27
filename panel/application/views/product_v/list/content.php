<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Ürün Listesi
            <a href="<?php echo base_url('product/new_form'); ?>" class="btn btn-outline btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php
            if(empty($items)){ ?>
                <div class="alert alert-info text-center">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Herhangi bir veri bulunmamaktadır. Eklemek için <a href="<?php echo base_url('product/new_form'); ?>">tıklayınız</a></p>
                </div>
            <?php
            } else{ ?>
                <table class="table table-hover table-striped">
                    <thead>
                    <th>#ID</th>
                    <th>URL</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Durum</th>
                    <th>İşlem</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($items as $item){ ?>
                            <tr>
                                <td><?php echo $item->id; ?></td>
                                <td><?php echo $item->url; ?></td>
                                <td><?php echo $item->title; ?></td>
                                <td><?php echo $item->description; ?></td>
                                <td>
                                    <input type="checkbox" data-switchery data-color="#10c469"<?php echo $item->isActive == 1 ? ' checked' : NULL; ?> />
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger btn-outline"><i class="fa fa-trash"></i> Sil</a>
                                    <a href="#" class="btn btn-sm btn-info btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
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