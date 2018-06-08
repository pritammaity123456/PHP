<script>
  $(document).ready(function(){
    $('#pname').hide();
    $('#prps').hide();
    var total = 0;
    
    $("#addrow").click(function(){
      $("#intro").append('<tr><td><select class="custom-select preferSelect" name="chead[]" style="width: 150px;"><option>Select</option><?php foreach ($chead as $aldta):?><option value="<?php echo $aldta->head_desc?>"><?php echo $aldta->head_desc?></option><?php endforeach;?> </select></td><td><textarea name="remarks[]" class="form-control"  rows="1" cols="35"></textarea></td><td><input type="text" class="form-control amount_cls" name="amount[]" required></td><td><button class="btn btn-danger" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>');
      $('.preferSelect').change();
      $('[data-toggle="tooltip"]').tooltip({trigger: "hover"});
    });

    $("#intro").on('click','#removeRow',function(){
        $(this).parent().parent().remove();
        $('.amount_cls').change();
        $('.preferSelect').find('option[value ="' + this.value + '"]').attr("disabled", false);
    });

    
    $("#total").on('mouseover mouseenter mouseleave mouseup mousedown', function(){
        return false;
      });
    $("#total").val("");
    $('.preferSelect').change();
    $('#intro').trigger('change');
    $('[data-toggle="tooltip"]').tooltip({trigger: "hover"});
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
  
  $('#intro').on("change", ".preferSelect", function() {
    
    $('.preferSelect').each(function(){
        $('.preferSelect').find('option[value ="' + this.value + '"]').attr("disabled", true);
    
      });
  });

  $('#save').on("click", function() {
    var pname = $('#projectName').val();
    var purpose = $('#purpose').val();
    if(pname == 0){
      $('#save').prop('type','button');
      $('#pname').show();
    }

    if(purpose == 0){
      $('#save').prop('type','button');
      $('#prps').show();
    }
    $('.preferSelect').each(function(){
        $('.preferSelect').find('option[value ="' + this.value + '"]').attr("disabled", false);
    
      });
  });

document.getElementById("dt1alert").style.display = "none";
document.getElementById("dt4alert").style.display = "none";

  $('#dp1').on("change", function() {
      var today = new Date();
      
      var from_date = $('#dp2').val().split("/");
      var frmdt = new Date(from_date[2], from_date[1] - 1, from_date[0]);
      
      var to_date = $('#dp1').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);

      if (mydate > today) {
        document.getElementById("dt1alert").style.display = "block";
        $('#dp1').val('');
        return false;
      }
      else if(frmdt < mydate){
        document.getElementById("dt4alert").style.display = "block";
        $('#dp1').val('');
        return false;
      }
      else{
        document.getElementById("dt1alert").style.display = "none";
        document.getElementById("dt4alert").style.display = "none";
        var to_date = $(this).val();
      $('#dp2').val(to_date);
      }
  });

  document.getElementById("dt2alert").style.display = "none";
  document.getElementById("dt3alert").style.display = "none";

    $('#dp2').on("change", function() {
      var today = new Date();
      var to_date = $('#dp2').val().split("/");
      var mydate = new Date(to_date[2], to_date[1] - 1, to_date[0]);
      
      var from_date = $('#dp1').val().split("/");
      var fmdt = new Date(from_date[2], from_date[1] - 1, from_date[0]);
    
      if (mydate > today) {
        document.getElementById("dt2alert").style.display = "block";
        $('#dp2').val('');
        return false;
      }
      if(mydate < fmdt){
          document.getElementById("dt3alert").style.display = "block";
        $('#dp2').val('');
        return false;
      }
      else {
        document.getElementById("dt2alert").style.display = "none";
        document.getElementById("dt3alert").style.display = "none";
      }
  });

  $('#projectName').change(function(){
      var pname = $('#projectName').val();
      var purpose = $('#purpose').val();
      if(pname != 0){
        $('#pname').hide();
      }
  });

  $('#purpose').change(function(){
      var purpose = $('#purpose').val();
      if(purpose != 0){
        $('#prps').hide();
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

<script type="text/javascript">
  $(document).ready(function($){    
      $('#dp1').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
      $('#dp2').datepicker({
          format: 'dd/mm/yyyy',
          endDate: "today"
        });
  });
</script>

<style>
.datepicker{z-index:1151 !important;}
</style>

<form method="post" id="form_login" action="<?php echo site_url("Users/addClaimProcess")?>">
  <div class="form-row"> 
    <div class="form-group col-md-3">
        <label>Trans Date:</label>
        <input type="text" class="form-control" value="<?php echo date('d/m/Y')?>" readonly>
      </div>
      <div class="form-group col-md-5">
          <label for="projectName">Project Name:</label>
          <div>
          <select class="form-control livesearch" style="width:316px;" id="projectName" name="projectName" required>
                    <option value="0">Select</option>
            <?php
              foreach ($project_name as $aldta):?>
                    <option value=' {"pName":"<?php echo $aldta->project_name;?>","pType":"<?php echo $aldta->project_type;?>" }'><?php echo $aldta->project_name.' '.$aldta->project_type;?></option>
                    <?php
                    endforeach;
            ?>
          </select>
        </div>
      </div>
      <div class="form-group col-md-4">
        <div class="alert alert-danger" id="pname">Please select a Project</div>
      </div>
  </div>
    <div class="form-row">
      <div class="form-group col-md-3">
          <label for="dp1">From Date:</label>
          <input type="text" class="form-control" id="dp1" name="date1" placeholder="DD/MM/YYYY" style="width:185px;" required>
      </div>
      <div class="form-group col-md-2">
      </div>
      <div class="form-group col-md-3">
        <label for="dp2">To Date:</label>
        <input type="text" class="form-control" id="dp2" name ="date2" placeholder="DD/MM/YYYY" style="width:185px;" required>
      </div>
     <div class="form-group col-md-4">
      <div class="alert alert-danger" id="dt1alert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="dt2alert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="dt3alert">Todate can't be greater than Fromdate!</div>
       <div class="alert alert-danger" id="dt4alert">Fromdate can't be less than Todate!</div>
     </div>
  </div>
  <div class="form-row"> 
    <div class="form-group col-md-8" style="">
        <label for="purpose">Purpose:</label>
        <div>
        <select class="custom-select livesearch" id="purpose" style="width:515px;" name="purpose" required>
                    <option value="0">Select</option>
              <?php foreach ($purpose as $aldta):?>
                    <option value="<?php echo $aldta->purpose_desc;?>"><?php echo $aldta->purpose_desc;?></option>
                    <?php
                    endforeach;
                    ?>
            </select>
      </div>
    </div>
    <div class="form-group col-md-4">
        <div class="alert alert-danger" id="prps">Please select a Purpose</div>
      </div>  
  </div>
  <div class="form-row">
    <div class="form-group col-md-8">
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
                <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
              </tr>
            </thead>
            <tbody id="intro">
              <tr>
                <td><select class="custom-select  preferSelect" style="width: 150px;" name="chead[]">
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