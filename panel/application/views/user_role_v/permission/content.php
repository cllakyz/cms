<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Yetki Tanımlarını Düzenle</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url('user_role/edit_permission/'.$item->id); ?>" method="post">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <th>Modül Adı</th>
                            <th>Görüntüleme</th>
                            <th>Ekleme</th>
                            <th>Silme</th>
                            <th>Güncelleme</th>
                        </thead>
                        <tbody>
                        <?php
                        foreach (getControllerList() as $controllerName){ ?>
                            <tr>
                                <td><?php echo $controllerName; ?></td>
                                <td class="text-center w150">
                                    <input type="checkbox" name="permission[<?php echo $controllerName; ?>][read]" data-switchery data-color="#10c469" checked/>
                                </td>
                                <td class="text-center w150">
                                    <input type="checkbox" name="permission[<?php echo $controllerName; ?>][add]" data-switchery data-color="#10c469" checked/>
                                </td>
                                <td class="text-center w150">
                                    <input type="checkbox" name="permission[<?php echo $controllerName; ?>][edit]" data-switchery data-color="#10c469" checked/>
                                </td>
                                <td class="text-center w150">
                                    <input type="checkbox" name="permission[<?php echo $controllerName; ?>][delete]" data-switchery data-color="#10c469" checked/>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <br>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url('user_role'); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>