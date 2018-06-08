<form method="post" action="<?php echo site_url("Admin/claimDetails");?>">
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
  <div class="form-row why"> 
    <div class="form-group col-md-6">
      <label for="dacd1">From Date:</label>
      <input type="text" class="form-control" name="date1" id="dacd1" placeholder="DD/MM/YYYY" required>
    </div>
    <div class="form-group col-md-6">
      <label for="dacd2">To Date:</label>
      <input type="text" class="form-control" id="dacd2" name="date2" placeholder="DD/MM/YYYY" required>
    </div>
    </div>
    <div class="form-group col-md-6">
      <div class="alert alert-danger" id="d1alert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="d2alert">Supplied date can't be greater than system date!</div>
     </div>  
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>


<script type="text/javascript">
  $(document).ready(function($){    
      $('#dacd1').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
      $('#dacd2').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
  });
</script>

<style>
.datepicker{z-index:1151 !important;}
</style>


<script src="<?php echo base_url('js/jquery.maskedinput.js'); ?>" type="text/javascript"></script>
<script>
  $(document).ready(function($){
    document.getElementById("d1alert").style.display = "none";
    document.getElementById("d2alert").style.display = "none";
      $("#dacd1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dacd1").css({"placeholder":"opacity:0.4"});
});
</script>
<script>
  $(document).ready(function($){
      $("#dacd2").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dacd2").css({"placeholder":"opacity:0.4"});
});

  $('#dacd1').on( "change", function() {
      var today = new Date();
      var to_date = $('#dacd1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d1alert").style.display = "block";
        $('#dacd1').val('');
        return false;
      }
      else{
        document.getElementById("d1alert").style.display = "none";
        var to_date = $(this).val();
      $('#dacd2').val(to_date);
      }
  });

  $('#dacd2').on( "change", function() {
      var today = new Date();
      var to_date = $('#dacd2').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d2alert").style.display = "block";
        $('#dacd2').val('');
        return false;
      }
      else {
        document.getElementById("d2alert").style.display = "none";
      }
  });
</script>