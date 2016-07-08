<!--
- file: Manage_application_materials_services.php
-   This is a view that displays the cards for 'Selectable Materials' and 'Selectable Services'
-   in the 'Manage Application' module.
-->

<div class = "row">
    <div class = "col s12 m6 l6">
        <!-- card definition for 'Selectable Services' -->
        <div class = "card grey lighten-2">
            <div class = "card-content black-text">
                <span class = "card-title"><i class = "material-icons">settings</i> Selectable Services</span>
            </div>
            <div class = "card-action center-align">
                <a class = "blue-text" href="<?php echo base_url();?>manage_selectable_work">Manage Selectable Services</a>
            </div>
        </div>
        <!-- end of card definition -->
    </div>
    <div class = "col s12 m6 l6">
        <!-- card definition for 'Selectable Materials' -->
        <div class = "card grey lighten-2">
            <div class = "card-content black-text">
                <span class = "card-title center-align"><i class = "material-icons">shopping_cart</i> Selectable Materials </span>
            <br/>
            </div>
            <div class = "card-action center-align">
                <a class = "blue-text" href="<?php echo base_url();?>manage_selectable_materials">Manage Selectable Materials</a>
            </div>
        </div>
        <!-- end of card definition -->
    </div>
</div>

<!-- end of file -->
