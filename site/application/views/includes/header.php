<?php $settings = get_settings(); ?>
<!-- header-container start -->
<div class="header-container">

    <!-- header-top start -->
    <!-- classes:  -->
    <!-- "dark": dark version of header top e.g. class="header-top dark" -->
    <!-- "colored": colored version of header top e.g. class="header-top colored" -->
    <!-- ================ -->
    <div class="header-top  colored">
        <div class="container">
            <div class="row">
                <div class="col-xs-2 col-sm-5">
                    <!-- header-top-first start -->
                    <!-- ================ -->
                    <div class="header-top-first clearfix">
                        <ul class="social-links circle small clearfix hidden-xs">
                            <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                            <li class="skype"><a target="_blank" href="http://www.skype.com"><i class="fa fa-skype"></i></a></li>
                            <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                            <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                            <li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fa fa-youtube-play"></i></a></li>
                            <li class="flickr"><a target="_blank" href="http://www.flickr.com"><i class="fa fa-flickr"></i></a></li>
                            <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                            <li class="pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                        <div class="social-links hidden-lg hidden-md hidden-sm circle small">
                            <div class="btn-group dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
                                <ul class="dropdown-menu dropdown-animation">
                                    <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                    <li class="skype"><a target="_blank" href="http://www.skype.com"><i class="fa fa-skype"></i></a></li>
                                    <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                    <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                    <li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fa fa-youtube-play"></i></a></li>
                                    <li class="flickr"><a target="_blank" href="http://www.flickr.com"><i class="fa fa-flickr"></i></a></li>
                                    <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                    <li class="pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
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
                            <li><i class="fa fa-phone pr-5 pl-10"></i>+12 123 123 123</li>
                            <li><i class="fa fa-envelope-o pr-5 pl-10"></i> theproject@mail.com</li>
                        </ul>
                    </div>
                    <!-- header-top-second end -->
                </div>
            </div>
        </div>
    </div>
    <!-- header-top end -->

    <!-- header start -->
    <!-- classes:  -->
    <!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
    <!-- "dark": dark version of header e.g. class="header dark clearfix" -->
    <!-- "full-width": mandatory class for the full-width menu layout -->
    <!-- "centered": mandatory class for the centered logo layout -->
    <!-- ================ -->
    <header class="header  fixed    clearfix">

        <div class="container">
            <div class="row">
                <div class="col-md-3 ">
                    <!-- header-first start -->
                    <!-- ================ -->
                    <div class="header-first clearfix">

                        <!-- logo -->
                        <div id="logo" class="logo">
                            <a href="<?php echo base_url(); ?>"><img id="logo_img" src="<?php echo base_url('assets/images'); ?>/logo_blue.png" alt="<?php echo $settings->company_name; ?>"></a>
                        </div>

                        <!-- name-and-slogan -->
                        <div class="site-slogan"><?php echo $settings->slogan; ?></div>

                    </div>
                    <!-- header-first end -->

                </div>
                <div class="col-md-9">

                    <!-- header-second start -->
                    <!-- ================ -->
                    <div class="header-second clearfix">

                        <!-- main-navigation start -->
                        <!-- classes: -->
                        <!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
                        <!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
                        <!-- "with-dropdown-buttons": Mandatory class that adds extra space, to the main navigation, for the search and cart dropdowns -->
                        <!-- ================ -->
                        <div class="main-navigation  animated with-dropdown-buttons">

                            <!-- navbar start -->
                            <!-- ================ -->
                            <nav class="navbar navbar-default" role="navigation">
                                <div class="container-fluid">

                                    <!-- Toggle get grouped for better mobile display -->
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>

                                    </div>

                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                        <!-- main-menu -->
                                        <ul class="nav navbar-nav ml-xl-auto">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo base_url(); ?>">Anasayfa</a>
                                            </li>
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hakkımızda</a>
                                                <ul class="dropdown-menu">
                                                    <li ><a href="<?php echo base_url('hakkimizda'); ?>">Hakkımızda</a></li>
                                                    <li ><a href="<?php echo base_url('haberler'); ?>">Haberler</a></li>
                                                    <li ><a href="<?php echo base_url('portfolyolar'); ?>">Portfolyo</a></li>
                                                    <li ><a href="<?php echo base_url('referanslar'); ?>">Referanslar</a></li>
                                                    <li ><a href="<?php echo base_url('hizmetlerimiz'); ?>">Hizmetlerimiz</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Galeriler</a>
                                                <ul class="dropdown-menu">
                                                    <li ><a href="<?php echo base_url('fotograf-galerisi'); ?>">Resim Galerisi</a></li>
                                                    <li ><a href="<?php echo base_url('video-galerisi'); ?>">Video Galerisi</a></li>
                                                    <li ><a href="<?php echo base_url('dosya-galerisi'); ?>">Dosya Galerisi</a></li>
                                                </ul>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('urunler'); ?>">Ürünler</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('egitimler'); ?>">Eğitimler</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('markalar'); ?>">Markalar</a></li>
                                        </ul>
                                        <!-- main-menu end -->

                                        <!-- header buttons -->
                                        <div class="header-dropdown-buttons">
                                            <a href="<?php echo base_url('iletisim'); ?>" class="btn btn-sm hidden-xs btn-default">İletişim <i class="fa fa-envelope-o pl-5"></i></a>
                                            <a href="<?php echo base_url('iletisim'); ?>" class="btn btn-lg visible-xs btn-block btn-default">İletişim <i class="fa fa-envelope-o pl-5"></i></a>
                                        </div>
                                        <!-- header buttons end-->

                                    </div>

                                </div>
                            </nav>
                            <!-- navbar end -->

                        </div>
                        <!-- main-navigation end -->
                    </div>
                    <!-- header-second end -->

                </div>
            </div>
        </div>

    </header>
    <!-- header end -->
</div>
<!-- header-container end -->