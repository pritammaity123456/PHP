<div class="content-wrapper">
    <div class="container-fluid">
      <?php
        if ($purpose == 1) {
          echo '<div class="alert alert-success">Thank You! Successfully Added</div>';
        }
        elseif ($purpose == 2) {
          echo '<div class="alert alert-success">Thank You! Successfully Updated</div>';
        }
      ?>
      <h3>Purpose Details</h3>
      <hr>
      <div class="card mb-3">
        <div class="card-header">
          <button class="btn btn-success add-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Purpose"><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Add New</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Purpose Name</th>
                  <th></th
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Purpose Name</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
              <?php if($alldata){
               foreach ($alldata as $aldta):
                ?>
                <tr>
                  <td><?php echo $aldta->id;?></td>
                  <td><?php echo $aldta->purpose_desc;?></td>
                  <td><button class="btn btn-primary edit-btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit" id="<?php echo $aldta->id;?>">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button></td>
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
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="project-add">
           
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
          <div class="modal-body" id="project-update">
           
          </div>
        </div>
      </div>
    </div>


    <script type="text/javascript">
      $('.edit-btn').click(function(){
        var emp_id = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/edit_purpose_ajax'?>", { id: emp_id } )
          .done(function( data ) {
            $('#project-update').html(data);
            $('#editModal').modal('show');
          });
      });

      $('.add-btn').click(function(){
        //var emp_id = $(this).attr('id');
        $.get( "<?php echo base_url().'index.php/admin/add_purpose_ajax'?>")
          .done(function( data ) {
            $('#project-add').html(data);
            $('#addModal').modal('show');
          });
      });
    </script>