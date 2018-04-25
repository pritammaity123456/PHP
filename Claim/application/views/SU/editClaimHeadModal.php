
<form method="post" id="form_login" action="<?php echo site_url("Admin/editClaimHeadProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label for="head_cd">Head Cd.:</label>
        <input type="text" class="form-control" id="head_cd" name="head_cd" value="<?php echo($claim_head->head_cd);?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="head_desc">Head Desc:</label>
        <input type="text" class="form-control" id="head_desc" name ="head_desc" value="<?php echo($claim_head->head_desc);?>" required>
      </div>
    </div>
    <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
</form>
 