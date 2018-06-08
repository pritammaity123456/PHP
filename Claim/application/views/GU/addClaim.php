<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable( {
       "order": [[ 0, "desc" ],[ 1, "desc" ]]
    });
});
</script>

<div class="content-wrapper">
    <div class="container-fluid">
      <?php
        if ($claimed == 1) {
          echo '<div class="alert alert-success">Thank You! Successfully Added</div>';
        }elseif ($claimed == 2) {
          echo '<div class="alert alert-success">Thank You! Successfully Updated</div>';
        }elseif ($claimed == 3) {
          echo '<div class="alert alert-success">Thank You! Successfully Deleted</div>';
        }
      ?>
      <h3>Claim Details </h3>
      <hr>
      
      <div class="card mb-3">
        <div class="card-header">
            <button class="btn btn-info add-btn onClick" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="New Claim Form">
                <i class="fa fa-cog fa-spin" aria-hidden="true"></i> New</button>
            <div class="load"></div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Claim Cd</th>
                  <th>Claim Date</th>
                  <th>Amount</th>
                  <th>Narration &nbsp;</th>
                  <th>Approval Status</th>
                  <th>Modification &nbsp;</th>
                  <!--<th>Delete</th>-->
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Claim Cd</th>
                  <th>Claim Date</th>
                  <th>Amount</th>
                  <th>Narration</th>
                  <th>Approval Status</th>
                  <th>Modification</th>
                  <!--<th>Delete</th>-->
                </tr>
              </tfoot>
              <tbody>
              <?php
              $grand_total = 0;
              if($alldata){
                foreach ($alldata as $aldta):
                  if ($aldta->approval_status == 1 || $aldta->rejection_status == 1) {
                    continue;
                  }
                ?>
                <tr>
                  <td><?php echo $aldta->claim_cd;?></td>
                  <td><?php echo date('d/m/Y',strtotime($aldta->claim_dt));?></td>
                  <td><?php echo $aldta->amount;?></td>
                  <td><?php echo $aldta->narration;?></td>
                  <td><?php echo $aldta->approval_status?'<span class="badge badge-success">Approved</span>':'<span class="badge badge-danger">Unapprove</span>';?></td>
                  <td><button class="btn btn-primary edit-btn onClick" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" id="<?php echo $aldta->claim_cd;?>">
                        <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                    </button>&nbsp;<button class="btn btn-danger del-btn onClick" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete" id="<?php echo $aldta->claim_cd;?>">
                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
                    </button>&nbsp;<button class="btn print-btn onClick" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print" style="width: 95px;" id="<?php echo $aldta->claim_cd;?>">
                        <i class="fa fa-print fa-lg" aria-hidden="true"></i>
                    </button></td>
                </tr>
                <?php
                $grand_total += $aldta->amount;
                endforeach;
                } 
                else
                {
                  echo "Add Your First Claim!";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
        <strong>Grand Total: <?php echo $grand_total;?></strong>
      </div>
      <div class="modal fade" id="addModal"  role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Claim Form</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="claim-add">
           
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approved Claim</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="claim-show">
           
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="claim-update">
          
        </div>
      </div>
    </div>

    <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Claim</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="claim-del">
           
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade modal-fullscreen" id="printModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="claim-print">
           
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript">

      $('.show-btn').click(function(){
        var emp_id = $(this).attr('id');
        $('.onClick').hide();
        $('.load').addClass('loading');
        $.get( "<?php echo base_url().'index.php/users/show_claim_ajax'?>", { id: emp_id } )
          .done(function( data ) {
            $('#claim-show').html(data);
            $('#showModal').modal('show');
            $('.load').removeClass('loading');
            $('.onClick').show();
          });
      });

      $('.print-btn').click(function(){
        var emp_id = $(this).attr('id');
        $('.onClick').hide();
        $('.load').addClass('loading');
        $.get( "<?php echo base_url().'index.php/users/print_claim_ajax'?>", { id: emp_id } )
          .done(function( data ) {
            $('#claim-print').html(data);
            $('#printModal').modal('show');
            $('.load').removeClass('loading');
            $('.onClick').show();
          });
      });

      $('.edit-btn').click(function(){
        var emp_id = $(this).attr('id');
        $('.onClick').hide();
        $('.load').addClass('loading');
        $.get( "<?php echo base_url().'index.php/users/edit_claim_ajax'?>", { id: emp_id } )
          .done(function( data ) {
            $('#claim-update').html(data);
            $('#editModal').modal('show');
            $('.load').removeClass('loading');
            $('.onClick').show();
          });
      });

      $('.del-btn').click(function(){
        var id = $(this).attr('id');
        $('.onClick').hide();
        $('.load').addClass('loading');
        $.get( "<?php echo base_url().'index.php/users/del_claim_ajax'?>", { id: id } )
          .done(function( data ) {
            $('#claim-del').html(data);
            $('#delModal').modal('show');
            $('.load').removeClass('loading');
            $('.onClick').show();
          });
      });

      $('.add-btn').click(function(){
        $('.onClick').hide();
        $('.load').addClass('loading');
        $.get( "<?php echo base_url().'index.php/users/add_claim_ajax'?>")
          .done(function( data ) {
            $('#claim-add').html(data);
            $('#addModal').modal('show');
            $('.load').removeClass('loading');
            $('.onClick').show();
          });
      });

     
    </script>

    