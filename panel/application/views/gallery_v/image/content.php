<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form data-url="<?php echo base_url('product/refresh_image_list/'.$item->id); ?>" action="<?php echo base_url('product/image_upload/'.$item->id); ?>" id="prd-img-dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?php echo base_url('product/image_upload/'.$item->id); ?>', method: 'post'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Yüklemek istediğiniz resimleri buraya sürükleyebilirsiniz.</h3>
                        <p class="m-b-lg text-muted">(Bu alana tıklayarak da resim yükleyebilirsiniz.)</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg"><?php echo $item->title; ?> Kaydına Ait Resimler</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body image_list_container">
                <?php $this->load->view($viewFolder."/".$subViewFolder."/image_list_v"); ?>
            </div>
        </div>
    </div>
</div>