<?php
if(!empty($testimonials)){ ?>
    <section class="dark-translucent-bg background-testimonial pv-40" style="background-position: 50% 50%;">
        <div class="owl-carousel content-slider">
            <?php
            foreach ($testimonials as $testimonial){ ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="testimonial text-center">
                                <div class="testimonial-image">
                                    <img src="<?php echo get_media("testimonial_v", $testimonial->img_url, "90x90"); ?>" alt="<?php echo $testimonial->full_name; ?>" title="<?php echo $testimonial->full_name; ?>" class="img-circle">
                                </div>
                                <h3><?php echo $testimonial->title; ?></h3>
                                <div class="separator"></div>
                                <div class="testimonial-body">
                                    <blockquote>
                                        <p><?php echo strip_tags($testimonial->description); ?></p>
                                    </blockquote>
                                    <div class="testimonial-info-1">- <?php echo $testimonial->full_name; ?></div>
                                    <div class="testimonial-info-2"><?php echo $testimonial->company; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </section>
<?php
}
?>
