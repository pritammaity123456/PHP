<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="bg-info text-white">
          <a class="img-fluid align-items-center" href="">
              <img class="img-responsive" src="http://www.synergicsoftek.in/wp-content/themes/Untitled/images/15b27e558a936f5a396a0ce89553abc5_ssslogonew.png" alt="Cooperative Banking Software">
          </a>
          <div class="col-12">
            <h1 class="lead">Synergic Softek Solutions Pvt. Ltd.</h1>
            <p class="align-items-center lead">55 D, Desapran Sasmal Road, Kolkata, West Bengal 700033 <br>
            An ISO 9001:2008 certified company.
          </p>
          </div>
          
        </li>
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