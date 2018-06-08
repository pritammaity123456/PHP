

<form method="post" action="<?php echo site_url("Admin/paymentDetails");?>">
  <div class="form-row">
    <div class="form-group col-md-8">
        <label for="emp_name">Employee's Name</label>
        <div class="col-xs-4">
          <select class="form-control preferenceSelect" id="emp_no" name="emp_no" required style="width: 470px;">
          <option>Select</option>
          <?php
            if ($dtls) {
                foreach ($dtls as $aldta) {?>
                  <option value="<?php echo $aldta->emp_no;?>">
                  <?php echo $aldta->emp_name;?></option>
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
        <label for="dpaydtl1">From Date:</label>
        <input type="text" class="form-control" name="date1" id="dpaydtl1" placeholder="DD/MM/YYYY" required>
    </div>
    <div class="form-group col-md-6">
      <label for="dpaydtl2">To Date:</label>
      <input type="text" class="form-control" name="date2" id="dpaydtl2" placeholder="DD/MM/YYYY" required>
    </div>
    </div> 
    <div class="form-group col-md-6">
      <div class="alert alert-danger" id="d1pmtalert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="d2pmtalert">Supplied date can't be greater than system date!</div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>


<script type="text/javascript">
  $(document).ready(function($){    
      $('#dpaydtl1').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
      $('#dpaydtl2').datepicker({
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
    document.getElementById("d1pmtalert").style.display = "none";
    document.getElementById("d2pmtalert").style.display = "none";
      $("#dpaydtl1").mask("99/99/9999");
      $("#dpaydtl1").css({"placeholder":"opacity:0.4"});
  });

  $(document).ready(function($){
      $("#dpaydtl2").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dpaydtl2").css({"placeholder":"opacity:0.4"});
});


  $('#dpaydtl1').on("change", function() {
      var today = new Date();
      var to_date = $('#dpaydtl1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d1pmtalert").style.display = "block";
        $('#dpaydtl1').val('');
        return false;
      }
      else{
        document.getElementById("d1pmtalert").style.display = "none";
        var to_date = $(this).val();
      $('#dpaydtl2').val(to_date);
      }
  });

  $('#dpaydtl2').on( "change", function() {
      var today = new Date();
      var to_date = $('#dpaydtl2').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d2pmtalert").style.display = "block";
        $('#dpaydtl2').val('');
        return false;
      }
      else {
        document.getElementById("d2pmtalert").style.display = "none";
      }
  });
</script>