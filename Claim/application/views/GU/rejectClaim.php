<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable( {
       "order": [[ 0, "desc" ],[ 1, "desc" ]]
    } );
} );
</script>
<div class="content-wrapper">
    <div class="container-fluid">
      <h3>Reject Claim</h3>
      <hr>
      
      <div class="card mb-3">
        <div class="card-header">
            
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Claim Cd</th>
                  <th>Claim Date</th>
                  <th>Project Type</th>
                  <th>Project &nbsp;Name</th>
                  <th>Purpose</th>
                  <th>From Date</th>
                  <th>To Date &nbsp;</th>
                  <th>Status</th>
                  <th>Show Claim &nbsp;</th>
                  <!--<th>Delete</th>-->
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Claim Cd</th>
                  <th>Claim Date</th>
                  <th>Project Type</th>
                  <th>Project Name</th>
                  <th>Purpose</th>
                  <th>From Date</th>
                  <th>To Date</th>
                  <th>Status</th>
                  <th>Show Claim</th>
                  <!--<th>Delete</th>-->
                </tr>
              </tfoot>
              <tbody>
              <?php if($alldata){
                foreach ($alldata as $key){
                ?>
                <tr>
                  <td><?php echo $key->claim_cd;?></td>
                  <td><?php echo date('d/m/Y',strtotime($key->claim_dt));?></td>               
                  <td><?php echo $key->project_type;?></td>
                  <td><?php echo $key->project_name;?></td>   
                  <td><?php echo $key->purpose;?></td>
                  <td><?php echo date('d/m/Y',strtotime($key->from_dt));?>  &nbsp;</td>
                  <td><?php echo date('d/m/Y',strtotime($key->to_dt));?> &nbsp;</td>
                  <td><?php echo '<span class="badge badge-danger">Rejected</span>';?></td>
                  <td><button class="btn btn-primary edit-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Details" id="<?php echo $key->claim_cd;?>"><i class="fa fa-search fa-lg" aria-hidden="true"></i></button></td>
                </tr>
                <?php
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
        $.get( "<?php echo base_url().'index.php/users/reject_claim_ajax'?>", { id: claim_cd } )
          .done(function( data ) {
            $('#claim-update').html(data);
            $('#editModal').modal('show');

          });
      });

    </script>