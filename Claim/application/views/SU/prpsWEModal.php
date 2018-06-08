<form method="post" action="<?php echo site_url("Admin/purposeWiseExpence");?>">
  <div class="form-row why">
    <div class="form-group col-md-6">
      <label for="dprps1">From Date:</label>
      <input type="text" class="form-control" name="date1" id="dprps1" placeholder="DD/MM/YYYY" required>
    </div>
    <div class="form-group col-md-6">
      <label for="dprps2">To Date:</label>
      <input type="text" class="form-control" id="dprps2" name="date2" placeholder="DD/MM/YYYY" required>
    </div>
    </div>  
    <div class="form-group col-md-6">
      <div class="alert alert-danger" id="d1prpsalert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="d2prpsalert">Supplied date can't be greater than system date!</div>
     </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>

<script type="text/javascript">
  $(document).ready(function($){    
      $('#dprps1').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
      $('#dprps2').datepicker({
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

  $('#dprps1').on( "change", function() {
      var today = new Date();
      var to_date = $('#dprps1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d1prpsalert").style.display = "block";
        $('#dprps1').val('');
        return false;
      }
      else{
        document.getElementById("d1prpsalert").style.display = "none";
        var to_date = $(this).val();
      $('#dprps2').val(to_date);
      }
  });

  $('#dprps2').on( "change", function() {
      var today = new Date();
      var to_date = $('#dprps2').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d2prpsalert").style.display = "block";
        $('#dprps2').val('');
        return false;
      }
      else {
        document.getElementById("d2prpsalert").style.display = "none";
      }
  });

  $(document).ready(function($){
    document.getElementById("d1prpsalert").style.display = "none";
    document.getElementById("d2prpsalert").style.display = "none";
      $("#dprps1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dprps1").css({"placeholder":"opacity:0.4"});
});
</script>
<script>
  $(document).ready(function($){
      $("#dprps2").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dprps2").css({"placeholder":"opacity:0.4"});
});
</script>