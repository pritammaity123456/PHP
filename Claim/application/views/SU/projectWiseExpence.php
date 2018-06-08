<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').dataTable( {
       "order": [0, "asc"]
    } );
    $('#dataTable_filter').hide();
    $('#dataTable_length').hide();
    $('#dataTable_info').hide();
    $('#dataTable_paginate').hide();
    //var x = document.getElementById('hide');
    //x.style.display = 'none';
} );

   
  function printClaimDtls() {      
  var divToPrint = document.getElementById('divToPrint');

  var WindowObject = window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title>');

        WindowObject.document.writeln('<style type="text/css">@media print { .center { text-align: center;} .underline { text-decoration: underline; } p { display:inline; } .left { margin-left: 315px; text-align="left"; display: inline; } .right { margin-right: 375px; display: inline; } td.left_algn { text-align: left; } td.right_algn { text-align: right; } td.hight { hight: 15px; } table.width { width: 100%; } table.noborder { border: 0px solid black; } th.noborder { border: 0px solid black; } .border { border: 1px solid black; } .bottom { position: absolute; bottom: 5px; width: 100%; } .tValHide { display:none; } } </style>');
       
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        $('#hie').hide();
        setTimeout(function(){WindowObject.close();},10);
    }
</script>

  <div class="content-wrapper">
    <div id="divToPrint">
      <h3 style="text-align: center;">SYNERGIC SOFTEK SOLUTIONS PVT. LTD.</h3>
      <h4 style="text-align: center;">55 D, DESAPRAN SASHMAL ROAD</h4>
      <h5 style="text-align: center;">KOLKATA-33</h5>
      <h5 style="text-align: center;">"<?php echo $project_name;?>" Project wise expence for the period of <?php echo date('d/m/Y', strtotime($date->from_date)).' to '.date('d/m/Y', strtotime($date->to_date));?></h5>
      
      <div>
        <hr>
      <?php
        $grant_total = 0.00;
        if ($pwExpence && $emp_dtls) {
        for ($i=0; $i < sizeof($pwExpence); $i++) { 
          foreach ($emp_dtls as $alldta) {
            if ($pwExpence[$i][0]->emp_no == $alldta->emp_no) {
        ?>
        <div style="margin-left: 20px; color: #1a719e;">
          <strong>Employee Name : <?php echo $alldta->emp_name;?><?php }}?></strong> <br style="line-height: 28px;">
        </div>
      <hr>
        <div class="card">
              <div class="table">
                <table class="table table-bordered width" id="dataTable" cellpadding="4">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($pwExpence){
                        $total_amt = 0.00;
                        for ($j=0; $j < sizeof($pwExpence[$i]); $j++) { 
                      ?>
                      <tr>
                          <td class="center"><?php echo date('d/m/Y',strtotime($pwExpence[$i][$j]->claim_dt));?></td>
                          <td style="text-align:right;"><?php echo $pwExpence[$i][$j]->amount;?></td>
                      </tr>
                      <?php
                        $grant_total += $pwExpence[$i][$j]->amount;
                        $total_amt += $pwExpence[$i][$j]->amount;
                        }
                      } 
                      else{
                        $total_amt = 0;
                      }
                      ?>
                  </tbody>
                </table>
                <hr>
                <h3 style="margin-left:500px;">Total : <?php echo $total_amt;?></h3>
              </div>
              <hr>
              <?php
              }
             } 
        ?>
        <strong>Grand Total: <?php echo $grant_total;?></strong>
          <div class="card-footer" id="hie">
            <button class="btn print-btn tValHide" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print" style="width: 95px;" id="" onclick="printClaimDtls();"><i class="fa fa-print fa-lg" aria-hidden="true"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>