<form method="post" id="form_login" action="<?php echo site_url("Admin/editProjectProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label for="project_cd">Project Cd</label>
        <input type="hidden" name="id" value="<?php echo $project->id;?>">
        <input type="text" class="form-control" id="project_cd" name="project_cd" value="<?php echo $project->project_cd;?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="project_name">Project Name</label>
        <input type="text" class="form-control" id="project_name" name ="project_name" value="<?php echo $project->project_name;?>">
      </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="project_type">Project Type</label>
        <div class="form-group col-xs-6">
            <select class="custom-select" id="project_type" style="width: 250px;" name="project_type" required>
              <?php 
                if ($alldata) {
                    foreach ($alldata as $key) {?>
                      <option value="<?php echo $key->type_desc;?>" <?php echo ($project->project_type == $key->type_desc)?'selected':'';?>><?php echo $key->type_desc;?></option>

              <?php
                    }
                }
              ?>
            </select>
          </div>
        </div>
      <div class="form-group col-md-6">
        <label for="district">District</label>
          <div class="col-xs-6">
              <select class="custom-select" id ="district" name="district" style="width: 250px;">
                <option value="Darjeeling" <?php echo ($project->dist
                  == 'Darjeeling')?'selected':'';?>>Darjeeling</option>

                <option value="Jalpaiguri" <?php echo ($project->dist
                  == 'Jalpaiguri')?'selected':'';?>>Jalpaiguri</option>

                <option value="Cooch Behar" <?php echo ($project->dist
                  == 'Cooch Behar')?'selected':'';?>>Cooch Behar</option>

                <option value="Malda" <?php echo ($project->dist
                  == 'Malda')?'selected':'';?>>Malda</option>

                <option value="Uttar Dinajpur" <?php echo ($project->dist
                  == 'Uttar Dinajpur')?'selected':'';?>>Uttar Dinajpur</option>

                <option value="Dakshin Dinajpur" <?php echo ($project->dist
                  == 'Dakshin Dinajpur')?'selected':'';?>>Dakshin Dinajpur</option>

                <option value="Alipurduar" <?php echo ($project->dist
                  == 'Alipurduar')?'selected':'';?>>Alipurduar</option>

                <option value="Kalimpong" <?php echo ($project->dist
                  == 'Kalimpong')?'selected':'';?>>Kalimpong</option>

                <option value="Bankura" <?php echo ($project->dist
                  == 'Bankura')?'selected':'';?>>Bankura</option>

                <option value="Paschim Bardhaman" <?php echo ($project->dist
                  == 'Paschim Bardhaman')?'selected':'';?>>Paschim Bardhaman</option>

                <option value="Purba Bardhaman" <?php echo ($project->dist
                  == 'Purba Bardhaman')?'selected':'';?>>Purba Bardhaman</option>

                <option value="Birbhum" <?php echo ($project->dist
                  == 'Birbhum')?'selected':'';?>>Birbhum</option>

                <option value="Purulia" <?php echo ($project->dist
                  == 'Purulia')?'selected':'';?>>Purulia</option>

                <option value="Murshidabad" <?php echo ($project->dist
                  == 'Murshidabad')?'selected':'';?>>Murshidabad</option>

                <option value="Nadia" <?php echo ($project->dist
                  == 'Nadia')?'selected':'';?>>Nadia</option>

                <option value="West Midnapore" <?php echo ($project->dist
                  == 'West Midnapore')?'selected':'';?>>West Midnapore</option>

                <option value="Jhargram" <?php echo ($project->dist
                  == 'Jhargram')?'selected':'';?>>Jhargram</option>

                <option value="East Midnapore" <?php echo ($project->dist
                  == 'East Midnapore')?'selected':'';?>>East Midnapore</option>

                <option value="Hooghly" <?php echo ($project->dist
                  == 'Hooghly')?'selected':'';?>>Hooghly</option>

                <option value="Howrah" <?php echo ($project->dist
                  == 'Howrah')?'selected':'';?>>Howrah</option>

                <option value="Kolkata" <?php echo ($project->dist
                  == 'Kolkata')?'selected':'';?>>Kolkata</option>

                <option value="North 24 Parganas" <?php echo ($project->dist
                  == 'North 24 Parganas')?'selected':'';?>>North 24 Parganas</option>

                <option value="South 24 Parganas" <?php echo ($project->dist
                  == 'South 24 Parganas')?'selected':'';?>>South 24 Parganas</option>

              </select>
          </div>
      </div>
    </div>
    <div class="form-row">
    Press "Save" below to modify this Project.
    </div>
      <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Save</button>
            </div>
</form>