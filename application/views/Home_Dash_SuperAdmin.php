<div class="row">
	<?php $this->load->view('Sidenav', $unread);?>
	<div class="container">
		<div>
			<ul class="tabs">
				<li class="tab"><a class="active" href="#jobCountChart">Job Requests Count</a></li>
				<li class="tab"><a href="#totalWorkDoneChart">Total Work Done</a></li>
				<li class="tab"><a href="#monthlyIncomeChart">Monthly Income</a></li>
			</ul>
			<br/>
		</div>
		<!-- job status chart start -->
		<div id="jobCountChart">
			<div class="col s12 m12 l12">
				<div class="card grey lighten-2">
					<div class="card-content white-text">
						<div id="jobStatusChart"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- job status chart end -->
		<!-- total work chart start -->
		<div id="totalWorkDoneChart">
			<div class="col s12 m12 l12">
				<div class="card grey lighten-2">
					<div class="card-content white-text">
						<div id="totalWork"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- total work chart end -->
		<!-- monthly income chart start -->
		<div id="monthlyIncomeChart">
			<div class="col s12 m12 l12">
				<div class="card grey lighten-2">
					<div class="card-content white-text">
						<div id="monthlyIncome"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- monthly income chart end -->
	</div>
</div>

<div class = "hide">
	<span id="totalProcessed"><?=$total['processed'];?></span>
	<span id="totalCanceled"><?=$total['canceled'];?></span>
	<span id="totalProcessing"><?=$total['processing'];?></span>
	<span id="totalPending"><?=$total['pending'];?></span>
</div>
<div id="pieData" class="hide">
	<?php
			echo json_encode ($values);
	?>
</div>
<div id="incomeData" class="hide">
		<?php
				echo json_encode ($income);
		?>
</div>
