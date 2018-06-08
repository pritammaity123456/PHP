<form method="post" action="<?php echo site_url("Admin/projectWiseExpence");?>">
  
  <div class="form-group col-md-12">
      <label for="projectName">Project Name:</label>
      <div>
      <select class="livesearch" style="width:425px;" id="projectName" name="projectName" required>
        <?php foreach ($project_name as $aldta):?>
                <option value="<?php echo $aldta->project_name?>"><?php echo $aldta->project_name;?></option>
                <?php
                endforeach;
                ?>
      </select>
  </div>
  </div>
  <div class="form-row why"> 
    <div class="form-group col-md-6">
        <label for="dpwe1">From Date:</label>
        <input type="text" class="form-control" name="date1" id="dpwe1" placeholder="DD/MM/YYYY" required>
    </div>
      <div class="form-group col-md-6">
        <label>To Date:</label>
        <input type="text" class="form-control" id="dpwe2" name="date2" placeholder="DD/MM/YYYY" required>
      </div>
    </div> 
    <div class="form-group col-md-6">
      <div class="alert alert-danger" id="d1pwe">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="d2pwe">Supplied date can't be greater than system date!</div>
     </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Proceed</button>
    </div>
</form>

<script type="text/javascript">
  $(document).ready(function($){    
      $('#dpwe1').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
      $('#dpwe2').datepicker({
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
  $(".livesearch").select2();
  $(document).ready(function($){
    document.getElementById("d1pwe").style.display = "none";
    document.getElementById("d2pwe").style.display = "none";
      $("#dpwe1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dpwe1").css({"placeholder":"opacity:0.4"});
});
</script>
<script>
  $(document).ready(function($){
      $("#dpwe2").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dpwe2").css({"placeholder":"opacity:0.4"});
});

  $('#dpwe1').on( "change", function() {
      var today = new Date();
      var to_date = $('#dpwe1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d1pwe").style.display = "block";
        $('#dpwe1').val('');
        return false;
      }
      else{
        document.getElementById("d1pwe").style.display = "none";
        var to_date = $(this).val();
      $('#dpwe2').val(to_date);
      }
  });

  $('#dpwe2').on( "change", function() {
      var today = new Date();
      var to_date = $('#dpwe2').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("d2pwe").style.display = "block";
        $('#dpwe2').val('');
        return false;
      }
      else {
        document.getElementById("d2pwe").style.display = "none";
      }
  });
</script>