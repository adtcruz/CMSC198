<div class="row">
	<?php $this->load->view('Sidenav', $unread);?>
	<!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
	<div class="col s3 m3 l3"><br/><br/></div>
	<!-- MAIN CONTENT CONTAINER -->
	<div class="col s9 m9 l9">
		<div class="row">
			<div class="col s1 m1 l1">&nbsp;</div>
			<div class="col s10 m10 l10">
                <div class = "hide">
                    <span id="totalProcessed"><?=$total['processed'];?></span>
                    <span id="totalCanceled"><?=$total['canceled'];?></span>
                    <span id="totalProcessing"><?=$total['processing'];?></span>
                    <span id="totalPending"><?=$total['pending'];?></span>
                </div>
                <div id="jobStatusChart"></div>
            </div>
            <div class="col s1 m1 l1">&nbsp;</div>
		</div>

        <div class="row">
			<div class="col s1 m1 l1">&nbsp;</div>
			<div class="col s10 m10 l10">
                <div id="pieData" class="hide">
                    <?php
                        echo json_encode ($values);
                    ?>
                </div>
                <div id="totalWork"></div>
            </div>
            <div class="col s1 m1 l1">&nbsp;</div>
		</div>

        <div class="row">
			<div class="col s1 m1 l1">&nbsp;</div>
			<div class="col s10 m10 l10">
                <div id="pieData" class="hide">
                    <?php
                        echo json_encode ($income);
                    ?>
                </div>
                <div id="totalWork"></div>
            </div>
            <div class="col s1 m1 l1">&nbsp;</div>
		</div>
	</div>
</div>

</body>
</html>
