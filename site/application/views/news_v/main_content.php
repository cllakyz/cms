<div class="main col-md-8">

    <!-- page-title start -->
    <!-- ================ -->
    <h1 class="page-title"><?php echo $news->title; ?></h1>
    <!-- page-title end -->

    <!-- blogpost start -->
    <!-- ================ -->
    <article class="blogpost full">
        <header>
            <div class="post-info">
                <span class="post-date">
                    <i class="icon-calendar"></i>
                    <span class="month"><?php echo get_date($news->createdAt); ?></span>
                </span>
                <span class="comments"><i class="icon-chat"></i> <a href="#"><?php echo $news->viewCount; ?> Görüntülenme</a></span>
            </div>
        </header>
        <div class="blogpost-content">
            <div id="carousel-blog-post" class="carousel slide mb-20" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-blog-post" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-blog-post" data-slide-to="1"></li>
                    <li data-target="#carousel-blog-post" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="overlay-container">
                            <img src="<?php echo base_url('assets/images'); ?>/blog-1.jpg" alt="">
                            <a class="overlay-link popup-img" href="<?php echo base_url('assets/images'); ?>/blog-1.jpg"><i class="fa fa-search-plus"></i></a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="overlay-container">
                            <img src="<?php echo base_url('assets/images'); ?>/blog-3.jpg" alt="">
                            <a class="overlay-link popup-img" href="<?php echo base_url('assets/images'); ?>/blog-3.jpg"><i class="fa fa-search-plus"></i></a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="overlay-container">
                            <img src="<?php echo base_url('assets/images'); ?>/blog-4.jpg" alt="">
                            <a class="overlay-link popup-img" href="<?php echo base_url('assets/images'); ?>/blog-4.jpg"><i class="fa fa-search-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <p><?php echo strip_tags($news->description); ?></p>
        </div>
        <footer class="clearfix">
            <div class="link pull-right">
                <ul class="social-links circle small colored clearfix margin-clear text-right animated-effect-1">
                    <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                    <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                    <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                </ul>
            </div>
        </footer>
    </article>
    <!-- blogpost end -->
</div>