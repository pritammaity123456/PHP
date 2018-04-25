
<div class="content-wrapper">
    <div class="container-fluid">
      <h3>Edit Your Details :</h3>
      <hr>
      <form method="get" action="<?php echo site_url("Users/editNameProcess")?>">
      <?php
       if ($msgName == 1) {
      echo '<div class="alert alert-success">Thank You! Name Successfully Updated</div>';
      }elseif ($msgName == 2) {
          echo '<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
      }
      if ($emp_dtls) {
          foreach ($emp_dtls as $aldta){?>
      <div class="form-row">
       <strong strong style="text-decoration: underline;">Emp Name:</strong> &nbsp; <input type="hidden" id="name1" name="name1" value="<?php echo($aldta->emp_name);?>"> <p id="name" required> <?php echo($aldta->emp_name);?></p>&nbsp;<button id="save" type="button" onclick="editName()" style="height: 30px;">Edit</button>        
      </div>
    </form>
      <?php
      }
      }
      ?>
   <hr> 
   <?php
    if ($msgPass == 1) {
      echo '<div class="alert alert-success">Thank You! Password Successfully Updated</div>';
      }elseif ($msgPass == 2) {
          echo '<div class="alert alert-danger">Sorry! Either you had type a wrong password or there was an error sending your message. Please try again later</div>';
      }
   ?>
   <strong strong style="text-decoration: underline;">Change Password:</strong> 
              <div class="dropdown-divider"></div>
              <form method="post" action="<?php echo site_url("Users/editPass")?>">
                <input class="from-control" type="Password" name="oldPass" placeholder="Old Pass" required><br><input class="from-control" type="Password" id="newpass" name="newPass" placeholder="New Pass" required><br><input class="from-control" type="Password" name="newPass" id="conpass" placeholder="Confirm Pass" required>&nbsp;<button id="btnSubmit" type="button">Save</button>
              </form>

<script type="text/javascript">
    $(function () {
        $("#btnSubmit").click(function () {
            var password = $("#newpass").val();
            var confirmPassword = $("#conpass").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            else{
              document.getElementById("btnSubmit").type = 'submit';
              return true;
            }
            
        });
    });
</script>
<script type="text/javascript">
      function editName(){
        var x = document.getElementById("name");
        if (x.style.display === "none") {
          x.style.display = "block";
          document.getElementById("name1").type = 'hidden';
          document.getElementById("save").type = 'submit';
        } else {
          x.style.display = "none";
          document.getElementById("name1").type = 'text';
          document.getElementById("save").innerHTML = 'Save';
         // 
        }
      }
    </script>