
<form method="post" id="form_login" action="<?php echo site_url("Admin/addPaymentProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label>Trans Date:</label>
        <input type="text" class="form-control" placeholder="<?php echo date('d/m/Y')?>" disabled>
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
                  <option value="<?php echo $aldta->emp_no;?>"><?php echo $aldta->emp_name;?></option>
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
              <select class="custom-select" id="pay_mode" name="pay_mode" style="width:250px;" required>
                <option value="CASH">CASH</option>
                <option value="CHEQUE">CHEQUE</option>
                <option value="Net Banking">Net Banking</option>
              </select>
          </div>
      </div>
      <div class="form-group col-md-6">
        <label for="pay_type">Payment Type:</label>
          <div class="col-xs-6">
              <select class="custom-select" id ="pay_type" name="pay_type" style="width:250px;" required>
                <option value="ADVANCE">ADVANCE</option>
                <option value="NORMAL">NORMAL</option>
              </select>
          </div>
      </div>
    </div>
    <div class="form-row hItems">
      <div class="form-group col-md-6">
        <label for="dp1">Cheque Date:</label>
            <input type="text" class="form-control" id="dp1" name="date1" placeholder="DD/MM/YYYY" >
          </div>
        <div class="form-group col-md-6">
        <label for="chq_no">Cheque Number:</label>
        <input type="text" class="form-control" name="chq_no" id="chq_no">
        </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6 hItems">
        <label for="bank">Bank Name:</label>
        <div class="form-group col-xs-6">
            <select class="custom-select" id="bank" name="bank" style="width:250px;" required>
              <option value="AXIS">AXIS</option>
              <option value="HDFC">HDFC</option>
            </select>
          </div>
        </div>
      <div class="form-group col-md-6">
        <label for="amount">Paid Amount:</label>
            <input type="text" class="form-control" id="amount" name="amount" required>
          </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="bank">Total Receivable:</label>
          <input type="text" class="form-control" id="rcvd_amt" readonly>
        </div>
      <div class="form-group col-md-6">
        <label for="amount">Shadow Balance</label>
            <input type="text" class="form-control" id="shadow_bal" readonly>
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
      $('.hItems').hide();
      $("#dp1").mask("99/99/9999");
});
  $(document).ready(function($){
      $("#dp1").css({"placeholder":"opacity:0.4"});
});

  $('#pay_mode').change(function(){
    var value = $(this).val();
    if ((value != 'CASH') && (value != 'Net Banking')) {
      $('.hItems').show();
    }
    else{
      $('.hItems').hide();
    }
  });
  
  $('#emp_no').change(function(){
    var emp_no = $(this).val();
    $.get('<?php echo site_url('Admin/closing_bal'); ?>', {emp_no : emp_no})
      .done(function(data){
        $('#rcvd_amt').val(data);
      });
  });

  $('#amount').change(function(){
    $('#shadow_bal').val($('#rcvd_amt').val() - $('#amount').val());
  });
</script>
