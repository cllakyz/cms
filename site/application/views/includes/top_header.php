<?php
$settings = get_settings();
if($settings->facebook || $settings->twitter || $settings->instagram || $settings->linkedin){ ?>
    <div class="header-top colored">
        <div class="container">
            <div class="row">
                <div class="col-xs-2 col-sm-5">
                    <!-- header-top-first start -->
                    <!-- ================ -->
                    <div class="header-top-first clearfix">
                        <ul class="social-links circle small clearfix hidden-xs">
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
                        <div class="social-links hidden-lg hidden-md hidden-sm circle small">
                            <div class="btn-group dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
                                <ul class="dropdown-menu dropdown-animation">
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
                            </div>
                        </div>
                    </div>
                    <!-- header-top-first end -->
                </div>
                <div class="col-xs-10 col-sm-7">

                    <!-- header-top-second start -->
                    <!-- ================ -->
                    <div id="header-top-second"  class="clearfix text-right">
                        <ul class="list-inline">
                            <li><i class="fa fa-phone pr-5 pl-10"></i><?php echo $settings->phone_1; ?></li>
                            <li><i class="fa fa-envelope-o pr-5 pl-10"></i> <?php echo $settings->email; ?></li>
                        </ul>
                    </div>
                    <!-- header-top-second end -->
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
