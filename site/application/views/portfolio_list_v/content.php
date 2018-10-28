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
                <h1 class="page-title">Portfolyo Listesi</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <p class="lead">Aşağıda sizin için seçtiğimiz çalışmalarımızdan bazılarını bulabilirsiniz.</p>
                <?php
                if(!empty($portfolios)){
                    foreach($portfolios as $portfolio){ ?>
                        <div class="image-box style-3-b">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="overlay-container">
                                        <?php
                                        $image = get_portfolio_cover_image($portfolio->id);
                                        $img_path = $image ? base_url("panel/uploads/portfolio_v/$image") : base_url('assets/images/portfolio-1.jpg');
                                        ?>
                                        <img src="<?php echo $img_path; ?>" alt="<?php echo $portfolio->title; ?>">
                                        <div class="overlay-to-top">
                                            <p class="small margin-clear"><em><?php echo $portfolio->title; ?></em></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-8 col-lg-9">
                                    <div class="body">
                                        <h3 class="title"><a href="<?php echo base_url('portfolyo-detay/'.$portfolio->url); ?>"><?php echo $portfolio->title; ?></a></h3>
                                        <?php
                                        $category_title = get_portfolio_category_title($portfolio->category_id);
                                        ?>
                                        <p class="small mb-10"><i class="icon-calendar"></i> <?php echo get_date($portfolio->finishedAt);
                                            if($category_title){ ?>
                                                <i class="pl-10 icon-tag-1"></i> <?php echo $category_title;
                                            }
                                            ?>
                                        </p>
                                        <div class="separator-2"></div>
                                        <p class="mb-10"><?php echo character_limiter(strip_tags($portfolio->description), 400); ?></p>
                                        <a href="<?php echo base_url('portfolyo-detay/'.$portfolio->url); ?>" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Görüntüle<i class="fa fa-arrow-right pl-10"></i></a>
                                    </div>
                                </div>
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
