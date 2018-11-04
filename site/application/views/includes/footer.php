<?php $settings = get_settings(); ?>
<footer id="footer" class="clearfix dark">

    <!-- .footer start -->
    <!-- ================ -->
    <div class="footer">
        <div class="container">
            <div class="footer-inner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-content">
                            <div class="logo-footer"><img id="logo-footer" src="<?php echo base_url('assets/images'); ?>/logo_blue.png" alt=""></div>
                            <p><?php echo character_limiter(strip_tags($settings->mission), 300); ?></p>
                            <ul class="list-inline mb-20">
                                <li><i class="text-default fa fa-map-marker pr-5"></i> <?php echo $settings->address; ?></li>
                                <li><i class="text-default fa fa-phone pl-10 pr-5"></i> <?php echo $settings->phone_1; ?></li>
                                <li><a href="mailto:<?php echo $settings->email; ?>" class="link-dark"><i class="text-default fa fa-envelope-o pl-10 pr-5"></i> <?php echo $settings->email; ?></a></li>
                            </ul>
                            <div class="separator-2"></div>
                            <?php
                            if($settings->facebook || $settings->twitter || $settings->instagram || $settings->linkedin){ ?>
                                <ul class="social-links circle margin-clear animated-effect-1">
                                    <?php
                                    if($settings->facebook){ ?>
                                        <li class="facebook"><a target="_blank" href="<?php echo $settings->facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                                        <?php
                                    }
                                    if($settings->twitter){ ?>
                                        <li class="twitter"><a target="_blank" href="<?php echo $settings->twitter; ?>"><i class="fa fa-twitter"></i></a></li>
                                        <?php
                                    }
                                    if($settings->instagram){ ?>
                                        <li class="instagram"><a target="_blank" href="<?php echo $settings->instagram; ?>"><i class="fa fa-instagram"></i></a></li>
                                        <?php
                                    }
                                    if($settings->linkedin){ ?>
                                        <li class="linkedin"><a target="_blank" href="<?php echo $settings->linkedin; ?>"><i class="fa fa-linkedin"></i></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-content">
                            <div id="map-canvas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer end -->

    <!-- .subfooter start -->
    <!-- ================ -->
    <div class="subfooter">
        <div class="container">
            <div class="subfooter-inner">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">Tüm Hakları Saklıdır © <?php echo date('Y').' '.$settings->company_name; ?> | <a target="_blank" href="http://celalakyuz.com">cAkyuz</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .subfooter end -->

</footer>