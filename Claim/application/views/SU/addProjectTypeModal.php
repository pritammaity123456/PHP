
<form method="post" id="form_login" action="<?php echo site_url("Admin/insertProjectType")?>">
    <div class="form-row">     
      <div class="form-group col-md-6">
        <label for="type_cd">Type Cd</label>
        <input type="text" class="form-control" id="type_cd" name="type_cd" value="<?php echo $maxCode->type_cd + 1;?>" readonly>
      </div>
      <div class="form-group col-md-6">
        <label for="type_desc">Type Description</label>
        <input type="text" class="form-control" id="type_desc" name ="type_desc" placeholder="Full Name" required>
      </div>
    </div>
    <div class="form-row">
     
    </div>
      <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
</form>
  <script type="text/javascript">
  $('#dp1').datepicker({
      format: 'dd/mm/yyyy'
    });
  $('#dp2').datepicker({
      format: 'dd/mm/yyyy'
    });
</script>