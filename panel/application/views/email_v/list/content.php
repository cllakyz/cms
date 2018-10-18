<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            E-Posta Ayar Listesi
            <a href="<?php echo base_url('email/new_form'); ?>" class="btn btn-outline btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php
            if(empty($items)){ ?>
                <div class="alert alert-info text-center">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Herhangi bir veri bulunmamaktadır. Eklemek için <a href="<?php echo base_url('email/new_form'); ?>">tıklayınız</a></p>
                </div>
            <?php
            } else{ ?>
                <table class="table table-hover table-striped table-bordered content-table">
                    <thead>
                    <th class="w50 text-center">#ID</th>
                    <th>E-Posta Başlık</th>
                    <th>Sunucu Adı</th>
                    <th>Protokol</th>
                    <th>Port</th>
                    <th>E-Posta</th>
                    <th>Kimden</th>
                    <th>Kime</th>
                    <th class="text-center">Durum</th>
                    <th class="text-center">İşlem</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($items as $item){ ?>
                            <tr>
                                <td class="w50 text-center"><?php echo $item->id; ?></td>
                                <td><?php echo $item->user_name; ?></td>
                                <td><?php echo $item->host; ?></td>
                                <td><?php echo $item->protocol; ?></td>
                                <td><?php echo $item->port; ?></td>
                                <td><?php echo $item->user; ?></td>
                                <td><?php echo $item->from; ?></td>
                                <td><?php echo $item->to; ?></td>
                                <td class="text-center w100">
                                    <input type="checkbox" class="change-item-status" data-url="<?php echo base_url('email/change_status/'.$item->id); ?>" data-switchery data-color="#10c469"<?php echo $item->isActive == 1 ? ' checked' : NULL; ?> />
                                </td>
                                <td class="text-center w200">
                                    <a data-url="<?php echo base_url('email/delete/'.$item->id); ?>" class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</a>
                                    <a href="<?php echo base_url('email/edit_form/'.$item->id); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
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