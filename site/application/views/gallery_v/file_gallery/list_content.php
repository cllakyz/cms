<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <h1 class="page-title">Dosya Galerileri</h1>
                <div class="separator-2"></div>
                <div class="row">
                    <?php
                    if(!empty($galleries)){
                        foreach($galleries as $gallery){ ?>
                            <div class="col-sm-4">
                                <div class="image-box shadow text-center mb-20">
                                    <div class="overlay-container overlay-visible">
                                        <img src="<?php echo base_url("assets/images"); ?>/portfolio-4.jpg" alt="">
                                        <a href="<?php echo base_url("dosya-galerisi/$gallery->url"); ?>" class="overlay-link"><i class="fa fa-link"></i></a>
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
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>