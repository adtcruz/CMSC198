<div class="input-field">
	<i class="material-icons large prefix">my_location</i>
	<select id="office-selector" name="office-selector" onchange="getUsers('<?php echo base_url();?>');">
		<?php echo $options;?>
	</select>
</div>