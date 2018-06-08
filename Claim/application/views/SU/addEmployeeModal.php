
<script src="<?php echo base_url('js/jquery.maskedinput.js'); ?>" type="text/javascript"></script>
<script>
  $(document).ready(function($){
      $("#dp1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dp1").css({"placeholder":"opacity:0.4"});
});
</script>
<script>
  $(document).ready(function($){
      $("#dp2").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dp2").css({"placeholder":"opacity:0.4"});
});

$(document).ready(function($){    
    $('#dp1').datepicker({
        format: 'dd/mm/yyyy',
        endDate: "today"
      });
    });
</script>

<style>
.datepicker{z-index:1151 !important;}
</style>



<form method="post" id="form_login" action="<?php echo site_url("Admin/addEmployeeProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label for="emp_no">Employee Number</label>
        <input type="text" class="form-control" id="emp_no" name="emp_no" placeholder="No." required>
      </div>
      <div class="form-group col-md-6">
        <label for="emp_name">Employee Name</label>
        <input type="text" class="form-control" id="emp_name" name ="emp_name" placeholder="Full Name" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="designation">Employee's Designation</label>
          <div class="col-xs-6">
              <select class="custom-select" id ="designation" name="designation" required>
                <option value="Accountant">Accountant</option>
                <option value="CTO">CTO</option>
                <option value="Data Entry Operator">Data Entry Operator</option>
                <option value="Director">Director</option>
                <option value="Manager">Manager</option>
                <option value="Marketing Executive">Marketing Executive</option>
                <option value="Office Staff">Office Staff</option>
                <option value="Project Manager">Project Manager</option>
                <option value="General Manager">General Manager</option>
                <option value="Purchase Manager">Purchase Manager</option>
                <option value="Senior Software Engineer">Senior Software Engineer</option>
                <option value="Senior Accountant">Senior Accountant</option>
                <option value="Service Engineer">Service Engineer</option>
                <option value="Software Engineer">Software Engineer</option>
                <option value="Software Trainee Engineer">Software Trainee Engineer</option>
                <option value="Team Leader">Team Leader</option>
                <option value="Telecaller">Telecaller</option>  
              </select>
          </div>
      </div>
      <div class="form-group col-md-6">
          <label for="inputPassword4">Date of Joining</label>
            <div class="input-group">
                <input class="form-control" id="dp1" name="date1" placeholder="DD/MM/YYYY" type="text" required>
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
            </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="sector">Sector</label>
        <div class="form-group col-xs-6">
            <select class="custom-select" id="sector" name="sector" style="width: 250px;" required>
              <option value="Accounts">Accounts</option>
              <option value="Administration">Administration</option>
              <option value="Hardware Technical">Hardware Technical</option>
              <option value="Sales and Marketing">Sales and Marketing</option>
              <option value="Software Technical">Software Technical</option>
              <option value="Production">Production</option>
              <option value="Others">Others</option>
            </select>
          </div>
        </div> 
      <div class="form-group col-md-6">
        <label for="status">Employee's Status</label>
        <div class="form-group col-xs-6">
            <select class="custom-select" id="status" name="status" style="width: 250px;" required>
              <option value="1">Active Member</option>
              <option value="0">Inactive Member</option>
            </select>
          </div>
        </div>    
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputPassword4">Date of Termination</label>
          <div class="input-group" id="dil">
             <input class="form-control" id="dp2" name="date2" placeholder="DD/MM/YYYY" type="text">
              <div class="input-group-addon">
                <i class="fa fa-calendar">
                </i>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
</form>

