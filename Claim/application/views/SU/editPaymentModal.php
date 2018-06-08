
<form method="post" id="form_login" action="<?php echo site_url("Admin/editPaymentProcess")?>">
  <input type="hidden" class="form-control" name="trans_cd" value="<?php echo $payment->trans_cd*8191;?>">
    <div class="form-row">  
    <div class="form-group col-md-3">
        <label>Trans Code:</label>
        <input type="text" class="form-control" value="<?php echo $payment->trans_cd;?>" readonly>
      </div>   
      <div class="form-group col-md-3">
        <label>Trans Date:</label>
        <input type="text" class="form-control" placeholder="<?php echo $payment->trans_dt;?>" disabled>
      </div>
      <div class="form-group col-md-6">
        <label for="emp_name">Employee's Name</label>
        <div class="col-xs-4">
          <select class="custom-select" id="emp_no" name="emp_no" required style="width: 230px;">
          <option>Select</option>
          <?php
            if ($emp_dtls) {
                foreach ($emp_dtls as $aldta) {
                  if ($aldta->emp_no == $this->session->userdata('is_login')->emp_no){
                      continue;
                    }
                  ?>
                  <option value="<?php echo $aldta->emp_no;?>" <?php echo ($payment->emp_no == $aldta->emp_no)?'selected':''?>><?php echo $aldta->emp_name;?></option>
          <?php
                }
            }
          ?>
        </select>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="edit_pay_mode">Payment Mode:</label>
          <div class="col-xs-6">
              <select class="custom-select" id="edit_pay_mode" name="pay_mode" style="width:250px;" required>
                <option value="CASH"<?php echo ($payment->payment_mode == 'CASH')?'selected':'';?>>CASH</option>
                <option value="CHEQUE"<?php echo ($payment->payment_mode == 'CHEQUE')?'selected':'';?>>CHEQUE</option>
                <option value="Net Banking"<?php echo ($payment->payment_mode == 'Net Banking')?'selected':'';?>>Net Banking</option>
              </select>
          </div>
      </div>
      <div class="form-group col-md-6">
        <label for="pay_type">Payment Type:</label>
          <div class="col-xs-6">
              <select class="custom-select" id ="pay_type" name="pay_type" style="width:250px;" required>
                <option value="ADVANCE"<?php echo ($payment->payment_type == 'ADVANCE')?'selected':'';?>>ADVANCE</option>
                <option value="NORMAL"<?php echo ($payment->payment_type == 'NORMAL')?'selected':'';?>>NORMAL</option>
              </select>
          </div>
      </div>
    </div>
    <div class="form-row hItems">
      <div class="form-group col-md-6">
        <label for="dp1">Cheque Date:</label>
            <input type="text" class="form-control" id="dp1" name="date1" value="<?php if($payment->chq_dt > '2002-01-01'){ echo date('d/m/Y',strtotime($payment->chq_dt));}else{echo "";}?>">
          </div>
        <div class="form-group col-md-6">
        <label for="chq_no">Cheque Number:</label>
        <input type="text" class="form-control" name="chq_no" value="<?php echo $payment->chq_no;?>" id="chq_no">
        </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6 hItems">
        <label for="bank">Bank Name:</label>
        <div class="form-group col-xs-6">
            <select class="custom-select" id="bank" name="bank" style="width:250px;" required>
              <option>Select</option>
              <option value="AXIS"<?php echo ($payment->bank == 'AXIS')?'selected':'';?>>AXIS</option>
              <option value="HDFC"<?php echo ($payment->bank == 'HDFC')?'selected':'';?>>HDFC</option>
            </select>
          </div>
        </div>
      <div class="form-group col-md-6">
        <label for="amount">Pade Amount:</label>
            <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $payment->paid_amt;?>" required>
          </div>
    </div>
      <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
</form>

<script src="<?php echo base_url('js/jquery.maskedinput.js'); ?>" type="text/javascript"></script>
<script>
  $(document).ready(function($){
    if ($('#edit_pay_mode').val() == 'CHEQUE') {
       $('.hItems').show();
    }
    else{
      $('.hItems').hide();
    }
    
      $("#dp1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dp1").css({"placeholder":"opacity:0.4"});
});

  $('#edit_pay_mode').change(function(){
    var value = $(this).val();
    if ((value != 'CASH') && (value != 'Net Banking')) {
      $('.hItems').show();
    }
    else{
      $('.hItems').hide();
    }
  });
</script>