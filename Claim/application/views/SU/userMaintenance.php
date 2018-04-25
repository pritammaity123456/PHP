<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable( {
       "order": [ 0, "asc" ]
    });
  });
  </script>  

<div class="content-wrapper">
    <div class="container-fluid">
      <?php
        if ($m_user == 1) {
          echo '<div class="alert alert-success">Thank You! User Successfully Added.</div>';
        }elseif ($m_user == 2) {
          echo '<div class="alert alert-success">Thank You! User Successfully Updated.</div>';
        }elseif ($m_user == 3) {
          echo '<div class="alert alert-warning">Sorry! Please add the User as an "Employee" first.</div>';
        }
        elseif ($m_user == 4) {
          echo '<div class="alert alert-danger">Sorry! This User is already created.</div>';
        }
      ?>
      <h3>User Details</h3>
      <p style="text-align: right; color: red;">*Please make sure the user you want to add is already added as an Employee.</p>
      <hr>
        <div class="card mb-3">
        <div class="card-header">
            <button class="btn btn-success add-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add User">
                <a><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Add New </a> </button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Employee No.</th>
                  <th>User Type</th>
                  <th>Emp Name</th>
                  <th>User Status</th>
                  <th></th>
                  <!--<th>Delete</th>-->
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Employee No.</th>
                  <th>User Type</th>
                  <th>Emp Name</th>
                  <th>User Status</th>
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
                  <td><?php if($aldta->user_type == 'A'){
                      echo '<span class="badge badge-success">Admin</span>';
                    }elseif ($aldta->user_type == 'M') {
                      echo '<span class="badge badge-warning">Manager</span>';
                    }elseif ($aldta->user_type == 'AC') {
                      echo '<span class="badge badge-dark">Accountant</span>';
                    }else{
                      echo '<span class="badge badge-info">Employee</span>';
                    }
                    ?></td>
                  <td><?php echo $aldta->emp_name;?></td>
                  <td><?php echo ($aldta->user_status == 'Y')?'<span class="badge badge-warning">Logged In</span>':'<span class="badge badge-primary">Logged Out</span>';?></td>
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
                  echo "Add Your First Claim!";
                }
              ?>
              </tbody>
            </table>
          </div>
      </div>
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
        <div class="modal-content" id="employee-update">
          
        </div>
      </div>
    </div>


    <script type="text/javascript">

      $('.edit-btn').click(function(){
        var emp_id = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/edit_user_ajax'?>", { id: emp_id } )
          .done(function( data ) {
            $('#employee-update').html(data);
            $('#editModal').modal('show');
          });
      });

      $('.add-btn').click(function(){
        //var emp_id = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/add_user_ajax'?>")
          .done(function( data ) {
            $('#employee-add').html(data);
            $('#addModal').modal('show');
          });
      });
    </script>