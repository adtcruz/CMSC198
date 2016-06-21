<div class="row">
	<?php $this->load->view('Sidenav');?>
	<!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
	<div class="col s3 m3 l3"><br/><br/></div>
	<!-- MAIN CONTENT CONTAINER -->
	<div class="col s9 m9 l9">
		<div class="row">
			<br/>
			<h3 class="center-align"><?php if($_SESSION["type"]==="client") echo "My ";?>Job Requests</h3>
			<br/>
			<br/>
			<?php echo $table;?>
		</div>
	</div>
</div>