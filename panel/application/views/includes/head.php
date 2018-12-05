<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="Admin, Dashboard, Bootstrap" />
<?php $settings = get_settings(); ?>
<!--<link rel="shortcut icon" sizes="196x196" href="<?php /*echo base_url('assets'); */?>/assets/images/logo.png">-->
<?php
if($settings->logo == 'default'){
    $favicon = base_url('assets/assets/images/logo.png');
} else{
    $favicon = get_media("setting_v", $settings->favicon, "32x32");
}
?>
<link rel="shortcut icon" sizes="196x196" href="<?php echo $favicon; ?>">
<title><?php echo $settings->company_name; ?></title>

<?php $this->load->view('includes/include_style'); ?>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var assets_url = '<?php echo base_url('assets');?>/';
</script>