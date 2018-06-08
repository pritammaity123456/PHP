<form method="post" action="<?php echo site_url("Admin/closing_balance");?>">
  <div class="form-row why"> 
    <div class="form-group col-md-6">
      <label for="dpclb1">From Date:</label>
      <input type="text" class="form-control" name="date1" id="dpclb1" placeholder="DD/MM/YYYY" required>
    </div>
    <div class="form-group col-md-6">
      <label>To Date:</label>
      <input type="text" class="form-control" id="dpclb2" name="date2" placeholder="DD/MM/YYYY" required>
    </div>
    </div> 
    <div class="form-group col-md-6">
      <div class="alert alert-danger" id="d1clbalert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="d2clbalert">Supplied date can't be greater than system date!</div>
     </div> 
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>

<script type="text/javascript">
  $(document).ready(function($){    
      $('#dpclb1').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
      $('#dpclb2').datepicker({
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
    document.getElementById("d1clbalert").style.display = "none";
    document.getElementById("d2clbalert").style.display = "none";
      $("#dpclb1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dpclb1").css({"placeholder":"opacity:0.4"});
});
</script>
<script>
  $(document).ready(function($){
      $("#dpclb2").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dpclb2").css({"placeholder":"opacity:0.4"});
});

  $('#dpclb1').on( "change", function() {
      var today = new Date();
      var to_date = $('#dpclb1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d1clbalert").style.display = "block";
        $('#dpclb1').val('');
        return false;
      }
      else{
        document.getElementById("d1clbalert").style.display = "none";
        var to_date = $(this).val();
        $('#dpclb2').val(to_date);
      }
  });

  $('#dpclb2').on( "change", function() {
      var today = new Date();
      var to_date = $('#dpclb2').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d2clbalert").style.display = "block";
        $('#dpclb2').val('');
        return false;
      }
      else {
        document.getElementById("d2clbalert").style.display = "none";
      }
  });
</script> 