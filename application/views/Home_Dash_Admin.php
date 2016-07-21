<div class="row">
  <?php $this->load->view('Sidenav', $unread);?>
  <!-- MAIN CONTENT CONTAINER -->
  <div class="container">
    <div class="row">
      <!-- Announcements start -->
      <div class="col s12 m12 l12">
        <div class="card grey">
          <div class="card-content white-text">
            <div class = "slider">
                <?php
                    $tiles = array ();
                    foreach ($announcements['announcements'] as $row)
                    {
                        $tile = '<img/><div class = "caption black-text" style = "text-align: justify; text-justify: inter-word"><h5>'.$row['title'].'</h5><h6 class = "truncate">'.$row['details'].'</h6></div>';
                        $tiles[] = $tile;
                    }
                    $attributes = array ('class' => 'slides');
                    echo ul ($tiles, $attributes);
                ?>
            </div>
          </div>
        </div>
      </div>
      <!-- Announcements end -->
      <div class="col s12 m12 l12">
        <!-- Schedule start -->
        <div class="card grey lighten-2">
          <div class="card-content black-text">
            <h5 class="card-title">Today's Schedule</h5>
            <?php
                $this->table->set_template (array ('class' => 'bordered'));
                $this->table->set_heading ('Priority', 'Job Description', 'Client Name', 'Office');
                if (empty($schedule['schedule']))
                {
                    // make this a bit attractive
                    echo 'There are no scheduled jobs for today';
                }
                else
                {
                    foreach ($schedule['schedule'] as $row)
                    {
                        switch ($row['priority'])
                        {
                            case '1': $priority = 'Normal';
                            break;
                            case '2': $priority = 'Urgent';
                            break;
                            case '3': $priority = 'Very Urgent';
                            break;
                        }
                        $this->table->add_row ($priority, $row['jobDescription'], $row['givenName'].' '.$row['lastName'], $row['officeName']);
                    }
                    echo $this->table->generate ();
                }
            ?>
          </div>
        </div>
        <!-- Schedule end -->
      </div>
    </div>
  </div>
</div>
