<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pv-40 banner light-gray-bg">
                    <div class="container clearfix">
                        <div class="slideshow">
                            <div class="slider-revolution-5-container">
                                <div id="slider-banner-boxedwidth" class="slider-banner-boxedwidth rev_slider" data-version="5.0">
                                    <ul class="slides">
                                        <?php
                                        if(!empty($portfolio_images)){
                                            foreach ($portfolio_images as $image){ ?>
                                                <li class="text-center" data-transition="slidehorizontal" data-slotamount="default" data-masterspeed="default" data-title="<?php echo $portfolio->title; ?>">
                                                    <img src="<?php echo base_url('panel/uploads/portfolio_v/'.$image->img_url); ?>" alt="<?php echo $portfolio->title; ?>" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover" class="rev-slidebg">
                                                    <div class="tp-caption dark-translucent-bg"
                                                         data-x="center"
                                                         data-y="center"
                                                         data-start="0"
                                                         data-transform_idle="o:1;"
                                                         data-transform_in="o:0;s:600;e:Power2.easeInOut;"
                                                         data-transform_out="o:0;s:600;"
                                                         data-width="5000"
                                                         data-height="450">
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                        } else{ ?>
                                            <li class="text-center" data-transition="slidehorizontal" data-slotamount="default" data-masterspeed="default" data-title="Project Image 1">
                                                <img src="<?php echo base_url('assets'); ?>images/portfolio-item-banner-1.jpg" alt="slidebg1" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover" class="rev-slidebg">
                                                <div class="tp-caption dark-translucent-bg"
                                                     data-x="center"
                                                     data-y="center"
                                                     data-start="0"
                                                     data-transform_idle="o:1;"
                                                     data-transform_in="o:0;s:600;e:Power2.easeInOut;"
                                                     data-transform_out="o:0;s:600;"
                                                     data-width="5000"
                                                     data-height="450">
                                                </div>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <div class="tp-bannertimer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="main-container padding-ver-clear">
                    <div class="container pv-40">
                        <div class="row">
                            <div class="main col-md-8">
                                <h1 class="title"><?php echo $portfolio->title; ?></h1>
                                <div class="separator-2"></div>
                                <p><?php echo strip_tags($portfolio->description); ?></p>
                            </div>
                            <aside class="col-md-4 col-lg-3 col-lg-offset-1">
                                <div class="sidebar">
                                    <div class="block clearfix">
                                        <h3 class="title">Portfolyo Detayları</h3>
                                        <div class="separator-2"></div>
                                        <ul class="list margin-clear">
                                            <li><strong>Müşteri: </strong> <span class="text-right"><?php echo $portfolio->client; ?></span></li>
                                            <li><strong>Tarih: </strong> <span class="text-right"><?php echo get_date($portfolio->finishedAt); ?></span></li>
                                            <li><strong>Kategori: </strong> <span class="text-right"><?php echo get_portfolio_category_title($portfolio->category_id); ?></span></li>
                                            <li><strong>Yer/Mekan: </strong> <span class="text-right"><?php echo $portfolio->place; ?></span></li>
                                            <li><strong>URL: </strong> <span class="text-right"><a href="<?php echo $portfolio->portfolio_url; ?>"><?php echo $portfolio->portfolio_url; ?></a></span></li>
                                        </ul>
                                        <?php /*
                                        <a href="#" class="btn btn-animated btn-default btn-lg">External Link <i class="fa fa-external-link"></i></a>
                                        <h3>Share This</h3>
                                        <div class="separator-2"></div>
                                        <ul class="social-links colored circle small">
                                            <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                            <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                            <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                            <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                            <li class="xing"><a target="_blank" href="http://www.xing.com"><i class="fa fa-xing"></i></a></li>
                                        </ul>
                                        */ ?>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </section>
                <section class="section light-gray-bg pv-40 clearfix">
                    <div class="container">
                        <h3>Diğer <strong>Çalışmalarımız</strong></h3>
                        <div class="row grid-space-10">
                            <?php
                            if(!empty($other_portfolios)){
                                foreach($other_portfolios as $portfolio){ ?>
                                    <div class="col-sm-4">
                                        <div class="image-box style-2 mb-20 bordered light-gray-bg">
                                            <div class="overlay-container overlay-visible">
                                                <?php
                                                $image = get_portfolio_cover_image($portfolio->id);
                                                $image = $image != '' ? base_url("panel/uploads/portfolio_v/$image") : base_url('assets/images/portfolio-1.jpg');
                                                ?>
                                                <img src="<?php echo $image; ?>" alt="">
                                                <div class="overlay-bottom text-left">
                                                    <p class="lead margin-clear"><?php echo $portfolio->title; ?></p>
                                                </div>
                                            </div>
                                            <div class="body">
                                                <p><?php echo character_limiter(strip_tags($portfolio->description), 30); ?></p>
                                                <a href="<?php echo base_url('portfolyo-detay/'.$portfolio->url); ?>" class="btn btn-default btn-sm btn-hvr hvr-sweep-to-right margin-clear">Görüntüle<i class="fa fa-arrow-right pl-10"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

