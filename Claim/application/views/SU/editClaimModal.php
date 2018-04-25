<script type="text/javascript">
  document.getElementById("myDIV").style.display = "none";
  function myFunction() {
    var x = document.getElementById("myDIV");
    var y = document.getElementById("reject");
    if (x.style.display === "none") {
        x.style.display = "block";
    }
    else{
      y.value = 1;
      y.type = 'submit';
    }
  }
</script>

<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Claim For : <?php foreach ($alldata as $key){  echo $key->emp_name;}?></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
  </div>
  <div class="modal-body">
<form method="post" id="form_login" action="<?php echo site_url("Admin/editApproveClaimProcess")?>">
  <div class="form-row"> 
    <div class="form-group col-md-3">
        <label>Claim Date:</label>
        <input type="text" class="form-control" value="<?php echo date('d/m/Y',strtotime($claim->claim_dt)); ?>">
      </div>
      <div class="form-group col-md-6">
          <label for="projectName">Project Name:</label>
          <div>
            <input type="text" class="form-control" value="<?php echo $claim->project_name;?>" style="width: 200px;">
        </div>
      </div>
  </div>
    <div class="form-row"> 
      <div class="form-group col-md-3">
        <label for="claimCode">Claim Code:</label>
        <input type="text" class="form-control" value="<?php echo $claim->claim_cd;?>" readonly><input type="hidden" name="claimCode" value="<?php echo $claim->claim_cd*8191;?>">
      </div>    
      <div class="form-group col-md-6">
        <label for="purpose">Purpose:</label>
        <div>
          <input type="text" class="form-control" value="<?php echo $claim->purpose;?>" style="width: 200px;"
          >
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
        <input type="text" class="form-control" id="dp2" name ="date2" style="width: 200px;" value="<?php echo date('d/m/Y',strtotime($claim->to_dt));?>" required>
    </div>
    <div class="form-group col-md-6">
        <label for="project" style="margin-left: 15px;">Project Type:</label>
        <div>
        <input type="text" class="form-control" value="<?php echo $claim->project_type;?>" style=" margin-left: 15px; width: 200px;">
      </div>
    </div>
    
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
          <label for="narration">Narration:</label>
          <textarea type="text" class="form-control" id="narration"><?php echo $claim->narration;?></textarea>
        </div>   
    </div>

    <div class="card">
      <div class="card-body">
        <div class="form-inline">
          <label for="total">Claim Total:</label> &nbsp;          
            <input type="text" class="form-control" id="total" value="<?php echo $claim->amount;?>"> 
        </div>        
        <hr>
        <div class="table table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="25%">Head</th>
                <th width="50%">Remarks</th>
                <th width="25%">Amount</th>
              </tr>
            </thead>
            <tbody id="intro">
              <?php
                 foreach ($cltrans as $cldta): 
              ?>
              <tr>
                <td><?php echo $cldta->claim_hd;?></td>
                <td><textarea style="border: none;" rows="1" cols="35"><?php echo $cldta->remarks;?></textarea></td>
                <td><?php echo $cldta->amount;?></td>
              </tr>
              <?php
                 endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <button class="btn btn-success" id="approve" name="approval_status" value="1" type="submit">Approve</button><br style="line-height:1px;">
       <div id="myDIV">
        <div class="form-row">
          <div class="form-group col-md-12">
            <strong>Remarks:</strong>
            <textarea class="form-control" name="rejection_remarks" onclick="myFunction()" rows="2" cols="50"></textarea>
          </div>
        </div>
       </div>
      <button class="btn btn-danger" name="rejection_status" value="0" id="reject" onclick="myFunction()" type="button">Reject</button><br style="line-height:1px;">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    </div>
    <div class="modal-footer">
    
    </div>
</form>

