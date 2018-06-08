<style>
.datepicker{z-index:1151 !important;}
</style>
<form method="post" id="form_login" action="<?php echo site_url("Admin/approvePaymentProcess")?>">
  <input type="hidden" class="form-control" name="trans_cd" value="<?php echo $payment->trans_cd*8191;?>">
    <div class="form-row">  
    <div class="form-group col-md-12">
      <label for="emp_name">Employee's Name:
          <?php
            if ($emp_dtls) {
                foreach ($emp_dtls as $aldta) {
                  if($payment->emp_no == $aldta->emp_no){
                        echo $aldta->emp_name;
                    }    
                }
            }
          ?></label>
      </div>
    </div>
    <div class="form-row">  
    <div class="form-group col-md-6">
        <label>Trans Code: <?php echo $payment->trans_cd;?></label>
    </div>   
    <div class="form-group col-md-6">
        <label>Trans Date: <?php echo date('d/m/Y',strtotime($payment->trans_dt));?></label>
    </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="pay_mode">Payment Mode: <?php echo $payment->payment_mode;?></label>
      </div>
      <div class="form-group col-md-6">
        <label for="pay_type">Payment Type: <?php echo $payment->payment_type; ?></label>
      </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="dp1">Cheque Date: <?php if($payment->chq_dt > '2002-01-01'){ echo date('d/m/Y',strtotime($payment->chq_dt));}else{echo "";}?></label>
    </div>
    <div class="form-group col-md-6">
      <label for="chq_no">Cheque Number: <?php echo $payment->chq_no;?></label>
    </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="bank">Bank Name: <?php echo $payment->bank; ?></label>
        <div class="form-group col-xs-6">
            
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="amount">Paid Amount: <?php echo $payment->paid_amt;?></label>
            
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