<div class="banner dark-translucent-bg" style="background-image:url('<?php echo base_url("panel/uploads/service_v/$service->img_url"); ?>'); background-position: 50% 21%;"></div>
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="main-container padding-ver-clear">
                    <div class="container pv-40">
                        <div class="row">
                            <div class="main col-md-12">
                                <h1 class="title"><?php echo $service->title; ?></h1>
                                <div class="separator-2"></div>
                                <p><?php echo strip_tags($service->description); ?></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>