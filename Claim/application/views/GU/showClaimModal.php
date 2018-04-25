<script>
  $('#dp1').datepicker({
      format: 'dd/mm/yyyy'
    });
  $('#dp2').datepicker({
      format: 'dd/mm/yyyy'
    });

  $(document).ready(function(){
    var total = 0;
    var count = 0;

    $("#addrow").click(function(){
      $("#intro").append('<tr><td><select class="custom-select" name="chead[]"><?php foreach ($chead as $aldta):?><option value="<?php echo $aldta->head_desc?>"><?php echo $aldta->head_desc?></option><?php endforeach;?> </select></td><td><input type="text" name="remarks[]"></td><td><input type="text" name="amount[]" class="amount_cls"></td><td><button class="btn btn-danger" id="removeRow"><i class="fa fa-undo" aria-hidden="true"></i></button></td></tr>');
    });

    $("#intro").on('click','#removeRow',function(){
        $(this).parent().parent().remove();
    });

    $("#total").on('mouseover mouseenter mouseleave mouseup mousedown', function(){
        return false;
      });
    $("#total").val("0");
    $('.amount_cls').change();

    $("#intro").on('click','#removeRow',function(){
        $(this).parent().parent().remove();
        $('.amount_cls').change();
    });

  });

  $('#intro').on( "change", ".amount_cls", function() {
     $("#total").val('');
      var total = 0;
      $('.amount_cls').each(function(){
          total += +$(this).val();
      });
      $("#total").val(total);
  });

</script>
<style>
.datepicker{z-index:1151 !important;}
</style>

  <div class="form-row"> 
    <div class="form-group col-md-3">
        <label>Claim Date:</label>
        <input type="text" class="form-control" value="<?php echo date('d/m/Y',strtotime($claim->claim_dt)); ?>" disabled>
      </div>
      <div class="form-group col-md-6">
          <label for="projectName">Project Name:</label>
          <div>
          <select class="custom-select livesearch" style="width: 200px;" id="projectName" name="projectName" required>
              <option><?php echo $claim->project_name?></option>
          </select>
        </div>
      </div>
  </div>
    <div class="form-row"> 
      <div class="form-group col-md-3">
        <label for="claimCode">Claim Code:</label>
        <input type="text" class="form-control" value="<?php echo $claim->claim_cd;?>">
      </div>    
      <div class="form-group col-md-6">
        <label for="purpose">Purpose:</label>
        <div>
        <select class="custom-select" id="purpose" name="purpose" required>
              <option><?php echo $claim->purpose;?></option>
            </select>
      </div>
    </div>
  </div>
  <div class="form-row"> 
    <div class="form-group col-md-3">
        <label for="dp1">From Date:</label>
        <input type="text" class="form-control" id="dp1" name="date1" value="<?php echo date('d/m/Y',strtotime($claim->from_dt));?>" required>
    </div>
    <div class="form-group col-md-3">
        <label for="dp2">To Date:</label>
        <input type="text" class="form-control" id="dp2" name ="date2" value="<?php echo date('d/m/Y',strtotime($claim->to_dt));?>" required>
      </div>   
    <div class="form-group col-md-6">
        <label for="project">Project Type:</label>
        <div>
        <select class="custom-select" id="project" name="projectType" required>
            <option><?php echo $claim->project_type?></option>
        </select>
      </div>
    </div>
    
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
          <label for="narration">Narration:</label>
          <textarea type="text" class="form-control" id="narration" name="narration" required><?php echo $claim->narration;?></textarea>
        </div>   
    </div>

    <div class="card">
      <div class="card-body">
        <div class="form-inline">
          <label for="total">Claim Total:</label> &nbsp          
            <input type="text" class="form-control" value="<?php echo $claim->amount;?>" disabled> 
        </div>        
        <hr>
        <div class="table table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Head</th>
                <th>Remarks</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody id="intro">
              <?php
                 foreach ($cltrans as $cldta): 
              ?>
              <tr>
                <td><select class="custom-select" style="width: 150px;">
                <option><?php echo $cldta->claim_hd;?></option>
                  </select>
                </td>
                <td><input type="text" value="<?php echo $cldta->remarks;?>"></td>
                <td><input type="text" class="amount_cls" value="<?php echo $cldta->amount;?>">  </td>
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
    </div>
<script type="text/javascript">
  $(".livesearch").select2();
</script>