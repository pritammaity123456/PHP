<!DOCTYPE html>
<html lang="en">

  <head>
    <link rel="icon" href="<?php echo base_url('favicon.ico');?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title;?></title>
    
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.js')?>"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>">
    
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css')?>">
     <!-- Page level plugin CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css')?>">
    <link  rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css')?>">

    
    
    <link rel="stylesheet" href="http://silviomoreto.github.io/bootstrap-select">
    <link rel="stylesheet" href="<?php echo base_url('css/sb-admin.css')?>">
    <!-- Latest compiled and minified JavaScript -->


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>


  </head>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo site_url("Users/index") ?>">Welcome <?php echo $this->session->userdata('loggedin')->emp_name;?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo site_url("Users/index")?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Claim">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseClaimPages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Claim</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseClaimPages">
              <li>
                <a class="nav-link" href="<?php echo site_url('Users/addClaim')?>">Add Claim</a>
              </li>
              <?php
                if (($this->session->userdata('loggedin')->user_type != 'E') ) {?>
                <li>
                  <a class="nav-link" href="<?php echo site_url('Admin/approveClaim')?>">Approve Claim</a>
                </li>
              <?php
                }
              ?>
          </ul>
        </li>
        
            <?php
                if ($this->session->userdata('loggedin')->user_type == 'A') {?>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Master Components">
                  <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">User Master</span>
                  </a>
                  <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li>
                      <a href="<?php echo site_url('Admin/addProjectType');?>">Project Types</a>
                    </li>
                    <li>
                      <a href="<?php echo site_url('Admin/addProjects');?>">Project Names</a>
                    </li>
                    <li>
                      <a href="<?php echo site_url('Admin/addPurpose');?>">Purpose</a>
                    </li>
                    <li>
                      <a href="<?php echo site_url('Admin/addClaimHead');?>">Add Claim Head</a>
                    </li>
                    <li>
                      <a href="<?php echo site_url('Admin/addEmployee');?>">Employee Details</a>
                    </li>
                    <li>
                      <a href="<?php echo site_url('Admin/userMaintenance');?>">User Maintenance</a>
                    </li>
                  </ul>
                </li>

             <?php 
           }
        if ($this->session->userdata('loggedin')->user_type == 'AC') {
              ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Payment Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Payment</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="<?php echo site_url('Admin/payment')?>">Add Payment</a>
            </li>
            <li>
              <a href="<?php echo site_url('Admin/approvePayment')?>">Approve Payment</a>
            </li>
          </ul>
        </li>
        <?
      }
      ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#reports" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Reports</span>
          </a>
          <ul class="sidenav-second-level collapse" id="reports">
            <li class="claim_dtls">
              <a class="nav-link" data-toggle="modal" data-target="#claimDtl">Claim Detail</a>
            </li>
            <li class="ledger_dtls">
              <a class="nav-link" data-toggle="modal" data-target="#ledgerDtl">Personal Ledger</a>
            </li>
            <li class="userPayment_dtls">
              <a class="nav-link" data-toggle="modal" data-target="#userPaymentDtl">Payment Details</a>
            </li>
              <?php
                if ($this->session->userdata('loggedin')->user_type != 'E') {?>
                <li>
                  <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2"><strong>Admin Reports</strong></a>
                  <ul class="sidenav-third-level collapse" id="collapseMulti2">
                    <li class="pwe">
                      <a  class="nav-link" data-toggle="modal" data-target="#pweDtl">Project wise Expence</a>
                    </li>
                    <li class="prwe">
                      <a  class="nav-link" data-toggle="modal" data-target="#prweDtl">Purpose wise Expence</a>
                    </li>
                    <li class="claim_adminDtl">
                      <a class="nav-link" data-toggle="modal" data-target="#claimAdminDtl">All Claim Details</a>
                    </li>
                    <li class="cl_balance">
                      <a class="nav-link" data-toggle="modal" data-target="#alclbalns">All Closing Balances</a>
                    </li>
                    <li class="emp_cl_balance">
                      <a class="nav-link" data-toggle="modal" data-target="#empClBalns">Employee Balances</a>
                    </li>
                    <li class="totalClaimDtl">
                      <a class="nav-link" data-toggle="modal" data-target="#totalClaimDtl">Total Claim Details</a>
                    </li>
                    <li class="distWiseExp">
                      <a class="nav-link" data-toggle="modal" data-target="#dwiseExp">District Wise Expence</a>
                    </li>
                    <?php if ($this->session->userdata('loggedin')->user_type == 'AC') {?>
                      <li class="payment_dtls">
                      <a class="nav-link" data-toggle="modal" data-target="#paymentDtl">Payment Detail</a>
                    </li>
                    <?php
                    }
                    ?>
                  </ul>
                </li>
                <?php } ?>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
          <a class="nav-link" href="<?php echo site_url('Users/settings');?>">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Settings</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
       <ul class="navbar-nav ml-auto">
        <?php
          if ($this->session->userdata('loggedin')->user_type != 'E') {
          ?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" href="<?php echo site_url('Admin/approveClaim');?>">
            <i class="fa fa-fw fa-bell"></i>
            <?php if($total_claim){
              if($total_claim == 0){
                echo ' ';
              }
              elseif ($total_claim > 0) {
                echo '<span class="indicator badge badge-pill badge-primary  d-lg-block">'.$total_claim.'</span>';
              }else{
                echo ' ';
              }
            }
            else{
              echo ' ';
            }
              ?>
            
          </a>
        </li>
         <?php
      }
      if ($this->session->userdata('loggedin')->user_type == 'AC') {
      ?>
      
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="<?php echo site_url('Admin/approvePayment');?>">
            <i class="fa fa-fw fa-bell"></i>
            
              <?php if($total_payment->count == 0){
                echo ' ';
              }
              elseif ($total_payment->count > 0) {
                echo '<span class="indicator badge badge-pill badge-info  d-lg-block">'.$total_payment->count.'</span>';
              }
              else{
                echo ' ';
              }?>
          </a>
        </li>
        <?php
        }
      ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="<?php echo site_url('Users/rejectClaim');?>">
            <i class="fa fa-fw fa-bell"></i>
            
              <?php if($total_reject->count == 0) {
                echo ' ';
              }
              elseif ($total_reject->count > 0) {
                echo '<span class="indicator badge badge-pill badge-info  d-lg-block">'.$total_reject->count.'</span>';
              }
              else{
                echo ' ';
              }?>
          </a>
        </li>
        
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  