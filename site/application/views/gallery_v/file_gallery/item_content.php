<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <h1 class="page-title"><?php echo $gallery->gallery_name; ?></h1>
                <div class="separator-2"></div>
                <div class="row grid-space-20">
                    <?php
                    if(!empty($files)){ ?>
                        <table class="table table-hover table-striped table-bordered table-colored">
                            <thead>
                            <th>Dosya Adı</th>
                            <th>İndir</th>
                            </thead>
                            <tbody>
                            <?php
                            foreach($files as $file){ ?>
                                <tr>
                                    <td><?php echo $file->url; ?></td>
                                    <td style="width: 100px;">
                                        <a target="_blank"
                                           href="<?php echo base_url("panel/uploads/$viewFolder/files/$gallery->folder_name/$file->url"); ?>"
                                           download="CMS-<?php echo $file->url; ?>"
                                           class="btn btn-animated btn-default">İndir<i class="pl-10 fa fa-download"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php
                    } else{ ?>
                        <div class="col-md-12">
                            <div class="alert alert-info text-center">
                                Bu galeriye eklenmiş dosya bulunamadı.
                            </div>
                            <a href="<?php echo base_url('dosya-galerisi'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>