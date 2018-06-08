
<form method="post" id="form_login" action="<?php echo site_url("Admin/editEmployeeProcess")?>">
	<?php foreach ($employee as $employee) {  ?>
	          <div class="form-group">
	            <div class="form-row">
	            	<div class="col-md-6">
		                <label for="empName">Employee Name</label>
		                <input type="hidden" name="empid" value="<?php echo $employee->emp_no;?>">
		                <input class="form-control" name="empName" id="empName" type="text" aria-describedby="nameHelp" value="<?php echo $employee->emp_name;?>">
	              	</div>
	            	<div class="form-group col-md-6">
	            		<label for="exampleInputEmail1">Designation</label>
	            		<div class="col-xs-6">
	            			<select class="custom-select" id ="designation" name="designation">
	            				<option value="Accountant" <?php echo ($employee->designation
 									== 'Accountant')?'selected':'';?>>Accountant</option>

					            <option value="CTO" <?php echo ($employee->designation
 									== 'CTO')?'selected':'';?>>CTO</option>

					            <option value="Data Entry Operator" <?php echo ($employee->designation
 									== 'Data Entry Operator')?'selected':'';?>>Data Entry Operator</option>

					            <option value="Director" <?php echo ($employee->designation
 									== 'Director')?'selected':'';?>>Director</option>

					            <option value="Manager"<?php echo ($employee->designation
 									== 'Manager')?'selected':'';?>>Manager</option>

					            <option value="Marketing Executive"<?php echo ($employee->designation
 									== 'Marketing Executive')?'selected':'';?>>Marketing Executive</option>

					            <option value="Office Staff"<?php echo ($employee->designation
 									== 'Office Staff')?'selected':'';?>>Office Staff</option>

					            <option value="Project Manager"<?php echo ($employee->designation
 									== 'Project Manager')?'selected':'';?>>Project Manager</option>

 								<option value="General Manager"<?php echo ($employee->designation
 									== 'General Manager')?'selected':'';?>>General Manager</option>	

					            <option value="Purchase Manager"<?php echo ($employee->designation
 									== 'Purchase Manager')?'selected':'';?>>Purchase Manager</option>

					            <option value="Senior Software Engineer"<?php echo ($employee->designation
 									== 'Senior Software Engineer')?'selected':'';?>>Senior Software Engineer</option>

					            <option value="Senior Accountant"<?php echo ($employee->designation
 									== 'Senior Accountant')?'selected':'';?>>Senior Accountant</option>

					            <option value="Service Engineer"<?php echo ($employee->designation
 									== 'Service Engineer')?'selected':'';?>>Service Engineer</option>

					            <option value="Software Engineer"<?php echo ($employee->designation
 									== 'Software Engineer')?'selected':'';?>>Software Engineer</option>

					            <option value="Software Trainee Engineer"<?php echo ($employee->designation
 									== 'Software Trainee Engineer')?'selected':'';?>>Software Trainee Engineer</option>

					            <option value="Team Leader"<?php echo ($employee->designation
 									== 'Team Leader')?'selected':'';?>>Team Leader</option>

 								<option value="Telecaller"<?php echo ($employee->designation
 									== 'Telecaller')?'selected':'';?>>Telecaller</option>  
              				</select>
	          			</div>
	            	</div>		
	          	</div>
	          	<div class="form-row">
      				<div class="form-group col-md-6">
          				<label for="inputPassword4">Date of Joining</label>
            				<div class="input-group">
              					<div class="input-group-addon">
                					<i class="fa fa-calendar"></i>
              					</div>
                					<input class="form-control" id="dp1" name="date1" type="text" value="<?php echo date('d/m/Y',strtotime($employee->date_of_joining));?>" placeholder="DD/MM/YYYY">
            				</div>
      				</div>
      				<div class="form-group col-md-6">
      					<label for="status">Employee's Status</label>
        					<div class="form-group col-xs-6">
            					<select class="custom-select" id ="status" name="status" style="width: 250px;">
              						<option value="1" <?php echo $employee->status_flag?'selected':'';?>>Active Member</option>
              						<option value="0" <?php echo $employee->status_flag?'':'selected';?>>Inactive Member</option>
            					</select>
          					</div>
          			</div>
        		</div>

	            <div class="form-row">
	            	<div class="form-group col-md-6">
          				<label for="sector">Sector</label>
          					<div class="form-group col-xs-6">
					            <select class="custom-select" id="sector" name="sector" style="width: 250px;" required>
					              <option value="Accounts" <?php echo ($employee->sector == 'Accounts')?'selected':'' ?>>Accounts</option>
					              <option value="Administration" <?php echo ($employee->sector == 'Administration')?'selected':'' ?>>Administration</option>
					              <option value="Hardware Technical" <?php echo ($employee->sector == 'Hardware Technical')?'selected':'' ?>>Hardware Technical</option>
					              <option value="Sales and Marketing" <?php echo ($employee->sector == 'Sales and Marketing')?'selected':'' ?>>Sales and Marketing</option>
					              <option value="Software Technical" <?php echo ($employee->sector == 'Software Technical')?'selected':'' ?>>Software Technical</option>
					              <option value="Production" <?php echo ($employee->sector == 'Production')?'selected':'' ?>>Production</option>
					              <option value="Others" <?php echo ($employee->sector == 'Others')?'selected':'' ?>>Others</option>
					            </select>
					         </div>
        			</div>
			        <div class="form-group col-md-6">
			        	<label for="dp2">Date of Termination</label>
			          		<div class="input-group">
			              		<div class="input-group-addon">
			                		<i class="fa fa-calendar">
			                		</i>
			              		</div>
			                	<input class="form-control" id="dp2" name="date2" type="text" value="<?php if($employee->date_of_termination > '2002-01-01'){ echo date('d/m/Y',strtotime($employee->date_of_termination));}else{echo "";}?>" placeholder="DD/MM/YYYY">
			                </div>
			        </div>
	            </div>
	          </div>
	          <?php
	      }
	          ?>
          		Press "Save" below after modification.
          		<div class="modal-footer">
            	<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            	<button class="btn btn-primary" href="<?php echo site_url('Admin/editEmployeeProcess');?>">Save</button>
            </div>
    </form>

<script src="<?php echo base_url('js/jquery.maskedinput.js'); ?>" type="text/javascript"></script>
<script>
  $(".livesearch").select2();
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
</script>