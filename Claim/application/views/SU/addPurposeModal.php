
<form method="post" id="form_login" action="<?php echo site_url("Admin/addPurposeProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label for="purpose_cd">Id:</label>
        <input type="text" class="form-control" id="purpose_cd" name="purpose_id" placeholder="Cd." required>
      </div>
      <div class="form-group col-md-6">
        <label for="purpose_desc">Purpose Name:</label>
        <input type="text" class="form-control" id="purpose_desc" name ="purpose_desc" placeholder="Purpose Desc." required>
      </div>
    </div>
    <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
</form>
 