<style type="text/css">
  @media print{
  p{ color: blue !important; }
  
}
</style>
<script>
  function printDiv() {    
  var divToPrint=document.getElementById('divToPrint');

  var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;} .underline { text-decoration: underline; } p { display:inline; } .left { margin-left: 315px; text-align="left" display: inline; } .right { margin-right: 375px; display: inline; } td.left_algn { text-align: left; } td.right_algn { text-align: right; } .t2 td, th { border: 1px solid black; } td.hight { hight: 15px; } table.width { width: 100%; } table.noborder { border: 0px solid black; } th.noborder { border: 0px solid black; } .border { border: 1px solid black; } .bottom { position: absolute;; bottom: 5px; width: 100%; } } </style>');
       // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){WindowObject.close();},10);
    } 
</script>
  

<div id="divToPrint">
  <h2 class="center">Synergic Softek Solutions Pvt. Ltd.</h2>
  <h3 class="center underline">Claim Voucher</h3>
 
 <table class="width noborder" cellpadding="3.5">
  <tr>
    <th class="noborder" width="14%"></th>
    <th class="noborder" width="1%"></th>
    <th class="noborder" width="25%"></th>
    <th class="noborder" width="30%"></th>
    <th class="noborder" width="14%"></th>
    <th class="noborder" width="1%"></th>
    <th class="noborder" width="25%"></th>
  </tr>
  <tr>
     <td>Approve Date</td>
     <td class="left_algn">:</td>
     <td class="left_algn"></td>
     <td></td>
     <td>Claim Date</td>
     <td class="left_algn">:</td>
     <td><?php echo (date('d/m/Y',strtotime($claim->claim_dt)));?></td>
   </tr>
  <tr>
     <td>Claim No</td>
     <td class="left_algn">:</td>
     <td class="left_algn"><?php echo $claim->claim_cd;?></td>
     <td></td>
     <td>Purpose</td>
     <td class="left_algn">:</td>
     <td><?php echo $claim->purpose;?></td>
   </tr>
   <tr>
     <td>Project Name</td>
     <td class="left_algn">:</td>
     <td class="left_algn"><?php echo $claim->project_name;?></td>
     <td></td>
     <td>Project Type</td>
     <td class="left_algn">:</td>
     <td class="left_algn"><?php echo $claim->project_type;?></td>
   </tr>
   <tr>
     <td>Pay To</td>
     <td class="left_algn">:</td>
     <?php foreach ($alldata as $aldta):?>
     <td class="left_algn"><?php echo $aldta->emp_name;?></td>
     <?php endforeach;?>
     <td class="right_algn">Period Of Claim:</td>
     <td class="center"><?php echo date('d/m/Y',strtotime($claim->from_dt));?></td>
     <td class="left_algn"> to </td>
     <td><?php echo date('d/m/Y',strtotime($claim->to_dt));?></td>
   </tr>
  </table>
   <br>
 <table class="width" cellpadding="6" style="width:100%; ">
            <thead>
              <tr class="t2">
                <th width="10%">Sl No.</th>
                <th width="20%">Head</th>
                <th width="55%">Remarks</th>
                <th width="35%">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php
                 foreach ($cltrans as $cldta): 
              ?>
              <tr class="t2">
                <td class="center"><?php echo $cldta->sl_no;?></td>
                <td class="center"><?php echo $cldta->claim_hd;?> </td>
                <td class="left_algn"><?php echo $cldta->remarks;?></td>
                <td class="center"><?php echo $cldta->amount;?></td>
              </tr>
              <?php
                 endforeach;
              ?>
              <tr>
                <td></td>
                <td></td>
                <td class="right_algn">Total</td>
                <td class="border center"><?php echo $claim->amount;?></td>
              </tr>
            </tbody>
          </table>
          <font size="4.5">In Words : <?php echo getIndianCurrency($claim->amount);?></font>
          <?php
    function getIndianCurrency($number)
    {
      $decimal = round($number - ($no = floor($number)), 2) * 100;
      $hundred = null;
      $digits_length = strlen($no);
      $i = 0;
      $str = array();
      $words = array(0 => '', 1 => 'One', 2 => 'Two',
          3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
          7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
          10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
          13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
          16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
          19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
          40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
          70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
      $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
      while( $i < $digits_length ) {
          $divider = ($i == 2) ? 10 : 100;
          $number = floor($no % $divider);
          $no = floor($no / $divider);
          $i += $divider == 10 ? 1 : 2;
          if ($number) {
              $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
              $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
              $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
          } else $str[] = null;
      }
      $Rupees = implode('', array_reverse($str));
      $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
      return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise .' Only.';
    }
    ?>
    <br><br>
    <p>Narration : <?php echo $claim->narration;?></p> </td>
    
    <div  class="bottom">
      <table  class="width noborder">
        <thead>
          </thead>
          <?php foreach ($alldata as $aldta):?>
          <tr>
            <td class="left_algn" width="20%"><?php echo $aldta->emp_name;?></td>
            <td width="50%"></td>
            <td width="50%"></td>
          </tr>
          <?php endforeach;?>
        </thead>
        <tbody>
          <tr>
          <td>Claimed By</td>
          <td></td>
          <td>Approved By</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
     
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-secondary" type="button" onclick="printDiv();">Print</button>
    </div>

  