<?php
$alert = $this->session->userdata('alert');
if($alert){
    if($alert['type'] == 'success'){ ?>
        <script>
            notify('success','<?php echo $alert['title']; ?>', '<?php echo $alert['message']; ?>');
        </script>
        <?php
    } else{ ?>
        <script>
            notify('error','<?php echo $alert['title']; ?>', '<?php echo $alert['message']; ?>');
        </script>
        <?php
    }
}