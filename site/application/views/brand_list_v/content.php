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
                <h1 class="page-title">Marka Listesi</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <p class="lead">Aşağıda çalıştığımız markaların bazılarını görebilirsiniz.</p>
                <div class="row">
                    <?php
                    if(!empty($brands)){
                        foreach($brands as $brand){ ?>
                            <div class="col-sm-4">
                                <div class="image-box shadow text-center mb-20">
                                    <div class="overlay-container">
                                        <img src="<?php echo base_url('panel/uploads/brand_v/'.$brand->img_url); ?>" alt="<?php echo $brand->title; ?>">
                                        <div class="overlay-top">
                                            <div class="text">

                                            </div>
                                        </div>
                                        <div class="overlay-bottom">
                                            <div class="text">
                                                <h3><?php echo $brand->title; ?></h3>
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
                                Marka listesi bulunamadı.
                            </div>
                            <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- main end -->
        </div>
    </div>
</section>
<!-- main-container end -->
