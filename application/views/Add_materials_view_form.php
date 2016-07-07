

<div class="row">
  <?php $this->load->view('Sidenav');?>
  <div id="navarea" class="col s3 m3 l3 section"><br/><br/></div>
  <div id="mainc" class="col s9 m9 l9 section">
    <div class="row">
      <div class="col s1 m1 l1">&nbsp;</div>
      <div autocomplete="off" class="col s10 m10 l10">
        <br/>
        <h3 class="center-align">Add Recommended Material</h3>
        <br/>
                <?php
                /*
                * file: AddMaterials_view_form.php
                * This is the form for the AddMaterials module
                */
                    echo validation_errors ();

                    // load form helper
                    $this->load->helper ('form');

                    // set array variable for attributes
                    $attributes = array (
                        'id' => 'dateInput',
                        'method' => 'POST',
                        'name' => 'dateInput'
                    );

                    // instantiate form with name add_materials and attributes defined by the previously created variable
                    echo form_open ('add_materials', $attributes);

                    // close form
                ?>
            <div class="input-field col s6">
                <input id="materialName" name="materialName" type="text"/>
                <label id="materialNameLabel" for="materialName" data-error="This is a required field!">Material Name</label>
            </div>
            <div class="input-field col s3">
                <input id="materialCost" name="materialCost" type="text"/>
                <label id="materialCostLabel" for="materialCost" data-error="This is a required field!">Material Cost</label>
            </div>
            <div class="input-field col s3">
                <select>
                  <option value="" disabled selected>Choose your option</option>
                  <option value="1">meters</option>
                  <option value="2">piece/s</option>
                  <option value="3">units</option>
                </select>
                <label>Unit</label>
              </div>
        </br></br></br>
            <div class="input-field">
                <textarea id="materialDescription" name="materialDescription"class="materialize-textarea"></textarea>
                <label id="materialDescriptionLabel" for="materialDescription" data-error="This is a required field!">Material Description</label>
            </div>
            <div class="input-field col s10">  
                <div class="mdl-textfield mdl-js-textfield" align="right" >
                  <button class="btn waves-effect waves-light red" type="submit">Add Material To List
                  </button>
                </div>
            </div>
            <div class="input-field col s2">  
                <div class="mdl-textfield mdl-js-textfield" align="right" >
                  <button class="btn waves-effect waves-light red" type="reset">Reset
                  </button>
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

