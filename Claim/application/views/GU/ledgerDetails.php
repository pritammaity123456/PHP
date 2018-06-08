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

        WindowObject.document.writeln('<style type="text/css">@media print { .center { text-align: center;} .underline { text-decoration: underline; } p { display:inline; } .left { margin-left: 315px; text-align="left"; display: inline; } .right { margin-right: 375px; display: inline; } td.left_algn { text-align: left; } td.right_algn { text-align: right; } td.hight { hight: 15px; } table.width { width: 100%; } table.noborder { border: 0px solid black; } th.noborder { border: 0px solid black; } .border { border: 1px solid black; } .bottom { position: absolute; bottom: 5px; width: 100%; } .tValHide { display:none; } } </style>');
       // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
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
    		<h5 style="text-align: center;">Personal Ledger between <?php echo date('d/m/Y', strtotime($date->from_date)).' to '.date('d/m/Y', strtotime($date->to_date));?></h5>
    		<hr>
    		<?php
        if ($alldata && $opening_balance && $emp_dtls && $date) {
    			foreach ($emp_dtls as $alldta) {
    		?>
    		<div style="margin-left: 20px;">
				Employee Name : <?php echo $alldta->emp_name;?><?php }?><br style="line-height: 28px;">
        <?php if ($opening_balance){

          echo "Openning Balance : ".$opening_balance->balance_amt;
        }
        else{
          echo "Openning Balance : 0";
        }
        ?>
			</div>
			<hr>
	    	<div class="card">
	          	<div class="table">
		           	<table class="table table-bordered width" cellpadding="4">
	              		<thead>
	                		<tr>
			                	<th>Date</th>
			                	<th style="text-align:right;">Claimed Amount</th>
			                  	<th style="text-align:right;">Received Amount</th>
			                  	<th style="text-align:right;">Closing Balance</th>
	                		</tr>
	              		</thead>
	              		<tbody>
	              		<?php
	              			$total_cl_amt = 0.00;
                            $total_rcv_amt = 0.00;
	              			if($alldata){
			                  foreach ($alldata as $aldta):
			            ?>
			                <tr>
			                  	<td class="center"><?php echo date('d/m/Y',strtotime($aldta->balance_dt));?></td>
                                <td style="text-align:right;"><?php echo $aldta->claim_amt;?></td>
			                  	<td style="text-align:right;"><?php echo $aldta->rcvd_amt;?></td>
			                  	<td style="text-align:right;"><?php echo $aldta->balance_amt;?></td>
			                </tr>
			            <?php
			                	$total_cl_amt += $aldta->claim_amt;
                                $total_rcv_amt += $aldta->rcvd_amt;
			                	endforeach;
			                } 
			            ?>
                      <tr id="hie">
                          <td><hr></td>
                          <td><hr></td>
                          <td><hr></td>
                          <td><hr></td>
                      </tr>
                       <tr>
                          <td style="text-align:right;">Total</td>
                          <td style="text-align:right;"><?php echo $total_cl_amt;?></td>
                          <td style="text-align:right;"><?php echo $total_rcv_amt;?></td>
                          <td></td>
                       </tr>
	             	 	</tbody>
		            </table>
                <?php
              }
                ?>
	          	</div>
      			<div class="card-footer">
    				<button class="btn print-btn tValHide" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print" style="width: 95px;" id="" onclick="printClaimDtls();"><i class="fa fa-print fa-lg" aria-hidden="true"></i></button>
    			</div>
    		</div>
    	</div>
	</div>
</div>