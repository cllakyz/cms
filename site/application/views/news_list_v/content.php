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
                <h1 class="page-title">Haber Listesi</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <?php
                if(!empty($news_list)){ ?>
                    <!-- timeline grid start -->
                    <!-- ================ -->
                    <div class="timeline clearfix">
                        <?php
                        foreach ($news_list as $key => $news){ ?>
                            <!-- timeline grid item start -->
                            <div class="timeline-item<?php echo $key % 2 != 0 ? ' pull-right' : NULL; ?>">
                                <!-- blogpost start -->
                                <article class="blogpost shadow light-gray-bg bordered<?php echo $news->news_type == 2 ? ' object-non-visible' : NULL; ?>"<?php echo $news->news_type == 2 ? ' data-animation-effect="fadeInUpSmall" data-effect-delay="100"' : NULL; ?>>
                                    <?php
                                    if($news->news_type == 1){ ?>
                                        <div class="overlay-container">
                                            <img src="<?php echo get_media("news_v", $news->img_url, "513x289"); ?>" alt="<?php echo $news->title; ?>">
                                            <a class="overlay-link" href="<?php echo base_url('haber/'.$news->url); ?>"><i class="fa fa-link"></i></a>
                                        </div>
                                    <?php
                                    } else{ ?>
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="<?php echo $news->video_url; ?>"></iframe>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <header>
                                        <h2><a href="<?php echo base_url('haber/'.$news->url); ?>"><?php echo $news->title; ?></a></h2>
                                        <div class="post-info">
                                            <span class="post-date">
                                                <i class="icon-calendar"></i>
                                                <span class="month"><?php echo get_date($news->createdAt); ?></span>
                                            </span>
                                            <span class="comments"><i class="icon-eye"></i> <a href="#"><?php echo $news->viewCount; ?> Görüntülenme</a></span>
                                        </div>
                                    </header>
                                    <div class="blogpost-content">
                                        <p><?php echo character_limiter(strip_tags($news->description), 200); ?></p>
                                    </div>
                                    <footer class="clearfix">
                                        <div class="link pull-right"><i class="icon-link"></i><a href="<?php echo base_url('haber/'.$news->url); ?>">Görüntüle</a></div>
                                    </footer>
                                </article>
                                <!-- blogpost end -->
                            </div>
                            <!-- timeline grid item end -->
                        <?php
                        }
                        ?>
                    </div>
                    <!-- timeline grid end -->
                <?php
                } else{ ?>
                    <div class="col-md-12">
                        <div class="alert alert-info text-center">
                            Haber listesi bulunamadı.
                        </div>
                        <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                    </div>
                <?php
                }
                ?>

            </div>
            <!-- main end -->

        </div>
    </div>
</section>
<!-- main-container end -->