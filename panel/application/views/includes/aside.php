<?php $user = is_login(); ?>
<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="<?php echo base_url(); ?>"><img class="img-responsive" src="<?php echo base_url('assets'); ?>/assets/images/221.jpg" alt="<?php echo $user->full_name; ?>"/></a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username"><?php echo $user->full_name; ?></a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>İşlemler</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="<?php echo base_url(); ?>">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Anasayfa</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("user/edit_form/".$user->id); ?>">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>Profilim</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url('logout'); ?>">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Çıkış</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">
                <?php
                if(isAllowedViewModule("dashboard")){ ?>
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("setting")){ ?>
                    <li>
                        <a href="<?php echo base_url('setting'); ?>">
                            <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
                            <span class="menu-text">Site Ayarları</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("email")){ ?>
                    <li>
                        <a href="<?php echo base_url('email'); ?>">
                            <i class="menu-icon zmdi zmdi-email zmdi-hc-lg"></i>
                            <span class="menu-text">E-Posta Ayarları</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("gallery")){ ?>
                    <li>
                        <a href="<?php echo base_url('gallery'); ?>">
                            <i class="menu-icon zmdi zmdi-apps zmdi-hc-lg"></i>
                            <span class="menu-text">Galeriler</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("slide")){ ?>
                    <li>
                        <a href="<?php echo base_url("slide"); ?>">
                            <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
                            <span class="menu-text">Slider</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("product")){ ?>
                    <li>
                        <a href="<?php echo base_url('product'); ?>">
                            <i class="menu-icon fa fa-cubes"></i>
                            <span class="menu-text">Ürünler</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("service")){ ?>
                    <li>
                        <a href="<?php echo base_url('service'); ?>">
                            <i class="menu-icon fa fa-cutlery"></i>
                            <span class="menu-text">Hizmetlerimiz</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("portfolio_category") || isAllowedViewModule("portfolio")){ ?>
                    <li class="has-submenu">
                        <a href="javascript:void(0)" class="submenu-toggle">
                            <i class="menu-icon fa fa-asterisk"></i>
                            <span class="menu-text">Portfolyolar</span>
                            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                        </a>
                        <ul class="submenu">
                            <?php
                            if(isAllowedViewModule("portfolio_category")){ ?>
                                <li><a href="<?php echo base_url('portfolio_category'); ?>"><span class="menu-text">Portfolyo Kategorileri</span></a></li>
                            <?php
                            }
                            if(isAllowedViewModule("portfolio")){ ?>
                                <li><a href="<?php echo base_url('portfolio'); ?>"><span class="menu-text">Portfolyo</span></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                <?php
                }

                if(isAllowedViewModule("news")){ ?>
                    <li>
                        <a href="<?php echo base_url('news'); ?>">
                            <i class="menu-icon fa fa-newspaper-o"></i>
                            <span class="menu-text">Haberler</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("course")){ ?>
                    <li>
                        <a href="<?php echo base_url('course'); ?>">
                            <i class="menu-icon fa fa-calendar"></i>
                            <span class="menu-text">Eğitimler</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("reference")){ ?>
                    <li>
                        <a href="<?php echo base_url('reference'); ?>">
                            <i class="menu-icon zmdi zmdi-check zmdi-hc-lg"></i>
                            <span class="menu-text">Referanslar</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("brand")){ ?>
                    <li>
                        <a href="<?php echo base_url('brand'); ?>">
                            <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
                            <span class="menu-text">Markalar</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("user")){ ?>
                    <li>
                        <a href="<?php echo base_url('user'); ?>">
                            <i class="menu-icon fa fa-user-secret"></i>
                            <span class="menu-text">Kullanıcılar</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("user_role")){ ?>
                    <li>
                        <a href="<?php echo base_url('user_role'); ?>">
                            <i class="menu-icon fa fa-eye"></i>
                            <span class="menu-text">Yetki Grupları</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("member")){ ?>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text">Aboneler</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("testimonial")){ ?>
                    <li>
                        <a href="<?php echo base_url('testimonial'); ?>">
                            <i class="menu-icon fa fa-comments"></i>
                            <span class="menu-text">Ziyaretçi Notları</span>
                        </a>
                    </li>
                <?php
                }

                if(isAllowedViewModule("popup")){ ?>
                    <li>
                        <a href="<?php echo base_url('popup'); ?>">
                            <i class="menu-icon zmdi zmdi-lamp zmdi-hc-lg"></i>
                            <span class="menu-text">Popup Hizmeti</span>
                        </a>
                    </li>
                <?php
                }
                ?>

                <li class="menu-separator"><hr></li>

                <li>
                    <a href="documentation.html">
                        <i class="menu-icon zmdi zmdi-view-web zmdi-hc-lg"></i>
                        <span class="menu-text">Ana sayfa</span>
                    </a>
                </li>

            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>