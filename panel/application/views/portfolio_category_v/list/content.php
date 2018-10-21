<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Portfolyo Kategori Listesi
            <a href="<?php echo base_url('portfolio_category/new_form'); ?>" class="btn btn-outline btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php
            if(empty($items)){ ?>
                <div class="alert alert-info text-center">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Herhangi bir veri bulunmamaktadır. Eklemek için <a href="<?php echo base_url('portfolio_category/new_form'); ?>">tıklayınız</a></p>
                </div>
            <?php
            } else{ ?>
                <table class="table table-hover table-striped table-bordered content-table">
                    <thead>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="w50 text-center">#ID</th>
                    <th>Başlık</th>
                    <th class="text-center">Durum</th>
                    <th class="text-center">İşlem</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($items as $item){ ?>
                            <tr>
                                <td class="order"><i class="fa fa-reorder"></i></td>
                                <td class="w50 text-center"><?php echo $item->id; ?></td>
                                <td><?php echo $item->title; ?></td>
                                <td class="text-center w100">
                                    <input type="checkbox" class="change-item-status" data-url="<?php echo base_url('portfolio_category/change_status/'.$item->id); ?>" data-switchery data-color="#10c469"<?php echo $item->isActive == 1 ? ' checked' : NULL; ?> />
                                </td>
                                <td class="text-center w200">
                                    <a data-url="<?php echo base_url('portfolio_category/delete/'.$item->id); ?>" class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</a>
                                    <a href="<?php echo base_url('portfolio_category/edit_form/'.$item->id); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
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