<form method="post" id="form_login" action="<?php echo site_url("Admin/editProjectTypeProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label for="type_cd">Type Cd</label>
        <input type="hidden" name="id" value="<?php echo $project->id;?>">
        <input type="text" class="form-control" id="type_cd" name="type_cd" value="<?php echo $project->type_cd;?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="type_desc">Type Desc</label>
        <input type="text" class="form-control" id="type_desc" name ="type_desc" value="<?php echo $project->type_desc;?>">
      </div>
    </div>
    Press "Save" below to modify this Project Type.
    <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
</form>