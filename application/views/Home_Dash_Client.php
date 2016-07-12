<div class="row">
    <!-- LOAD SIDENAV -->
    <?php $this->load->view('Sidenav');?>

    <!-- FILLER TO PUSH MAIN CONTENT TO THE RIGHT -->
    <div class="col s3 m3 l3"><br/><br/></div>

    <!-- MAIN CONTENT CONTAINER -->
    <div class="col s9 m9 l9">
        <div class="row">
            <div class="col s1 m1 l1">&nbsp;</div>
            <div class="col s12 m12 l12">
                <div class="col s12 m12">
                    <!-- Lastest Jobs start -->
                    <div class="card grey">
                        <div class="card-content white-text">
                            <div class = "slider">
                                <?php
                                    $tiles = array ();
                                    foreach ($announcements['announcements'] as $row)
                                    {
                                        $tile = '<img/><div class = "caption black-text" style = "text-align: justify; text-justify: inter-word"><h4>'.$row['title'].'</h4><h6 class = "truncate">'.$row['details'].'</h6></div>';
                                        $tiles[] = $tile;
                                    }
                                    $attributes = array ('class' => 'slides');
                                    echo ul ($tiles, $attributes);
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Lastest Jobs end -->

                    <!-- Some Work Rates -->
                    <div class="col s12 m6 l6">
                        <div class="card grey lighten-2">
                            <div class="card-content black9-text">
                                <br/>
                                <h5 class="center-align">Work Rate</h5>
                                <?php
                                    $template = array ('table_open' => '<table class = "bordered centered">');
                                    $this->table->set_template ($template);
                                    $this->table->set_heading ('Work', 'Rate');
                                    foreach ($clientData['services'] as $row)
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
                    <!-- Some Work Rates end -->

                    <!-- Latest Job Requests -->
                    <div class="col s12 m6 l6">
                        <div class="card grey lighten-2">
                            <div class="card-content black-text">
                                <br/>
                                <h5 class="center-align">Latest Job Requests</h5>
                                <?php
                                    $template = array ('table_open' => '<table class = "bordered">');
                                    $this->table->set_template ($template);
                                    $this->table->set_heading ('Job Description', 'Date Submitted', 'Status');
                                    foreach ($clientData['latestJobs'] as $row)
                                    {
                                        switch ($row['status'])
                                        {
                                            case 'PENDING':
                                                $text = '<span class = "blue-text">'.$row['status'].'</span>';
                                            break;
                                            case 'PROCESSING':
                                                $text = '<span class = "orange-text">'.$row['status'].'</span>';
                                            break;
                                            case 'CANCELLED':
                                                $text = '<span class = "red-text">'.$row['status'].'</span>';
                                            break;
                                            case 'PROCESSED':
                                                $text = '<span class = "green-text">'.$row['status'].'</span>';
                                            break;
                                        }
                                        $this->table->add_row ($row['description'], $row['dateCreated'], $text);
                                    }
                                    echo $this->table->generate ();
                                    $this->table->clear ();
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Latest Jobs end -->
                </div>
            </div>
            <div class="col s1 m1 l1">&nbsp;</div>
            <div class="row"></div>
        </div>
    </div>
</div>
