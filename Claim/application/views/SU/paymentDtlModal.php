

<form method="post" action="<?php echo site_url("Admin/paymentDetails");?>">
  <div class="form-row">
    <div class="form-group col-md-8">
        <label for="emp_name">Employee's Name</label>
        <div class="col-xs-4">
          <select class="form-control preferenceSelect" id="emp_no" name="emp_no" required style="width: 470px;">
          <option>Select</option>
          <?php
            if ($dtls) {
                foreach ($dtls as $aldta) {
                  foreach ($aldta as $key) {
                     if ($key->emp_no == $this->session->userdata('is_login')->emp_no){
                      continue;
                    }
                  }
                 
                  ?>
                  <option value="<?php echo $key->emp_no;?>"><?php echo $key->emp_name;?></option>
          <?php
                }
            }
          ?>
        </select>
        </div>
      </div>
  </div>
  <br>
  <div class="form-row why"> 
    <div class="form-group col-md-6">
        <label for="dp1">From Date:</label>
        <input type="text" class="form-control" name="date1" id="dp1" placeholder="DD/MM/YYYY" required>
    </div>
      <div class="form-group col-md-6">
        <label>To Date:</label>
        <input type="text" class="form-control" id="dp2" name="date2" placeholder="DD/MM/YYYY" required>
      </div>
    </div>  
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>


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
</script>