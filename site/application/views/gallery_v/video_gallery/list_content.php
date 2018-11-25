<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <h1 class="page-title">Video Galerileri</h1>
                <div class="separator-2"></div>
                <div class="row">
                    <?php
                    if(!empty($galleries)){
                        foreach($galleries as $gallery){ ?>
                            <div class="col-sm-4">
                                <div class="image-box shadow text-center mb-20">
                                    <div class="overlay-container overlay-visible">
                                        <img src="<?php echo base_url("assets/images/default_video_gallery.png"); ?>" alt="<?php echo $gallery->gallery_name; ?>">
                                        <a href="<?php echo base_url("video-galerisi/$gallery->url"); ?>" class="overlay-link"><i class="fa fa-link"></i></a>
                                        <div class="overlay-bottom hidden-xs">
                                            <div class="text">
                                                <p class="lead margin-clear"><?php echo $gallery->gallery_name; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else{ ?>
                        <div class="col-md-12">
                            <div class="alert alert-info text-center">
                                Video galerileri bulunamadı.
                            </div>
                            <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>