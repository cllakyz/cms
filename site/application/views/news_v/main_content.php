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
            <?php
            if($news->news_type == 1){ ?>
                <div class="overlay-container mb-20">
                    <img src="<?php echo get_media("news_v", $news->img_url, "730x411"); ?>" alt="<?php echo $news->url; ?>">
                    <a class="overlay-link popup-img" href="<?php echo base_url('panel/uploads/news_v/'.$news->img_url); ?>"><i class="fa fa-search-plus"></i></a>
                </div>
                <?php
            } else{ ?>
                <div>
                    <div class="embed-responsive embed-responsive-16by9 mb-20">
                        <iframe class="embed-responsive-item" src="<?php echo $news->video_url; ?>"></iframe>
                    </div>
                </div>
                <?php
            }
            ?>
            <p><?php echo strip_tags($news->description); ?></p>
        </div>
        <footer class="clearfix">
            <div class="link pull-right">
                <ul class="social-links circle small colored clearfix margin-clear text-right animated-effect-1">
                    <li class="twitter">
                        <a class="share-button" href="https://twitter.com/intent/tweet?text=<?php echo $news->title; ?> Haberi&url=<?php echo base_url('haber/'.$news->url); ?>"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="facebook">
                        <a class="share-button" href="https://facebook.com/sharer.php?u=<?php echo base_url('haber/'.$news->url); ?>&t=<?php echo $news->title; ?> Haberi"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="googleplus">
                        <a class="share-button" href="https://plus.google.com/share?url=<?php echo base_url('haber/'.$news->url); ?>"><i class="fa fa-google-plus"></i></a>
                    </li>
                </ul>
            </div>
        </footer>
    </article>
    <!-- blogpost end -->
</div>