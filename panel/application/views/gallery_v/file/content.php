<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form data-url="<?php echo base_url('gallery/refresh_file_list/'.$item->id.'/'.$item->gallery_type.'/'.$item->folder_name); ?>"
                      action="<?php echo base_url('gallery/file_upload/'.$item->id.'/'.$item->gallery_type.'/'.$item->folder_name); ?>"
                      id="prd-img-dropzone" class="dropzone" data-plugin="dropzone"
                      data-options="{ url: '<?php echo base_url('gallery/file_upload/'.$item->id.'/'.$item->gallery_type.'/'.$item->folder_name); ?>', method: 'post'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Yüklemek istediğiniz dosyaları buraya sürükleyebilirsiniz.</h3>
                        <p class="m-b-lg text-muted">(Bu alana tıklayarak da dosya yükleyebilirsiniz.)</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg"><?php echo $item->gallery_name; ?> Kaydına Ait Dosyalar</h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body image_list_container">
                <?php $this->load->view($viewFolder."/".$subViewFolder."/file_list_v"); ?>
            </div>
        </div>
    </div>
</div>