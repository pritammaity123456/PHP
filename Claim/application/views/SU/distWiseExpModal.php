<form method="post" action="<?php echo site_url("Admin/distWiseExpence");?>">
  <div class="form-row why"> 
    <div class="form-group col-md-6">
      <label for="dwe1">From Date:</label>
      <input type="text" class="form-control" name="date1" id="dwe1" placeholder="DD/MM/YYYY" required>
    </div>
    <div class="form-group col-md-6">
      <label for="dwe2">To Date:</label>
      <input type="text" class="form-control" id="dwe2" name="date2" placeholder="DD/MM/YYYY" required>
    </div>
    </div>  
    <div class="form-group col-md-6">
      <div class="alert alert-danger" id="d1wealert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="d2wealert">Supplied date can't be greater than system date!</div>
     </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>

<script type="text/javascript">
  $(document).ready(function($){    
      $('#dwe1').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
      $('#dwe2').datepicker({
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
    document.getElementById("d1wealert").style.display = "none";
    document.getElementById("d2wealert").style.display = "none";
      $("#dwe1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dwe1").css({"placeholder":"opacity:0.4"});
});
</script>
<script>
  $(document).ready(function($){
      $("#dwe2").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dwe2").css({"placeholder":"opacity:0.4"});
});


  $('#dwe1').on( "change", function() {
      var today = new Date();
      var to_date = $('#dwe1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d1wealert").style.display = "block";
        $('#dwe1').val('');
        return false;
      }
      else{
        document.getElementById("d1wealert").style.display = "none";
        var to_date = $(this).val();
        $('#dwe2').val(to_date);
      }
  });

  $('#dwe2').on( "change", function() {
      var today = new Date();
      var to_date = $('#dwe2').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d2wealert").style.display = "block";
        $('#dwe2').val('');
        return false;
      }
      else {
        document.getElementById("d2wealert").style.display = "none";
      }
  });
</script>