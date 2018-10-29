<?php $settings = get_settings(); ?>
<!-- banner start -->
<!-- ================ -->
<div class="banner dark-translucent-bg" style="background-image:url('<?php echo base_url('assets/images'); ?>/page-about-banner-1.jpg'); background-position: 50% 27%;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 text-center col-md-offset-2 pv-20">
                <h3 class="title logo-font object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100"><?php echo $settings->company_name; ?></h3>
                <div class="separator object-non-visible mt-10" data-animation-effect="fadeIn" data-effect-delay="100"></div>
                <p class="text-center object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100"><?php echo character_limiter(strip_tags($settings->about_us), 200); ?></p>
            </div>
        </div>
    </div>
</div>
<!-- banner end -->

<!-- main-container start -->
<!-- ================ -->
<section class="main-container padding-bottom-clear">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">
                <h3 class="title"><strong>Hakkımızda</strong></h3>
                <div class="separator-2"></div>
                <div class="row">
                    <div class="col-md-12">
                        <p><?php echo $settings->about_us; ?></p>
                    </div>
                </div>
            </div>
            <!-- main end -->

        </div>
    </div>

    <!-- section start -->
    <!-- ================ -->
    <div class="light-gray-bg pv-20 section mt-20">
        <div class="container">
            <h3>Neden <strong>Bizi Seçmelisiniz</strong></h3>
            <div class="separator-2"></div>
            <div class="row">
                <!-- accordion start -->
                <!-- ================ -->
                <div class="col-md-12">
                    <div class="panel-group collapse-style-1" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <i class="fa fa-rocket pr-10"></i>Misyon
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <?php echo strip_tags($settings->mission); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">
                                        <i class="fa fa-leaf pr-10"></i>Vizyon
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo strip_tags($settings->vision); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- accordion end -->
            </div>
            <!-- clients start -->
            <!-- ================ -->
            <!--<div class="separator"></div>
            <div class="clients-container">
                <div class="clients">
                    <div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">
                        <a href="#"><img src="<?php /*echo base_url('assets/images'); */?>/client-1.png" alt=""></a>
                    </div>
                    <div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="200">
                        <a href="#"><img src="<?php /*echo base_url('assets/images'); */?>/client-2.png" alt=""></a>
                    </div>
                    <div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="300">
                        <a href="#"><img src="<?php /*echo base_url('assets/images'); */?>/client-3.png" alt=""></a>
                    </div>
                    <div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="400">
                        <a href="#"><img src="<?php /*echo base_url('assets/images'); */?>/client-4.png" alt=""></a>
                    </div>
                    <div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="500">
                        <a href="#"><img src="<?php /*echo base_url('assets/images'); */?>/client-5.png" alt=""></a>
                    </div>
                    <div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="600">
                        <a href="#"><img src="<?php /*echo base_url('assets/images'); */?>/client-6.png" alt=""></a>
                    </div>
                    <div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="700">
                        <a href="#"><img src="<?php /*echo base_url('assets/images'); */?>/client-7.png" alt=""></a>
                    </div>
                    <div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="800">
                        <a href="#"><img src="<?php /*echo base_url('assets/images'); */?>/client-8.png" alt=""></a>
                    </div>
                </div>
            </div>-->
            <!-- clients end -->
        </div>
    </div>
    <!-- section end -->

</section>
<!-- main-container end -->