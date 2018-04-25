

<form method="post" action="<?php echo site_url("Users/deleteClaimProcess")?>">
	Are you sure?
	<input type="hidden" name="del" value="<?php echo $claim->claim_cd * 8191;?>">
<div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-danger" type="submit">Delete</button>
    </div>
</form>