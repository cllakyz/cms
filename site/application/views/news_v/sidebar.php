<aside class="col-md-4 col-lg-3 col-lg-offset-1">
    <div class="sidebar">
        <div class="block clearfix">
            <nav>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo base_url(); ?>">Anasayfa</a></li>
                    <li><a href="<?php echo base_url('urunler'); ?>">Ürünler</a></li>
                    <li><a href="<?php echo base_url('portfolyolar'); ?>">Portfolyo</a></li>
                    <li><a href="<?php echo base_url('hakkimizda'); ?>">Hakkımızda</a></li>
                    <li><a href="<?php echo base_url('iletisim'); ?>">İletişim</a></li>
                </ul>
            </nav>
        </div>
        <?php
        if(!empty($recent_news_list)){ ?>
            <div class="block clearfix">
                <h3 class="title">Son Haberler</h3>
                <div class="separator-2"></div>
                <?php
                foreach($recent_news_list as $recent_news){ ?>
                    <div class="media margin-clear">
                        <div class="media-left">
                            <?php
                            if($recent_news->news_type == 1){ ?>
                                <div class="overlay-container">
                                    <img class="media-object" src="<?php echo base_url('panel/uploads/news_v/'.$recent_news->img_url); ?>" alt="<?php echo $recent_news->url; ?>">
                                    <a href="<?php echo base_url('haber/'.$recent_news->url); ?>" class="overlay-link small"><i class="fa fa-link"></i></a>
                                </div>
                            <?php
                            } else{ ?>
                                <div>
                                    <iframe src="<?php echo $recent_news->video_url; ?>" style="max-width: 100px; max-height: 50px;"></iframe>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading"><a href="<?php echo base_url('haber/'.$recent_news->url); ?>"><?php echo character_limiter(strip_tags($recent_news->description),50); ?></a></h6>
                            <p class="small margin-clear"><i class="fa fa-calendar pr-10"></i><?php echo get_date($recent_news->createdAt); ?></p>
                        </div>
                        <hr>
                    </div>
                <?php
                }
                ?>

                <div class="text-right space-top">
                    <a href="<?php echo base_url('haberler'); ?>" class="link-dark"><i class="fa fa-plus-circle pl-5 pr-5"></i>Daha Fazla</a>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</aside>