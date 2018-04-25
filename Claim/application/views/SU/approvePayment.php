<div class="content-wrapper">
    <div class="container-fluid">
      <?php
        if ($paid == 1) {
          echo '<div class="alert alert-success">Thank You! Approved Successfully</div>';
        }
      ?>
      <h3>Approve Payment</h3>
      <hr>
      
      <div class="card mb-3">
        <div class="card-header">
            
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Trans Cd</th>
                  <th>Trans Date</th>
                  <th>Emp No</th>
                  <th>Payment Mode</th>
                  <th>Payment Type</th>
                  <th>Cheque Date</th>
                  <th>Cheque Number</th>
                  <th>Approval Status</th>
                  <th>Modification</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Trans Cd</th>
                  <th>Trans Date</th>
                  <th>Emp No</th>
                  <th>Payment Mode</th>
                  <th>Payment Type</th>
                  <th>Cheque Date</th>
                  <th>Cheque Number</th>
                  <th>Approval Status</th>
                  <th>Modification</th>
                </tr>
              </tfoot>
              <tbody>
              <?php if($alldata){
                foreach ($alldata as $aldta):
                  if ($aldta->approval_status) {
                      continue;
                  }
                ?>
                <tr>
                  <td><?php echo $aldta->trans_cd;?></td>
                  <td><?php echo date('d/m/Y',strtotime($aldta->trans_dt));?></td>
                  <td><?php echo $aldta->emp_no;?></td>
                  <td><?php echo $aldta->payment_mode;?></td>   
                  <td><?php echo $aldta->payment_type;?></td>
                  <td><?php echo date('d/m/Y',strtotime($aldta->chq_dt));?></td>
                  <td><?php echo $aldta->chq_no;?></td>
                  <td><?php echo $aldta->approval_status?'<span class="badge badge-success">Approved</span>':'<span class="badge badge-danger">Unapprove</span>';?></td>
                  <td><button class="btn btn-primary edit-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Details" id="<?php echo $aldta->trans_cd;?>">
                          <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                    </button></td>
            <!--<td><a class="btn btn-danger" href="path/to/settings" aria-label="Delete">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
          </a></td>-->
                </tr>
                <?php
                endforeach;
                } 
                else
                {
                  echo "No Payment!";
                }
                ?>
              </tbody>
            </table>
          </div>
      </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Approve Payment</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="approvePayment-update">
           
          </div>
        </div>
      </div>
    </div>
    

    <script type="text/javascript">

      $('.edit-btn').click(function(){
        var t_cd = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/approve_payment_ajax'?>", { id: t_cd } )
          .done(function( data ) {
            $('#approvePayment-update').html(data);
            $('#editModal').modal('show');
          });
      });

    </script>