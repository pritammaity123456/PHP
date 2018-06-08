<script type="text/javascript">
  
  $(document).ready(function(){
    var total = 0;
    
    $("#addrow").click(function(){
      $("#intro").append('<tr><td><select class="custom-select preferenceSelect" name="empno[]" style="width: 375px;"><option>Select</option><?php foreach ($emp_dtls as $aldta){ if($user["0"]->emp_no == $aldta->emp_no) {continue;}?><option value="<?php echo $aldta->emp_no;?>"><?php echo $aldta->emp_name;?></option><?php }?> </select></td><td><button class="btn btn-danger" id="removeRow"><i class="fa fa-undo" aria-hidden="true"></i></button></td></tr>');
      $('.preferenceSelect').change();
    });

    $("#intro").on('click','#removeRow',function(){
        $(this).parent().parent().remove();
        $('.preferenceSelect').change();
    });

    
    $('.preferenceSelect').change();
    $('#intro').trigger('change');
  });


  if (document.getElementById("user_type").value == 'E') {
      document.getElementById("myDIV").style.display = "none";    
  }


$('#user_type').on('change', function() {

  var value = $(this).val();
  if (value == 'M') {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    }
  }else if(value == 'A') {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    }
  }else if(value == 'AC') {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    }
  }
  else{
    document.getElementById("myDIV").style.display = "none";
  }
});


$('#intro').trigger('change');

$('#intro').on("change", ".preferenceSelect", function() {
    
    $('.preferenceSelect').each(function(){
        $('.preferenceSelect').find('option[value ="' + this.value + '"]').toggle(false);
    
      });
  });
</script>
<div class="modal-header">
  <?php foreach ($user as $key) {?>
  <h5 class="modal-title" id="exampleModalLabel">Employee's No : <?php echo $key->emp_name;?></h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">×</span>
    </button>
          </div>
          <div class="modal-body" >
  <form method="post" id="form_login" action="<?php echo site_url("Admin/editUserProcess")?>">
    <div class="form-row">  
      <div class="form-group col-md-4">
        <label for="user_id">User Id:</label>
          <input type="text" class="form-control" id="user_id" value="<?php echo $key->user_id;?>" name="user_id" placeholder="User Id">
      </div>
        <input type="hidden" name="emp_no" value="<?php echo $key->emp_no;?>">
      <div class="form-group col-md-6">
        <label for="user_type">User Type</label>
        <div class="col-xs-6">
              <select class="custom-select" id="user_type" name="user_type" onchange="changeFunc();" required style="width: 150px;">
                <option>Select</option>
                <option value="A"<?php echo ($key->user_type
                  == 'A')?'selected':'';?>>Admin</option>
                  <option value="AC"<?php echo ($key->user_type
                  == 'AC')?'selected':'';?>>Accountant</option>
                  <option value="M"<?php echo ($key->user_type
                  == 'M')?'selected':'';?>>Manager</option>
                <option value="E"<?php echo ($key->user_type
                  == 'E')?'selected':'';?>>Employee</option>
              </select>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="pass">Password:</label>
          <div class="form-group col-xs-4">
            <select class="custom-select" id="pass" name="pass" selected style="width: 150px;">
              <option value="noVal">Existing</option>
              <option value="nopass@123">Default Pass</option>
            </select>
          </div>
      </div>
      <div class="form-group col-md-4">
        <label for="status">Login Status:</label>
        <div class="form-group col-xs-6">
            <select class="custom-select" id="status" name="status" selected style="width: 150px;">
              <option value="N"<?php echo ($key->user_status
                  == 'N')?'selected':'';?>>Logged Out</option>
            </select>
          </div>
        </div> 
      </div>
      <?php
        }    
      ?>

      <div class="form-row" id="myDIV">
      --------------------------------------------------------------------------
        
        Choose Employess for Manage:
      <div class="table table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Employee's Name</th>
                <th><button class="btn btn-success" type="button" id="addrow"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button></th>
              </tr>
            </thead>
            <tbody id="intro">
              <?php 
                if ($data) {

                 foreach ($data as $aldta):
              ?>
              <tr>
                <td><select class="custom-select  preferenceSelect" style="width: 375px;" name="empno[]">
                    <?php foreach ($emp_dtls as $edta) { ?>
                      <option value="<?php echo $aldta->manage_no;?>" <?php echo ($aldta->manage_no == $edta->emp_no)?'selected':'';?>><?php
                        if ($aldta->manage_no == $edta->emp_no) {
                          echo $edta->emp_name;
                        }?>                          
                      </option>
                    <?php
                  }?>
                  </select>
                </td>
                <td><button class="btn btn-danger" id="removeRow"><i class="fa fa-undo" aria-hidden="true"></i></button></td>
              </tr>
              <?php
                endforeach;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div> 
      <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
  </form>
</div>

