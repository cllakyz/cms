<!-- main-container start -->
<!-- ================ -->
<section class="main-container">
    <div class="container">
        <div class="row">
            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">
                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Hizmetlerimiz</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <p class="lead">Aşağıda hizmetlerimizden bazılarını görebilirsiniz.</p>
                <?php
                if(!empty($services)){
                    foreach($services as $key => $service){ ?>
                        <div class="image-box style-4 light-gray-bg">
                            <div class="row grid-space-0">
                                <?php
                                if($key % 2 == 0){ ?>
                                    <div class="col-md-6">
                                        <div class="overlay-container">
                                            <img src="<?php echo base_url('panel/uploads/service_v/'.$service->img_url); ?>" alt="<?php echo $service->title; ?>">
                                            <div class="overlay-to-top">
                                                <p class="small margin-clear"><em><?php echo $service->title; ?></em></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="body">
                                            <div class="pv-30 visible-lg"></div>
                                            <h3><?php echo $service->title; ?></h3>
                                            <div class="separator-2"></div>
                                            <p class="margin-clear"><?php echo character_limiter(strip_tags($service->description), 500); ?></p>
                                            <br>
                                            <a href="<?php echo base_url('referans-detay/'.$service->url); ?>" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Görüntüle<i class="fa fa-arrow-right pl-10"></i></a>
                                        </div>
                                    </div>
                                <?php
                                } else{ ?>
                                    <div class="col-md-6">
                                        <div class="body">
                                            <div class="pv-30 visible-lg"></div>
                                            <h3><?php echo $service->title; ?></h3>
                                            <div class="separator-2"></div>
                                            <p class="margin-clear"><?php echo character_limiter(strip_tags($service->description), 500); ?></p>
                                            <br>
                                            <a href="<?php echo base_url('referans-detay/'.$service->url); ?>" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Görüntüle<i class="fa fa-arrow-right pl-10"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="overlay-container">
                                            <img src="<?php echo base_url('panel/uploads/service_v/'.$service->img_url); ?>" alt="<?php echo $service->title; ?>">
                                            <div class="overlay-to-top">
                                                <p class="small margin-clear"><em><?php echo $service->title; ?></em></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
            <!-- main end -->
        </div>
    </div>
</section>
<!-- main-container end -->
