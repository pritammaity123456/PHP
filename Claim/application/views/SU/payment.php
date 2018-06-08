<div class="content-wrapper">
    <div class="container-fluid">
       <?php
        if ($pay == 1) {
          echo '<div class="alert alert-success">Thank You! Successfully Added</div>';
        }elseif ($pay == 2) {
          echo '<div class="alert alert-success">Thank You! Successfully Updated</div>';
        }elseif ($pay == 3) {
          echo '<div class="alert alert-success">Thank You! Successfully Deleted</div>';
        }
      ?>
      <h3>Payment Details</h3>
      <hr>
      
      <div class="card mb-3">
        <div class="card-header">
            <button class="btn btn-info add-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Payment">
                <i class="fa fa-cog fa-spin" aria-hidden="true"></i> New Payment</button>
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
                  <td><?php echo $aldta->chq_dt;?></td>
                  <td><?php echo $aldta->chq_no;?></td>
                  <td><?php echo $aldta->approval_status?'<span class="badge badge-success">Approved</span>':'<span class="badge badge-danger">Unapprove</span>';?></td>
                  <td><button class="btn btn-primary edit-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" id="<?php echo $aldta->trans_cd;?>">
                          <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                    </button>&nbsp;<button class="btn btn-danger del-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete" id="<?php echo $aldta->trans_cd;?>">
                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
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
                  
                }
                ?>
              </tbody>
            </table>
          </div>
      </div>
        <div class="card-footer small text-muted"></div>
      </div>
      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment Form</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="payment-add">
           
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Payment</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="payment-del">
           
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Payment</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="payment-update">
           
          </div>
        </div>
      </div>
    </div>
    

    <script type="text/javascript">

      $('.edit-btn').click(function(){
        var t_cd = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/edit_payment_ajax'?>", { id: t_cd } )
          .done(function( data ) {
            $('#payment-update').html(data);
            $('#editModal').modal('show');
          });
      });

      $('.del-btn').click(function(){
        var id = $(this).attr('id');
        console.log('clicked');
        //$('#delModal').modal('show');
        $.get( "<?php echo base_url().'index.php/admin/del_payment_ajax'?>", { id: id } )
          .done(function( data ) {
            $('#payment-del').html(data);
            $('#delModal').modal('show');
          });
      });

      $('.add-btn').click(function(){
        //var emp_id = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/add_payment_ajax'?>")
          .done(function( data ) {
            $('#payment-add').html(data);
            $('#addModal').modal('show');
          });
      });
    </script>