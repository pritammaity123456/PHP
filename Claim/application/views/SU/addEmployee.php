<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <?php
        if ($empExists == 1) {
          echo '<div class="alert alert-success">Thank You! Employee Successfully Added</div>';
        }elseif ($empExists == 2) {
          echo '<div class="alert alert-danger">Sorry! Employee Code allready in useed</div>';
        }
        elseif ($empExists == 3) {
          echo '<div class="alert alert-success">Thank You! Employee Successfully Updated</div>';
        }
      ?>
      <h3>Employee Details</h3>
      <hr>
        <div class="card mb-3">
        <div class="card-header">
            <button class="btn btn-success add-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Employee">
                <a><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Add New </a> </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Serial No</th>
                  <th>Employee Name</th>
                  <th>Designation</th>
                  <th>Sector</th>
                  <th>Date of Joining</th>
                  <th>Status</th>
                  <th>Date of Termination</th>
                  <th></th>
                  <!--<th>Delete</th>-->
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Serial No</th>
                  <th>Employee Name</th>
                  <th>Designation</th>
                  <th>Sector</th>
                  <th>Date of Joining</th>
                  <th>Status</th>
                  <th>Date of Termination</th>
                  <th></th>
                  <!--<th>Delete</th>-->
                </tr>
              </tfoot>
              <tbody>
              <?php if($alldata){
               foreach ($alldata as $aldta):
                ?>
                <tr>
                  <td><?php echo $aldta->emp_no;?></td>
                  <td><?php echo $aldta->emp_name;?></td>
                  <td><?php echo $aldta->designation;?></td>
                  <td><?php echo $aldta->sector;?></td>
                  <td><?php if($aldta->date_of_joining > '2002-01-01'){
                        echo date('d/m/Y',strtotime($aldta->date_of_joining));
                      }else{
                        echo "";
                      }
                  ?></td>
                  <td><?php echo $aldta->status_flag?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';?></td>
                  <td><?php 
                      if($aldta->date_of_termination > '2002-01-01'){
                        echo date('d/m/Y',strtotime($aldta->date_of_termination));
                      }else{
                        echo "";
                      }
                    ?>
                  </td>
                  <td><button class="btn btn-primary edit-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" id="<?php echo $aldta->emp_no;?>">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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
      </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="employee-add">
           
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="employee-update">
           
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript">

      $('.edit-btn').click(function(){
        var emp_id = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/edit_employee_ajax'?>", { id: emp_id } )
          .done(function( data ) {
            $('#employee-update').html(data);
            $('#editModal').modal('show');
          });
      });

      $('.add-btn').click(function(){
        //var emp_id = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/add_employee_ajax'?>")
          .done(function( data ) {
            $('#employee-add').html(data);
            $('#addModal').modal('show');
          });
      });
    </script>