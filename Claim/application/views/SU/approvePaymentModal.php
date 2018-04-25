<style>
.datepicker{z-index:1151 !important;}
</style>
<form method="post" id="form_login" action="<?php echo site_url("Admin/approvePaymentProcess")?>">
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
        <label for="pay_mode">Payment Mode:</label>
          <div class="col-xs-6">
              <select class="custom-select" id="pay_mode" style="width:250px;">
                <option value="CASH"<?php echo ($payment->payment_mode == 'CASH')?'selected':'';?>>CASH</option>
                <option value="NEFT"<?php echo ($payment->payment_mode == 'NEFT')?'selected':'';?>>NEFT</option>
              </select>
          </div>
      </div>
      <div class="form-group col-md-6">
        <label for="pay_type">Payment Type:</label>
          <div class="col-xs-6">
              <select class="custom-select" id ="pay_type" style="width:250px;">
                <option value="ADVANCE"<?php echo ($payment->payment_type == 'ADVANCE')?'selected':'';?>>ADVANCE</option>
                <option value="NORMAL"<?php echo ($payment->payment_type == 'NORMAL')?'selected':'';?>>NORMAL</option>
              </select>
          </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="dp1">Cheque Date:</label>
            <input type="text" class="form-control" id="dp1" value="<?php if($payment->chq_dt > '2002-01-01'){ echo date('d/m/Y',strtotime($payment->chq_dt));}else{echo "";}?>">
          </div>
        <div class="form-group col-md-6">
        <label for="chq_no">Cheque Number:</label>
        <input type="text" class="form-control" name="chq_no" value="<?php echo $payment->chq_no;?>" id="chq_no">
        </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="bank">Bank Name:</label>
        <div class="form-group col-xs-6">
            <select class="custom-select" id="bank" style="width:250px;" required>
              <option value="AXIS"<?php echo ($payment->bank == 'AXIS')?'selected':'';?>>AXIS</option>
              <option value="HDFC"<?php echo ($payment->bank == 'HDFC')?'selected':'';?>>HDFC</option>
            </select>
          </div>
        </div>
      <div class="form-group col-md-6">
        <label for="amount">Pade Amount:</label>
            <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $payment->paid_amt;?>">
          </div>
    </div>
    
      <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-success" name="check" value="1" type="submit">Approve</button>
            </div>
</form>

  <script type="text/javascript">
  $('#dp1').datepicker({
      format: 'dd/mm/yyyy'
    });
</script>