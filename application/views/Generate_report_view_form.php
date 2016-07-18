<div class="row">
    <?php $this->load->view('Sidenav', $unread);?>
    <div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
        <div id="mainc" class="col s9 m9 l9 section">
            <div class="row">
                <div class="col s1 m1 l1">&nbsp;</div>
                    <div autocomplete="off" class="col s10 m10 l10">
                        <br/>
                        <h3 class="center-align">Generate Report</h3>
                        <br/>
                        <?php
                            $this->load->helper ('form');
                            echo validation_errors ();
                            /*
                                form_open (target, attributes_arr)
                            */

                            $attributes = array (
                                'id' => 'dateInput',
                                'method' => 'POST',
                                'name' => 'dateInput'
                            );
                            echo form_open ('generate_report', $attributes);
                        ?>
                        <div class="input-field col s6">
                            <input id="date1" name="date1" type="text"/>
                            <label id="date1Label" for="date1" data-error="This is a required field!">Date 1</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="date2" name="date2" type="text" />
                            <label id="date2Label" for="date2" data-error="This is a required field!">Date 2</label>
                        </div>
                        <div class="input-field col s10">
                            <div class="mdl-textfield mdl-js-textfield" align="right" >
                                <button class="btn waves-effect waves-light red" type="submit">Generate Report</button>
                            </div>
                        </div>
                        <div class="input-field col s2">
                            <div class="mdl-textfield mdl-js-textfield" align="right" >
                                <button class="btn waves-effect waves-light red" type="reset">Reset</button>
                            </div>
                        </div>
                        <?php echo form_close (); ?>
                        <br/>
                        <br/>
                    </div>
                    <div class="col s1 m1 l1">&nbsp;</div>
                </div>
            </div>
        </div>
</body>
</html>
