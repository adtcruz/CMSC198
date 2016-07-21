<div class="grey darken-4">
	<br/>
	<div class="container">
		<br/>
		<div class="row">
			<div class="container white z-depth-5">
				<br/>
				<div class="row center-align">
					<h3>ITC Networking Services and Billing System</h3>
				</div>
				<div class="row center-align">
					<div class="col s1 m1 l1">&nbsp;</div>
					<div autocomplete="off" class="white black-text col s10 m10 l10">
						<!-- Username Input Field -->
						<div class="row input-field">
							<i class="material-icons prefix">account_circle</i>
							<input id="usernameInput" name="usernameInput" type="text" onkeyup="logInFormOnChange();" onchange="logInFormOnChange();"/>
							<label id="usernameInputLabel" for="usernameInput" data-error="Invalid credentials. Please check your credentials and try again.">Username</label>
						</div>
						<!-- Password Input Field -->
						<div class="row input-field">
							<i class="material-icons prefix">vpn_key</i>
							<input id="passwordInput" name="passwordInput" type="password" onkeyup="logInFormOnChange();" onchange="logInFormOnChange();"/>
							<label id="passwordInputLabel" for="passwordInput" data-error="Invalid credentials. Please check your credentials and try again.">Password</label>
						</div>
					</div>
					<div class="col s1 m1 l1">&nbsp;</div>
				</div>
				<!-- Login Button -->
				<div class="row center-align">
					<a class="waves-effect waves-light btn green darken-4" onclick="logIn('<?php echo base_url();?>');">Log-In&nbsp;<i class="material-icons right">lock_open</i></a>
				</div>
				<br/>
			</div>
			</div>
		<br/>
	</div>
</div>
