<form method="post" action="<?php echo site_url("Users/claimDetails");?>">
  <div class="form-row">
    <div class="form-group">
      <label style="padding-left: 7px;" >Employee's Name :</label> <?php echo $this->session->userdata('loggedin')->emp_name; ?>
    </div>
  </div>
  <div class="form-row why"> 
    <div class="form-group col-md-6">
        <label for="dpdtl1">From Date:</label>
        <input type="text" class="form-control" name="date1" id="dpdtl1" placeholder="DD/MM/YYYY" required>
    </div>
      <div class="form-group col-md-6">
        <label>To Date:</label>
        <input type="text" class="form-control" id="dpdtl2" name="date2" placeholder="DD/MM/YYYY" required>
      </div>
    </div> 
    <div class="form-group col-md-6">
      <div class="alert alert-danger" id="cldtl1">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="cldtl2">Supplied date can't be greater than system date!</div>
     </div> 
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>

<script type="text/javascript">
  $(document).ready(function($){    
      $('#dpdtl1').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
      $('#dpdtl2').datepicker({
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
    document.getElementById("cldtl1").style.display = "none";
    document.getElementById("cldtl2").style.display = "none";
      $("#dpdtl1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dpdtl1").css({"placeholder":"opacity:0.4"});
});
</script>
<script>
  $(document).ready(function($){
      $("#dpdtl2").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dpdtl2").css({"placeholder":"opacity:0.4"});
});

  $('#dpdtl1').on( "change", function() {
      var today = new Date();
      var to_date = $('#dpdtl1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("cldtl1").style.display = "block";
        $('#dpdtl1').val('');
        return false;
      }
      else{
        document.getElementById("cldtl1").style.display = "none";
        var to_date = $(this).val();
      $('#dpdtl2').val(to_date);
      }
  });

  $('#dpdtl2').on( "change", function() {
      var today = new Date();
      var to_date = $('#dpdtl2').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("cldtl2").style.display = "block";
        $('#dpdtl2').val('');
        return false;
      }
      else {
        document.getElementById("cldtl2").style.display = "none";
      }
  });
</script>