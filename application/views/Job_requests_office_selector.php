<div class="input-field">
	<i class="material-icons">my_location</i>
	<select id="office-selector" class="dropSelect" name="office-selector" onchange="getUsers('<?php echo base_url();?>');">
        <option disabled selected> </option>
        <?php echo $options;?>
	</select>
</div>
