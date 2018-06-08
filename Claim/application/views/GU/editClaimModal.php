<script>
  $(document).ready(function(){
    var total = 0;

    $("#addrow").click(function(){
      $("#intro").append('<tr><td><select class="custom-select preferenceSelect" name="chead[]" style="width: 150px;"><option>Select</option><?php foreach ($chead as $aldta):?><option value="<?php echo $aldta->head_desc?>"><?php echo $aldta->head_desc?></option><?php endforeach;?> </select></td><td><textarea name="remarks[]" class="form-control"  rows="1" cols="35"></textarea></td><td><input type="text" name="amount[]" class=" form-control amount_cls"></td><td><button class="btn btn-danger" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>');
      $('.preferenceSelect').change();
      $('[data-toggle="tooltip"]').tooltip({trigger: "hover"});
    });


    $("#total").on('mouseover mouseenter mouseleave mouseup mousedown', function(){
        return false;
      });

    $("#total").val("");

    $('.amount_cls').change();

    $("#intro").on('click','#removeRow',function(){
        $(this).parent().parent().remove();
        $('.amount_cls').change();
        $('.preferenceSelect').change();
    });
    
    $('.preferenceSelect').change();
    $('[data-toggle="tooltip"]').tooltip({trigger: "hover"});
  });

  $(".livesearch").select2();

  $('#intro').trigger('change');

  $('#intro').on( "change", ".amount_cls", function() {
     $("#total").val('');
      var total = 0;
      $('.amount_cls').each(function(){
          total += +$(this).val();
      });
      $("#total").val(total);
  });

    $('#save').on("click", function() {
    console.log('abc');
    $('.preferenceSelect').each(function(){
        $('.preferenceSelect').find('option[value ="' + this.value + '"]').attr("disabled", false);
    
      });
  });


  $('#intro').on("change", ".preferenceSelect", function() {
    
    $('.preferenceSelect').each(function(){
        $('.preferenceSelect').find('option[value ="' + this.value + '"]').attr("disabled", true);
    
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
      else{
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

  <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Claim: <?php echo $this->session->userdata('loggedin')->emp_name;?></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
  </div>
  <div class="modal-body" >
<form method="post" id="form_login" action="<?php echo site_url("Users/editClaimProcess")?>">
  <div class="form-row"> 
    <div class="form-group col-md-3">
      <input type="hidden" name="claimCode" value="<?php echo $claim->claim_cd*8191;?>">
        <label>Claim Date:</label>
        <input type="text" class="form-control" value="<?php echo date('d/m/Y',strtotime($claim->claim_dt)); ?>" readonly>
      </div>
      <div class="form-group col-md-9">
          <label for="projectName">Project Name:</label>
          <div>
          <select class="custom-select livesearch" style="width: 316px;" id="projectName" name="projectName" required>
            <?php foreach ($project_name as $aldta):?>
                    <option value='{"pName":"<?php echo $aldta->project_name;?>","pType":"<?php echo $aldta->project_type;?>" }' <?php echo ($claim->project_name == $aldta->project_name)?'selected':'';?>><?php echo $aldta->project_name.' '.$aldta->project_type;?></option>
                    <?php
                    endforeach;
                    ?>
          </select>
        </div>
      </div>
  </div>
    <div class="form-row"> 
      <div class="form-group col-md-3">
        <label for="claimCode">Claim Code:</label>
        <input type="text" class="form-control" value="<?php echo $claim->claim_cd;?>" readonly>
      </div>    
      <div class="form-group col-md-8">
        <label for="purpose">Purpose:</label>
        <div>
        <select class="custom-select livesearch" id="purpose" name="purpose" style="width: 316px;" required>
              <?php foreach ($purpose as $aldta):?>
                    <option value="<?php echo $aldta->purpose_desc?>" <?php echo ($claim->purpose == $aldta->purpose_desc)?'selected':'';?>><?php echo $aldta->purpose_desc;?></option>
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
        <input type="text" class="form-control" id="dp1" name="date1" value="<?php echo date('d/m/Y',strtotime($claim->from_dt));?>" placeholder="DD/MM/YYYY" required>
    </div>
    <div class="form-group col-md-2">
    </div>
    <div class="form-group col-md-3">
        <label for="dp2">To Date:</label>
        <input type="text" class="form-control" id="dp2" name ="date2" value="<?php echo date('d/m/Y',strtotime($claim->to_dt));?>" placeholder="DD/MM/YYYY" required>
    </div>
    <div class="form-group col-md-4">
      <div class="alert alert-danger" id="d1alert">Supplied date can't be greater than system date!</div>
       <div class="alert alert-danger" id="d2alert">Supplied date can't be greater than system date!</div>
     </div>  
    
    
  </div>
  <div class="form-row">
    <div class="form-group col-md-8">
          <label for="narration">Narration:</label>
          <textarea class="form-control" id="narration" name="narration" required><?php echo $claim->narration;?></textarea>
        </div>   
    </div>

    <div class="card">
      <div class="card-body">
        <div class="form-inline">
          <label for="total">Claim Total:</label> &nbsp;         
            <input type="text" class="form-control" id="total" readonly> 
        </div>        
        <hr>
        <div class="table table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Head</th>
                <th>Remarks</th>
                <th>Amount</th>
                <th><button class="btn btn-success" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom" type="button" id="addrow"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
              </tr>
            </thead>
            <tbody id="intro">
              <?php
                 foreach ($cltrans as $cldta): 
              ?>
              <tr>
                <td style="display:none;"><input type="text" name="rmv_slno[]" value="<?php echo $cldta->sl_no;?>"></td>
                <td><select class="custom-select preferenceSelect" style="width: 150px;" name="chead[]">
                  <?php
                   foreach ($chead as $aldta):
                      $i=0;
                    ?>
                    <option value="<?php echo $aldta->head_desc?>" <?php echo ($cldta->claim_hd == $aldta->head_desc)?'selected':'';?>><?php echo $aldta->head_desc?></option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </td>
                <td><textarea name="remarks[]" class="form-control"  rows="1" cols="35"><?php echo $cldta->remarks;?></textarea></td>
                <td><input type="text" class="form-control amount_cls" name="amount[]" value="<?php echo $cldta->amount;?>" required></td>
                <?php
                  if ($cldta->sl_no==1) {
                    echo "<td></td>";
                  }else{ ?>
                    <td><button class="btn btn-danger" id="removeRow"><i class="fa fa-undo" aria-hidden="true"></i></button></td>
                  <?php
                  }
                ?>
              </tr>
              <?php
                 endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    Please Save Claim After Modification.
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" id="save" type="submit">Save</button>
    </div>
  </div>
</form>
