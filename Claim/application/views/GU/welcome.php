<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <div style="width: 100%; text-align: center; margine-right:50px; margine-left:10px;">
        <li class="bg-info text-white">
        <a class="img-fluid align-items-center col-6" href="">
              <img class="img-responsive" src="<?php echo base_url('Slogo2.png');?>" alt="Synergic Claim Software" height="150" width="350">
          </a>
          <div class="col-12">
            <h1 class="lead" style="Monotype Corsiva">Synergic Softek Solutions Pvt. Ltd.</h1>
            <p class="align-items-center lead">55 D, Desapran Sasmal Road, Kolkata, West Bengal 700033
          </p>
          <br>
          </div>
          
        </li>
        </div>
      </ol>
      <hr>
      <div>
      <h3 class="breadcrumb">Employee Details</h3>
      <hr>
      <div style="margin: 25px;">
        <?php
        if ($alldata) {
          foreach ($alldata as $aldta):?>
      <div class="form-row form-row">
       <p> Emp Name : <?php echo($aldta->emp_name);?> </p>
      </div>
      <div class="form-row">
      <p>Designation : <?php echo($aldta->designation);?></p>
      </div>
      <div class="form-row">
      <p>Sector  : <?php echo($aldta->sector);?></p>
      </div>
      <div class="form-row">
      <?php if ($closing_bal){

        echo "Total Receivable : ".$closing_bal->balance_amt;
      }
      else{
        echo "Total Receivable : 0";
      }
      ?>
      </div>
      <?php
      endforeach;
     }?>
      </div>
    </div>
     
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