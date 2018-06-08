<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable( {
       "order": [[ 0, "desc" ],[ 1, "desc" ]]
    } );
} );
</script>
<div class="content-wrapper">
    <div class="container-fluid">
      <?php
        if ($aprvd == 1) {
          echo '<div class="alert alert-success">Thank You! Approved Successfully</div>';
        }
        else if ($aprvd == 2){
          echo '<div class="alert alert-danger">Thank You! Reject Successfully</div>'; 
        }
        else if ($aprvd == 3){
          echo '<div class="alert alert-danger">Sorry! Already Rejected </div>'; 
        }
        else if ($aprvd == 4){
          echo '<div class="alert alert-danger">Sorry! Already Approved </div>'; 
        }
      ?>
      <h3>Approve Claim</h3>
      <hr>
      
      <div class="card mb-3">
        <div class="card-header">
            <div class="load"></div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Claim Cd</th>
                  <th>Claim Date</th>
                  <th>Emp Name</th>
                  <th>Narration &nbsp;</th>
                  <th>Amount</th>
                  <th>Approval Status</th>
                  <th>Show Claim &nbsp;</th>
                  <!--<th>Delete</th>-->
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Claim Cd</th>
                  <th>Claim Date</th>
                  <th>Emp Name</th>
                  <th>Narration</th>
                  <th>Amount</th>
                  <th>Approval Status</th>
                  <th>Show Claim</th>
                  <!--<th>Delete</th>-->
                </tr>
              </tfoot>
              <tbody>
              <?php
              $grand_total = 0;
              if($alldata){
                foreach ($alldata as $aldta){
                  foreach ($aldta as $key) {
                    foreach ($emp_dtls as $dtls){
                      if($dtls->emp_no == $key->emp_no){
                    ?>
                    <tr>
                      <td><?php echo $key->claim_cd;?></td>
                      <td><?php echo date('d/m/Y',strtotime($key->claim_dt));?></td>
                      <td><?php echo $dtls->emp_name;?></td>
                      <td><?php echo $key->narration;?></td>
                      <td><?php echo $key->amount;?></td>
                      <td><?php echo $key->approval_status?'<span class="badge badge-success">Approved</span>':'<span class="badge badge-danger">Unapprove</span>';?></td>
                      <td><button class="btn btn-primary edit-btn onClick" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Details" id="<?php echo $key->claim_cd;?>"><i class="fa fa-search fa-lg" aria-hidden="true"></i></button></td>
                    </tr>
                    <?php
                        $grand_total +=  $key->amount;
                      }
                    }   
                  }
                } 
              }
                else
                {
                  
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <strong style="font-size: 30px;">Grand Total: <?php echo $grand_total; ?></strong>
        <div class="card-footer small text-muted"></div>
      </div>

      <div class="modal fade" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="claim-update">
          
        </div>
      </div>
    </div>


    <script type="text/javascript">

      $('.edit-btn').click(function(){
        var claim_cd = $(this).attr('id');
        $('.onClick').hide();
        $('.load').addClass('loading');
        $.get( "<?php echo base_url().'index.php/admin/edit_claim_ajax'?>", { id: claim_cd } )
          .done(function( data ) {
            $('#claim-update').html(data);
            $('#editModal').modal('show');
            $('.load').removeClass('loading');
            $('.onClick').show();
          });
      });

    </script>