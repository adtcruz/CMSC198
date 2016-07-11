<div class="row">
    <?php $this->load->view('Sidenav');?>
    <!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
    <div class="col s3 m3 l3"><br/><br/></div>
    <!-- MAIN CONTENT CONTAINER -->
    <div class="col s9 m9 l9">
        <div class="row">
            <div class="col s1 m1 l1">&nbsp;</div>
            <div class="col s10 m10 l10">
                <br/><br/>
                <div class="col s12 m12">
                    <!-- Lastest Jobs start -->
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <br/>
                            <h5 class="center-align">Recent Job Requests</h5>
                            <?php
                                $template = array ('table_open' => '<table class = "bordered">');
                                $this->table->set_template ($template);
                                $this->table->set_heading ('Job Description', 'Date Submitted', 'Status');
                                foreach ($latestJobs as $row)
                                {
                                    $this->table->add_row ($row['description'], $row['dateCreated'], $row['status']);
                                }
                                echo $this->table->generate ();
                                $this->table->clear ();
                            ?>
                        </div>
                    </div>
                    <!-- Lastest Jobs end -->

                    <!-- Top 5 Common Problems -->
                    <div class="col s12 m6 l6">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <br/>
                                <h5 class="center-align">Common Problems</h5>
                                <?php
                                    $template = array ('table_open' => '<table class = "bordered centered">');
                                    $this->table->set_template ($template);
                                    $this->table->set_heading ('Description');
                                    foreach ($mostCommonProblems as $row)
                                    {
                                        $this->table->add_row ($row['description'].' ('.$row['count'].')');
                                    }
                                    echo $this->table->generate ();
                                    $this->table->clear ();
                                ?>
                            </div>
			            </div>
                    </div>

                    <!-- Some Work Rates -->
                    <div class="col s12 m6 l6">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <br/>
                                <h5 class="center-align">Work Rates</h5>
                                <?php
                                    $template = array ('table_open' => '<table class = "bordered centered">');
                                    $this->table->set_template ($template);
                                    $this->table->set_heading ('Work', 'Rate');
                                    foreach ($services as $row)
                                    {
                                        $serviceRate = $row['serviceRate'];
                                        if ($serviceRate === '0')
                                        {
                                            $serviceRate = 'Free';
                                        }
                                        $this->table->add_row ($row['serviceName'], $serviceRate);
                                    }
                                    echo $this->table->generate ();
                                    $this->table->clear ();
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Some Work Rates -->
                </div>
            </div>
            <div class="col s1 m1 l1">&nbsp;</div>
            <div class="row"></div>
        </div>
    </div>
</div>
