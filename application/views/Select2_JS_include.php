<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type = "text/javascript" src = "<?= base_url();?>assets/js/jquery-3.0.0.min.js"></script>
<script type = "text/javascript" src = "<?= base_url();?>assets/js/select2.full.min.js"></script>
<script type = "text/javascript" src = "<?= base_url();?>assets/js/materialize.min.js"></script>
<link rel = "stylesheet" href = "<?= base_url ();?>assets/css/select2-materialize.css">

<script type = "text/javascript">
    $(document).ready (function (){
        $("#office-selector").select2 ({
            placeholder: "Select an office",
            allowClear: true
        });
    });
</script>
