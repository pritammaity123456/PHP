<form method="post" id="form_login" action="<?php echo site_url("Admin/editPurposeProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label for="purpose_id">Id</label>
        <input type="text" class="form-control" id="purpose_id" name="purpose_id" value="<?php echo($purpose->id);?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="purpose_desc">Purpose Name</label>
        <input type="text" class="form-control" id="purpose_desc" name ="purpose_desc" value="<?php echo($purpose->purpose_desc);?>"  required>
      </div>
    </div>
    
    <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
</form>