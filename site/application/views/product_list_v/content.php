<section class="main-container">
    <div class="container">
        <h1 class="page-title">Ürünler</h1>
        <p>Kullandığımız ürünlerin listesini aşağıda görebilirsiniz</p>
        <div class="separator-2"></div>
        <div class="row">
            <?php
            if(!empty($products)){
                foreach($products as $product){ ?>
                    <div class="col-sm-4">
                        <div class="image-box style-2 mb-20 bordered light-gray-bg">
                            <div class="overlay-container overlay-visible">
                                <?php
                                $image = get_product_cover_image($product->id);
                                ?>
                                <img src="<?php echo get_media("product_v", $image, "348x215"); ?>" alt="<?php echo $product->title; ?>">
                                <div class="overlay-bottom text-left">
                                    <p class="lead margin-clear"><?php echo $product->title; ?></p>
                                </div>
                            </div>
                            <div class="body">
                                <p><?php echo character_limiter(strip_tags($product->description), 30); ?></p>
                                <a href="<?php echo base_url('urun-detay/'.$product->url); ?>" class="btn btn-default btn-sm btn-hvr hvr-sweep-to-right margin-clear">Görüntüle<i class="fa fa-arrow-right pl-10"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else{ ?>
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        Ürünler bulunamadı.
                    </div>
                    <a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>