<?php
$alert = $this->session->userdata('alert');
if($alert){ ?>
    <script>
        notify('<?php echo $alert['type']; ?>','<?php echo $alert['title']; ?>', '<?php echo $alert['message']; ?>');
    </script>
<?php
}