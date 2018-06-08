<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable( {
       "order": [[ 0, "desc" ],[ 1, "desc" ]]
    });
    $('#dataTable_filter').hide();
    $('#dataTable_length').hide();
    $('#dataTable_info').hide();
    $('#dataTable_paginate').hide();
} );

  function printClaimDtls() {    
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
        setTimeout(function(){WindowObject.close();},10);
    }
</script>
<div id="divToPrint">
	<div class="content-wrapper">
    	<div class="container-fluid">
    		<h3 style="text-align: center;">SYNERGIC SOFTEK SOLUTIONS PVT. LTD.</h3>
    		<h4 style="text-align: center;">55 D, DESAPRAN SASHMAL ROAD</h4>
    		<h5 style="text-align: center;">KOLKATA-33</h5>
    		<h5 style="text-align: center;">All Claim details for the period of <?php echo date('d/m/Y', strtotime($date->from_date)).' to '.date('d/m/Y', strtotime($date->to_date));?></h5>
    		<hr>
    		<?php
        if ($alldata && $emp_dtls && $date) {
    			foreach ($emp_dtls as $alldta) {
    		?>
    		<div style="margin-left: 20px;">
				Employee Name : <?php echo $alldta->emp_name;?><?php }?><br style="line-height: 28px;">
			</div>
			<hr>
	    	<div class="card">
	          	<div class="table">
		           	<table class="table table-bordered width" id="dataTable" cellpadding="4">
	              		<thead>
	                		<tr>
			                	<th>Claim Cd</th>
			                	<th>Claim Date</th>
			                  	<th>Approve Date</th>
			                  	<th>Amount</th>
			                  	<th>Project Type</th>
			                  	<th>Project Name</th>
			                  	<th>Purpose</th>
	                  			<th class="tValHide"></th>
	                		</tr>
	              		</thead>
	              		<tbody>
	              			<?php if($alldata){
	              				$total_amt = 0.00;
			                	foreach ($alldata as $aldta):
			                ?>
			                <tr>
			                  	<td class="center"><?php echo $aldta->claim_cd;?></td>
			                  	<td class="center"><?php echo date('d/m/Y',strtotime($aldta->claim_dt));?></td>
			                  	<td class="center"><?php echo date('d/m/Y',strtotime($aldta->approval_dt));?></td>
			                  	<td style="text-align:right;"><?php echo $aldta->amount;?></td>
			                  	<td class="center"><?php echo $aldta->project_type;?></td>
			                  	<td class="center"><?php echo $aldta->project_name;?></td>   
			                  	<td class="center"><?php echo $aldta->purpose;?></td>
			                  	<td  class="tValHide"><button class="btn btn-primary show-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Details" id="<?php echo $aldta->claim_cd;?>"><i class="fa fa-search fa-lg" aria-hidden="true"></i></button></td>
			                </tr>
			                <?php
			                	$total_amt += $aldta->amount;
			                	endforeach;
			                } 
                      else{
                        $total_amt = 0;
                      }
			                ?>
	             	 	</tbody>
		            </table>
		            <hr>
		            <h3 style="margin-left:285px;">Total : <?php echo $total_amt;}?></h3>
	          	</div>
	      			<div class="card-footer">
        				<button class="btn print-btn tValHide" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print" style="width: 95px;" id="" onclick="printClaimDtls();"><i class="fa fa-print fa-lg" aria-hidden="true"></i></button>
        			</div>
    		</div>
    	</div>
	</div>
</div>
		    		
    <div class="modal fade" id="clIndDtl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="dtl-show">
          
        </div>
      </div>
    </div>
  
    <script type="text/javascript">

      $('.show-btn').click(function(){
        var claim_cd = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/ind_claim_dtl_ajax'?>", { id: claim_cd } )
          .done(function( data ) {
            $('#dtl-show').html(data);
            $('#clIndDtl').modal('show');
          });
      });
    </script>

    