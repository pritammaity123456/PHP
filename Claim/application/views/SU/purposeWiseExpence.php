<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').dataTable( {
       "order": [0, "asc"]
    } );
    $('#dataTable_filter').hide();
    $('#dataTable_length').hide();
    $('#dataTable_info').hide();
    $('#dataTable_paginate').hide();
    $('#hie').hide();
    //var x = document.getElementById('hide');
    //x.style.display = 'none';
} );

   
  function printClaimDtls() { 
    $('#hie').show();   
  var divToPrint = document.getElementById('divToPrint');

  var WindowObject = window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title>');

        WindowObject.document.writeln('<style type="text/css">@media print { .center { text-align: center;} .underline { text-decoration: underline; } p { display:inline; } .left { margin-left: 315px; text-align="left"; display: inline; } .right { margin-right: 375px; display: inline; } td.left_algn { text-align: left; } td.right_algn { text-align: right; } td.hight { hight: 15px; } table.width { width: 100px; } table.noborder { border: 0px solid black; } th.width { width: 10px; } .border { border: 1px solid black; } .bottom { position: absolute; bottom: 5px; width: 100%; } .tValHide { display:none; } } </style>');
       
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        $('#hie').hide();
        setTimeout(function(){WindowObject.close();},10);
    }
</script>
<div id="divToPrint">
  <div class="content-wrapper">
    <div class="container-fluid">
      <h3 style="text-align: center;">SYNERGIC SOFTEK SOLUTIONS PVT. LTD.</h3>
      <h4 style="text-align: center;">55 D, DESAPRAN SASHMAL ROAD</h4>
      <h5 style="text-align: center;">KOLKATA-33</h5>
      <h5 style="text-align: center;">Purpose wise expense for the period of <?php echo date('d/m/Y', strtotime($date->from_date)).' to '.date('d/m/Y', strtotime($date->to_date));?></h5>
      
      <div>
        <hr>
        <?php 
          if($prwExpence){
        	foreach ($row as $data) {
            echo "Emp No. : ".$data->emp_no."<br>";
            echo "Emp Name : ".$data->emp_name."<br>";
            $count = 0;
            foreach ($prwExpence as $key) {
                    if ($data->emp_no == $key->emp_no) {
                        echo "<div style='margin-left:300px;'>";
                        ?>
                        <table class="width" style="width: 85%;">
                          <tr>
                            <th class="width" width="75%"></th>
                            <th class="width" width="25%"></th>
                          </tr>
                          <tr>
                            <td ><?php echo $key->purpose;?></td>
                            <td class="right_algn" style="text-align: right;"><?php echo $key->amount;?></td>
                          </tr>
                        </table>
                        <?php
                        echo "</div>";
                        $count += $key->amount;
                    }
                }?>
                <div style='margin-left:325px;'>
                  <table class="width" style="width: 85%;">
                  <tr>
                    <td class="width" width="75%"><hr></td>
                    <td class="width" width="25%"><hr></td>
                  </tr>
                  <tr>
                    <td style="text-align: right;" >Total</td>
                    <td class="right_algn"><?php echo $count;?></td>
                  </tr>
                </table>
                </div>
                
                <?php
              echo"<hr>"; 
          }
          }
        ?>
      </div>
      <div class="card-footer">
        <button class="btn print-btn tValHide" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print" style="width: 95px;" id="" onclick="printClaimDtls();"><i class="fa fa-print fa-lg" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>
</div>

    