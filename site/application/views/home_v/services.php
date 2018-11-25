<section class="light-gray-bg pv-40 border-clear">
    <div class="container">

        <!-- page-title start -->
        <!-- ================ -->
        <h1 class="page-title text-center"><strong>Hizmetlerimiz</strong></h1>
        <div class="separator"></div>
        <br>
        <!-- page-title end -->

        <div class="row">
            <?php
            foreach($services as $service){ ?>
                <div class="col-sm-4">
                    <div class="image-box style-2 mb-20">
                        <div class="overlay-container overlay-visible">
                            <img src="<?php echo get_media("service_v", $service->img_url, "350x217"); ?>" alt="<?php echo $service->title; ?>">
                            <a href="<?php echo base_url("hizmet-detay/$service->url"); ?>" class="overlay-link"><i class="fa fa-link"></i></a>
                            <div class="overlay-bottom">
                                <div class="text">
                                    <p class="lead margin-clear text-left mobile-visible"><?php echo $service->title; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="body padding-horizontal-clear">
                            <p><?php echo character_limiter(strip_tags($service->description), 200); ?></p>
                            <a class="link-dark" href="<?php echo base_url("hizmet-detay/$service->url"); ?>">Devam Et</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>

    </div>
</section>