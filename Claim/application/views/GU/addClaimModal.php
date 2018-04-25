<script>
  $(document).ready(function(){
    var total = 0;
    
    $("#addrow").click(function(){
      $("#intro").append('<tr><td><select class="custom-select preferenceSelect" name="chead[]" style="width: 150px;"><option>Select</option><?php foreach ($chead as $aldta):?><option value="<?php echo $aldta->head_desc?>"><?php echo $aldta->head_desc?></option><?php endforeach;?> </select></td><td><textarea name="remarks[]" class="form-control"  rows="1" cols="35"></textarea></td><td><input type="text" class="form-control amount_cls" name="amount[]" required></td><td><button class="btn btn-danger" id="removeRow"><i class="fa fa-undo" aria-hidden="true"></i></button></td></tr>');
      $('.preferenceSelect').change();
    });

    $("#intro").on('click','#removeRow',function(){
        $(this).parent().parent().remove();
        $('.amount_cls').change();
        $('.preferenceSelect').change();
    });

    
    $("#total").on('mouseover mouseenter mouseleave mouseup mousedown', function(){
        return false;
      });
    $("#total").val("");
    $('.preferenceSelect').change();
    $('#intro').trigger('change');
  });

  $('.livesearch').select2();

  $('#intro').trigger('change');

  $('#intro').on( "change", ".amount_cls", function() {
     $("#total").val('');
      var total = 0;
      $('.amount_cls').each(function(){
          total += +$(this).val();
      });
      $("#total").val(total);
      
  });
  
  $('#intro').on("change", ".preferenceSelect", function() {
    
    $('.preferenceSelect').each(function(){
        $('.preferenceSelect').find('option[value ="' + this.value + '"]').attr("disabled", true);
    
      });
  });

  $('#save').on("click", function() {
    console.log('abc');
    $('.preferenceSelect').each(function(){
        $('.preferenceSelect').find('option[value ="' + this.value + '"]').attr("disabled", false);
    
      });
  });

document.getElementById("d1alert").style.display = "none";    

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

  document.getElementById("d2alert").style.display = "none";    

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
<form method="post" id="form_login" action="<?php echo site_url("Users/addClaimProcess")?>">
  <div class="form-row"> 
    <div class="form-group col-md-3">
        <label>Trans Date:</label>
        <input type="text" class="form-control" value="<?php echo date('d/m/Y')?>" readonly>
      </div>
      <div class="form-group col-md-9">
          <label for="projectName">Project Name:</label>
          <div>
          <select class="form-control livesearch" style="width:185px;" id="projectName" name="projectName" required>
            <?php
              foreach ($project_name as $aldta):?>
                    <option value="<?php echo $aldta->project_name;?>"><?php echo $aldta->project_name;?></option>
                    <?php
                    endforeach;
            ?>
          </select>
        </div>
      </div>
  </div>
    <div class="form-row">
      <div class="form-group col-md-3">
          <label for="dp1">From Date:</label>
          <input type="text" class="form-control" id="dp1" name="date1" placeholder="DD/MM/YYYY" style="width:185px;" required>
      </div>
      <div class="form-group col-md-3">
        <label for="dp2">To Date:</label>
        <input type="text" class="form-control" id="dp2" name ="date2" placeholder="DD/MM/YYYY" style="width:185px;" required>
      </div>
     <div class="form-group col-md-6">
      <div class="alert alert-danger" id="d1alert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="d2alert">Supplied date can't be greater than system date!</div>
     </div>
  </div>
  <div class="form-row"> 
    <div class="form-group col-md-3">
        <label for="project">Project Type:</label>
        <div>
        <select class="custom-select" id="project" name="projectType" style="width: 185px;" required>
              <?php
              foreach ($project_type as $aldta):?>
                <option value="<?php echo $aldta->type_desc;?>"><?php echo $aldta->type_desc;?></option>
                <?php
              endforeach;
            ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-3" style="">
        <label for="purpose">Purpose:</label>
        <div>
        <select class="custom-select" id="purpose" style="width:185px;" name="purpose" required>
              <?php foreach ($purpose as $aldta):?>
                    <option value="<?php echo $aldta->purpose_desc;?>"><?php echo $aldta->purpose_desc;?></option>
                    <?php
                    endforeach;
                    ?>
            </select>
      </div>
    </div>
      
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
          <label for="narration">Narration:</label>
          <textarea type="text" class="form-control" id="narration" name="narration" required></textarea>
        </div>   
    </div>

    <div class="card">
      <div class="card-body">
        <div class="form-inline">
          <label for="total">Claim Total:</label> &nbsp;          
            <input type="text" class="form-control" id="total" disabled> 
        </div>        
        <hr>
        <div class="table table-responsive my_div">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Head</th>
                <th>Remarks</th>
                <th>Amount</th>
                <th><button class="btn btn-success" type="button" id="addrow"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button></th>
              </tr>
            </thead>
            <tbody id="intro">
              <tr>
                <td><select class="custom-select  preferenceSelect" style="width: 150px;" name="chead[]">
                    <option>Select</option>
                  <?php foreach ($chead as $aldta):?>
                    <option value="<?php echo $aldta->head_desc?>"><?php echo $aldta->head_desc?></option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </td>
                <td><textarea class="form-control" name="remarks[]" rows="1" cols="35"></textarea></td>
                <td><input type="text" id="add0" class="form-control amount_cls" name="amount[]" required></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    Please Save Claim After Completion.
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" id="save" type="submit">Save</button>
    </div>
</form>
