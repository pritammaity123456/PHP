<script src="<?php echo base_url('js/jquery.maskedinput.js');?>" type="text/javascript"></script>

<form method="post" action="<?php echo site_url("Users/paymentDetails");?>">
  <div class="form-row">
    <div class="form-group">
      <label style="padding-left: 7px;" >Employee's Name :</label> <?php echo $this->session->userdata('loggedin')->emp_name; ?>
    </div>
  </div>
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
    <div class="form-group col-md-6">
      <div class="alert alert-danger" id="d1alert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="d2alert">Supplied date can't be greater than system date!</div>
     </div>   
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>


<script>
  $(document).ready(function($){
    document.getElementById("d1alert").style.display = "none";
    document.getElementById("d2alert").style.display = "none";
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

  $('#dp1').on( "change", function() {
      var today = new Date();
      var to_date = $('#dp1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d1alert").style.display = "block";
        $('#dp1').val('');
        return false;
      }
      else{
        document.getElementById("d1alert").style.display = "none";
        var to_date = $(this).val();
      $('#dp2').val(to_date);
      }
  });

  $('#dp2').on( "change", function() {
      var today = new Date();
      var to_date = $('#dp2').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d2alert").style.display = "block";
        $('#dp2').val('');
        return false;
      }
      else {
        document.getElementById("d2alert").style.display = "none";
      }
  });
</script> 