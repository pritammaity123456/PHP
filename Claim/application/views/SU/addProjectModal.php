
<form method="post" id="form_login" action="<?php echo site_url("Admin/addProjectProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label for="project_cd">Project Cd</label>
        <input type="text" class="form-control" id="project_cd" name="project_cd" value="<?php echo $maxCode->project_cd + 1;?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="project_name">Project Name</label>
        <input type="text" class="form-control" id="project_name" name ="project_name" placeholder="Full Name" required>
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
                      <option value="<?php echo $key->type_desc?>"><?php echo $key->type_desc;?></option>

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
              <select class="custom-select" id ="district" name="district" style="width: 250px;" required>
                <option value="Darjeeling">Darjeeling</option>
                <option value="Jalpaiguri">Jalpaiguri</option>
                <option value="Cooch Behar">Cooch Behar</option>
                <option value="Malda">Malda</option>
                <option value="Uttar Dinajpur">Uttar Dinajpur</option>
                <option value="Dakshin Dinajpur">Dakshin Dinajpur</option>
                <option value="Alipurduar">Alipurduar</option>
                <option value="Kalimpong">Kalimpong</option>
                <option value="Bankura">Bankura</option>
                <option value="Paschim Bardhaman">Paschim Bardhaman</option>
                <option value="Purba Bardhaman">Purba Bardhaman</option>
                <option value="Birbhum">Birbhum</option>
                <option value="Purulia">Purulia</option>
                <option value="Murshidabad">Murshidabad</option>
                <option value="Nadia">Nadia</option>
                <option value="West Midnapore">West Midnapore</option>
                <option value="Jhargram">Jhargram</option>
                <option value="East Midnapore">East Midnapore</option>
                <option value="Hooghly">Hooghly</option>
                <option value="Howrah">Howrah</option>
                <option value="Kolkata">Kolkata</option>
                <option value="North 24 Parganas">North 24 Parganas</option>
                <option value="South 24 Parganas">South 24 Parganas</option>
              </select>
          </div>
      </div>
    </div>
    <div class="form-row">
     
    </div>
      <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
</form>
  <script type="text/javascript">
  $('#dp1').datepicker({
      format: 'dd/mm/yyyy'
    });
  $('#dp2').datepicker({
      format: 'dd/mm/yyyy'
    });
</script>