
<form method="post" id="form_login" action="<?php echo site_url("Admin/addClaimHeadProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label for="head_cd">Head Cd.:</label>
        <input type="text" class="form-control" id="head_cd" name="head_cd" value="<?php echo $maxCode->head_cd + 1;?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="head_desc">Head Desc:</label>
        <input type="text" class="form-control" id="head_desc" name ="head_desc" placeholder="Purpose Desc." required>
      </div>
    </div>
    <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
</form>
 