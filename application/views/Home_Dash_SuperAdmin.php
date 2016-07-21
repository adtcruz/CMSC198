<div class="row">
	<?php $this->load->view('Sidenav', $unread);?>
	<div class="container">
		<div class="row">
	    <div class = "hide">
        <span id="totalProcessed"><?=$total['processed'];?></span>
        <span id="totalCanceled"><?=$total['canceled'];?></span>
        <span id="totalProcessing"><?=$total['processing'];?></span>
        <span id="totalPending"><?=$total['pending'];?></span>
	    </div>
	    <div id="jobStatusChart"></div>
		</div>

    <div class="row">
	    <div id="pieData" class="hide">
	        <?php
	            echo json_encode ($values);
	        ?>
	    </div>
	    <div id="totalWork"></div>
		</div>

    <div class="row">
	    <div id="pieData" class="hide">
	        <?php
	            echo json_encode ($income);
	        ?>
	    </div>
	    <div id="totalWork"></div>
		</div>
	</div>
</div>

</body>
</html>
