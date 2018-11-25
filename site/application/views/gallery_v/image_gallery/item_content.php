<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <h1 class="page-title"><?php echo $gallery->gallery_name; ?></h1>
                <div class="separator-2"></div>
                <div class="row grid-space-20">
                    <?php
                    if(!empty($images)){
                        foreach($images as $image){ ?>
                            <div class="col-xs-3 mb-20">
                                <div class="overlay-container">
                                    <img src="<?php echo get_media("$viewFolder/images/$gallery->folder_name",$image->url,"350x216"); ?>" alt="">
                                    <a href="<?php echo get_media("$viewFolder/images/$gallery->folder_name",$image->url,"851x606"); ?>" class="overlay-link small popup-img" title="<?php echo $gallery->gallery_name; ?>">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } else{ ?>
                        <div class="col-md-12">
                            <div class="alert alert-info text-center">
                                Bu galeriye eklenmiş görsel bulunamadı.
                            </div>
                            <a href="<?php echo base_url('fotograf-galerisi'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>