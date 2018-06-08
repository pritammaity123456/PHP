<form method="post" action="<?php echo site_url("Admin/empBalance");?>">
  <div class="form-row why"> 
    <div class="form-group col-md-6">
      <label for="dpemp1">From Date:</label>
      <input type="text" class="form-control" name="date1" id="dpemp1" placeholder="DD/MM/YYYY" required>
    </div>
    </div>  
    <div class="form-group col-md-6">
      <div class="alert alert-danger" id="d1ebalert">Supplied date can't be greater than system date!</div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>

<script type="text/javascript">
  $(document).ready(function($){    
      $('#dpemp1').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
  });
</script>

<style>
.datepicker{z-index:1151 !important;}
</style>

<script src="<?php echo base_url('js/jquery.maskedinput.js');?>" type="text/javascript"></script>
<script>
  $(document).ready(function($){

    document.getElementById("d1ebalert").style.display = "none";
    
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 
    
    if(mm<10) {
        mm = '0'+mm
    } 

    today = dd + '/' + mm + '/' + yyyy;
      $("#dpemp1").val(today);
      $("#dpemp1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dpemp1").css({"placeholder":"opacity:0.4"});
});

    $('#dpemp1').on( "change", function() {
      var today = new Date();
      var to_date = $('#dpemp1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d1ebalert").style.display = "block";
        $('#dpemp1').val('');
        return false;
      }
      else{
        document.getElementById("d1ebalert").style.display = "none";
      }
  });

  
</script>