<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Kullanıcı Listesi
            <?php
            if(isAdmin()){ ?>
                <a href="<?php echo base_url('user/new_form'); ?>" class="btn btn-outline btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php
            }
            ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php
            if(empty($items)){ ?>
                <div class="alert alert-info text-center">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Herhangi bir veri bulunmamaktadır. Eklemek için <a href="<?php echo base_url('user/new_form'); ?>">tıklayınız</a></p>
                </div>
            <?php
            } else{ ?>
                <table class="table table-hover table-striped table-bordered content-table">
                    <thead>
                    <th class="w50 text-center">#ID</th>
                    <th>Kullanıcı Adı</th>
                    <th>Ad Saoyad</th>
                    <th>E-Posta</th>
                    <th class="text-center">Durum</th>
                    <th class="text-center">İşlem</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($items as $item){ ?>
                            <tr>
                                <td class="w50 text-center"><?php echo $item->id; ?></td>
                                <td><?php echo $item->user_name; ?></td>
                                <td><?php echo $item->full_name; ?></td>
                                <td><?php echo $item->email; ?></td>
                                <td class="text-center w100">
                                    <input type="checkbox" class="change-item-status" data-url="<?php echo base_url('user/change_status/'.$item->id); ?>" data-switchery data-color="#10c469"<?php echo $item->isActive == 1 ? ' checked' : NULL; ?> />
                                </td>
                                <td class="text-center w400">
                                    <a data-url="<?php echo base_url('user/delete/'.$item->id); ?>" class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</a>
                                    <a href="<?php echo base_url('user/edit_form/'.$item->id); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-edit"></i> Düzenle</a>
                                    <a href="<?php echo base_url('user/edit_password_form/'.$item->id); ?>" class="btn btn-sm btn-purple btn-outline"><i class="fa fa-key"></i> Şifre Değiştir</a>
                                    <a href="<?php echo base_url('user/edit_permission_form/'.$item->id); ?>" class="btn btn-sm btn-dark btn-outline"><i class="fa fa-eye"></i> Yetki Tanımı</a>
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