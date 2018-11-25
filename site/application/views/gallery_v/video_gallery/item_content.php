<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <h1 class="page-title"><?php echo $gallery->gallery_name; ?></h1>
                <div class="separator-2"></div>
                <div class="row grid-space-20">
                    <?php
                    if(!empty($videos)){
                        foreach($videos as $video){ ?>
                            <div class="col-xs-3 mb-20">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/91J8pLHdDB0"></iframe>
                                </div>
                            </div>
                        <?php
                        }
                    } else{ ?>
                        <div class="col-md-12">
                            <div class="alert alert-info text-center">
                                Bu galeriye eklenmiş görsel bulunamadı.
                            </div>
                            <a href="<?php echo base_url('video-galerisi'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>