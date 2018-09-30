<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="../api/dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '../api/dropzone'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Drop files here or click to upload.</h3>
                        <p class="m-b-lg text-muted">(This is just a demo dropzone. Selected files are not actually uploaded.)</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">Ürünün Fotoğrafları</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <th class="text-center">#ID</th>
                        <th class="text-center">Görsel</th>
                        <th>Görsel Adı</th>
                        <th class="text-center">Durumu</th>
                        <th class="text-center">İşlem</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="w100 text-center">#1</td>
                            <td class="w100">
                                <img width="30" src="http://dev.newcms.com/panel/assets/assets/images/221.jpg" alt="" class="img-responsive">
                            </td>
                            <td>deneme-urun.jpg</td>
                            <td class="w100 text-center">
                                <input type="checkbox" class="change-item-status" data-url="<?php echo base_url('product/change_status/'); ?>" data-switchery data-color="#10c469"<?php echo 1 == 1 ? ' checked' : NULL; ?> />
                            </td>
                            <td class="w100 text-center">
                                <a data-url="<?php echo base_url('product/delete/'. 1); ?>" class="btn btn-sm btn-danger btn-block btn-outline remove-btn"><i class="fa fa-trash"></i> Sil</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>