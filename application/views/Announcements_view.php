<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $this->load->view ('Header');
    $this->load->view ('Sidenav');
?>

<div class="row">
    <div class="col s3 m3 l3"><br/></div>
    <div class="col s9 m9 l9">
        <ul class="tabs">
            <li class="tab col s12"><a href="#annAddTab"> annAddTab </a></li>
            <li class="tab col s12"><a href="#annViewTab"> annViewTab </a></li>
        </ul>
    </div>
    <div id="annAddTab" class="col s12"> annAddTab </div>
    <div id="annViewTab" class="col s12"> annViewTab </div>
</div>


<?php
    $this->load->view ('Common_scripts');
    $this->load->view ('Logout_script');
?>
<script type="text/javascript">
    $('document').ready(
        function ()
        {
            $('#annButton').addClass("black");
            $('ul.tabs').tabs();
        }
    );
</script>
</body>
</html>
