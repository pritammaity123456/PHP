<script type="text/javascript">
  
  $(document).ready(function(){
    $('#alrt').hide();
    var total = 0;
    
    $("#addrow").click(function(){
      $("#intro").append('<tr><td><select class="custom-select preferenceSelect" name="empno[]" style="width: 375px;"><option>Select</option><?php foreach ($emp_dtls as $aldta):?><option value="<?php echo $aldta->emp_no;?>"><?php echo $aldta->emp_name;?></option><?php endforeach;?> </select></td><td><button class="btn btn-danger" id="removeRow"><i class="fa fa-undo" aria-hidden="true"></i></button></td></tr>');
      $('.preferenceSelect').change();
    });

    $("#intro").on('click','#removeRow',function(){
        $(this).parent().parent().remove();
        $('.preferenceSelect').change();
    });

    
    $('.preferenceSelect').change();
    $('#intro').trigger('change');
  });

document.getElementById("myDIV").style.display = "none";
$('#user_type').change(function() {

  $('.preferenceSelect').each(function(){
        $('.preferenceSelect').find('option[value ="' + this.value + '"]').toggle(false);
    
      });

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
    if($('#manageno').val() != 0){
        $('#alrt').hide('slow');
        $('#save').prop('type', 'submit');
    }
    $('.preferenceSelect').each(function(){
        $('.preferenceSelect').find('option[value ="' + this.value + '"]').toggle(false);
    
      });
  });
  
  $('#save').click(function(){
      var typeOfUser= $('#user_type').val();
      
      if(typeOfUser == 'M' || typeOfUser == 'A' || typeOfUser == 'AC'){
          if($('#manageno').val() == 0){
              $('#alrt').show();
              $('#save').prop('type', 'button');
          }
      }
  });
</script>
<form method="post" id="form_login" action="<?php echo site_url("Admin/addUserProcess")?>">
    <div class="form-row">     
      <div class="form-group col-md-8">
        <label for="emp_name">Employee's Name</label>
        <div class="col-xs-4">
          <select class="form-control preferenceSelect" id="emp_no" name="emp_no" required="required" style="width: 310px;">
          <option value="0">Select</option>
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
      <div class="form-group col-md-4">
        <label for="user_type">User Type</label>
        <div class="col-xs-4">
              <select class="custom-select" id="user_type" name="user_type" style="width: 150px;" required="required" style="width: 150px;"> 
                <option>Select</option>
                <option value="A">Admin</option>
                <option value="AC">Accountant</option>
                <option value="M">Manager</option>
                <option value="E">Employee</option>
              </select>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="user_id">User Id:</label>
          <input type="text" class="form-control" id="user_id" name="user_id" placeholder="User Id" required>
      </div>
      <div class="form-group col-md-4">
        <label for="pass">Password:</label>
          <div class="form-group col-xs-4">
            <select class="custom-select" id="pass" name="pass" selected style="width: 150px;">
              <option value="nopass@123">Default Pass</option>
            </select>
          </div>
      </div>
      <div class="form-group col-md-4">
        <label for="status">Login Status:</label>
        <div class="form-group col-xs-6">
            <select class="custom-select" id="status" name="status" selected style="width: 150px;">
              <option value="N">Logged Out</option>
            </select>
          </div>
        </div> 
      </div>     
      <div class="form-row" id="myDIV">
      --------------------------------------------------------------------------
     <br>
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
              <tr>
                <td><select class="custom-select  preferenceSelect" id="manageno" style="width: 375px;" name="empno[]" required="required">
                  <option value="0">Select</option>
                  <?php foreach ($emp_dtls as $aldta):
                  ?>
                    <option value="<?php echo $aldta->emp_no;?>"><?php echo $aldta->emp_name;?></option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>        
      <div class="modal-footer">
        <div class="form-group col-md-6">
          <div class="alert alert-danger" id="alrt">Please choose an employee for this manager</div>
        </div>      
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="save" type="submit">Submit</button>
      </div>
</form>
