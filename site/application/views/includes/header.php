<?php $settings = get_settings(); ?>
<!-- header-container start -->
<div class="header-container">

    <!-- header-top start -->
    <!-- classes:  -->
    <!-- "dark": dark version of header top e.g. class="header-top dark" -->
    <!-- "colored": colored version of header top e.g. class="header-top colored" -->
    <!-- ================ -->
    <?php $this->load->view("includes/top_header"); ?>
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
                            <a href="<?php echo base_url(); ?>">
                                <?php
                                if($this->agent->is_mobile()){ ?>
                                    <img id="logo_img_mobile" src="<?php echo get_media("setting_v", $settings->logo_mobile, "300x70"); ?>" alt="<?php echo $settings->company_name; ?>">
                                <?php
                                } else{ ?>
                                    <img id="logo_img" src="<?php echo get_media("setting_v", $settings->logo, "150x35"); ?>" alt="<?php echo $settings->company_name; ?>">
                                <?php
                                }
                                ?>
                            </a>
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