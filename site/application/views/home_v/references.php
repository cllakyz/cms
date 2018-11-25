<?php $settings = get_settings(); ?>
<section class="section clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h2>Neden Bizi <strong>Tercih Etmelisiniz?</strong></h2>
                <div class="separator"></div>
                <p><?php echo $settings->homepage_reference; ?></p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="clients-container">
                    <div class="clients">
                        <?php
                        foreach($references as $reference){ ?>
                            <div class="client-image object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">
                                <a href="<?php echo base_url("referans-detay/$reference->url"); ?>"><img src="<?php echo get_media("reference_v", $reference->img_url, "80x80"); ?>" alt="<?php echo $reference->title; ?>"></a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="separator"></div>
            </div>
        </div>
    </div>
</section>