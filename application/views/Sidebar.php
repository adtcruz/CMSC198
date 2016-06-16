<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class = "demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
	
	<header class = "demo-drawer-header">
		<?php
			$image = array (
					'src' => base_url ('assets/images/user.jpg'),
					'class' => 'demo-avatar'
				);
			echo img ($image);
		?>
		<div class = "demo-avatar-dropdown">
			<span>username</span>
			<div class = "mdl-layout-spacer"></div>
			<button id = "accbtn" class = "mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
				<i class = "material-icons" role = "presentation">arrow_drop_down</i>
				<span class = "visuallyhidden"> Actions </span>
			</button>
			<ul class = "mdl-menu mdl-menu--botton-right mdl-js-menu mdl-js-ripple-effect" for = "accbtn">
				<li class = "mdl-menu__item"> Logout </li>
			</ul>
		</div>
	</header>

	<nav class = "demo-navigation mdl-navigation mdl-color--blue-grey-800">
		<a class = "mdl-navigation__link">
			<i class = "mdl-color-text--blue-grey-400 material-icons" role = "presentation">home</i>
			Home
		</a>
		<a class = "mdl-navigation__link">
			<i class = "mdl-color-text--blue-grey-400 material-icons" role = "presentation">playlist_add</i>
			File Job Request
		</a>
		<a class = "mdl-navigation__link">
			<i class = "mdl-color-text--blue-grey-400 material-icons" role = "presentation">search</i>
			Search Job Request
		</a>
		<a class = "mdl-navigation__link">
			<i class = "mdl-color-text--blue-grey-400 material-icons" role = "presentation">help_outline</i>
			Help
		</a>
	</nav>
</div>