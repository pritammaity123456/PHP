<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Global Variables.................................

class Users extends CI_Controller {
	

//	will be load each page-----------------------------------------
	public function __construct(){
		parent::__construct();
		$this->load->model('process');
		$this->load->model('adminProcess');
	}
	
// First load------------------------------------------------------

	public function index()	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			
			$user_id = $_POST['user_id'];
			$password = $_POST['password'];
			
			$result = $this->process->login_process($user_id);
			$temp = password_verify($password,$result->password);
			
			if($temp){
				$user_data = $this->process->get_value($user_id);
//	Set Session Value for tm_audit_trail
				$this->session->set_userdata('loggedin',$user_data);
				
				$this->process->f_audit_trail_login($user_id);

				$sl_no = $this->process->f_audit_trail_value($user_id);
				
				$this->session->set_userdata('tm_audit_sl_no',$sl_no);
				$this->process->changeUserStatus('Y');

				$this->session->set_userdata('is_login',$user_data);

				redirect('Users/welcome');
			}
			else{
				redirect('Users/login');
			}
		 }
		else{
			redirect('Users/login');
		}

	}

	public function login(){
		if($this->session->userdata('loggedin')){
    		redirect('Users/welcome');
    	}
    	else{
    		$title['title'] = 'Claim-Login';
	    	$this->load->view('templetes/header',$title);
			$this->load->view('GU/login');
    	}
	}

//	After login---------------------------------------------------

	public function welcome(){
		if($this->session->userdata('loggedin')){
    		$title['title'] = 'Claim-Welcome';
    		$t_name ='mm_employee';
    		$result['alldata'] = $this->process->getDetailsbyEmpNo($t_name);
    		$result['closing_bal'] = $this->process->closing_balance();

    		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    		$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    		$title['total_reject'] = $this->process->countRejClaim('tm_claim');
	    	$this->load->view('templetes/welcome_header',$title);
			$this->load->view('GU/welcome',$result);
			$this->load->view('templetes/welcome_footer');
    	}
    	else {
			redirect('Users/login');
    	}
	    	
	}

//For Name Change................................................
	public function editNameProcess(){
		$title['title'] = 'Claim-Welcome';
		$t_name ='mm_employee';
		$t_name1 ='m_user_master';
		$name = $this->input->get('name1');
		if ($name) {
			$msgName = $this->process->editNameProcess($name);
		}
		else{
			$msgName = false;
		}
		
		if($msgName){
			
			$result['msgName'] = 1;
			$result['msgPass'] = " ";
    		$result['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name);
    		$result['user_dtls'] = $this->process->getDetailsbyEmpNo($t_name1);
    		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    		$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    		$title['total_reject'] = $this->process->countRejClaim('tm_claim');
	    	$this->load->view('templetes/welcome_header',$title);
			$this->load->view('GU/settings',$result);
			$this->load->view('templetes/welcome_footer');
		}
		else{
			$result['msgPass'] = " ";
			$result['msgName'] = 2;
			$result['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name);
    		$result['user_dtls'] = $this->process->getDetailsbyEmpNo($t_name1);
    		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    		$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    		$title['total_reject'] = $this->process->countRejClaim('tm_claim');
	    	$this->load->view('templetes/welcome_header',$title);
			$this->load->view('GU/settings',$result);
			$this->load->view('templetes/welcome_footer');
		}
		
	}

//For Settings....................................................
	public function settings(){
		if($this->session->userdata('loggedin')){
    		$title['title'] = 'Claim-Settings';
    		$t_name ='mm_employee';
    		$t_name1 ='m_user_master';
    		$result['msgName'] = " ";
    		$result['msgPass'] = " ";
    		$result['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name);
    		$result['user_dtls'] = $this->process->getDetailsbyEmpNo($t_name1);
    		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    		$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    		$title['total_reject'] = $this->process->countRejClaim('tm_claim');
	    	$this->load->view('templetes/welcome_header',$title);
			$this->load->view('GU/settings',$result);
			$this->load->view('templetes/welcome_footer');
    	}
    	else{
			redirect('Users/login');
    	}
	    	
	}

//For Passsword Change............................................
    public function editPass(){
    	$t_name ='mm_employee';
    	$t_name1 ='m_user_master';
    	$title['title'] = 'Claim-Settings';
		$oldPass = $this->input->post('oldPass');
		$newPass = $this->input->post('newPass');
		$matchPass = $this->process->matchPass($oldPass);
		$temp = password_verify($oldPass,$matchPass->password);

		if ($temp) {

			$password = password_hash($newPass, PASSWORD_DEFAULT);
			$msgPass = $this->process->editPassProcess($password);

			if($msgPass){
				$result['msgName'] = " ";
			$result['msgPass'] = 1;
    		$result['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name);
    		$result['user_dtls'] = $this->process->getDetailsbyEmpNo($t_name1);

    		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    		$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    		$title['total_reject'] = $this->process->countRejClaim('tm_claim');
			$this->load->view('templetes/welcome_header',$title);
			$this->load->view('GU/settings',$result);
			$this->load->view('templetes/welcome_footer');
			}
			else{
				$result['msgName'] = " ";
			$result['msgPass'] = 2;
    		$result['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name);
    		$result['user_dtls'] = $this->process->getDetailsbyEmpNo($t_name1);

    		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    		$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    		$title['total_reject'] = $this->process->countRejClaim('tm_claim');
			$this->load->view('templetes/welcome_header',$title);
			$this->load->view('GU/settings',$result);
			$this->load->view('templetes/welcome_footer');
			}
		}
		else{
			$result['msgName'] = " ";
			$result['msgPass'] = 2;
    		$result['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name);
    		$result['user_dtls'] = $this->process->getDetailsbyEmpNo($t_name1);

    		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    		$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    		$title['total_reject'] = $this->process->countRejClaim('tm_claim');
			$this->load->view('templetes/welcome_header',$title);
			$this->load->view('GU/settings',$result);
			$this->load->view('templetes/welcome_footer');
			}
    }


// For Claim-----------------------------------------------------

	public function addClaim(){
		if($this->session->userdata('loggedin')){
    		$title['title'] = 'Claim-Details';
    		$t_name ='tm_claim';
    		$in = $this->uri->segment(3);
    		$result['alldata'] = $this->process->getDetailsbyEmpNo($t_name);
    		if($result){
    			if(is_numeric($in)){
    				$result['claimed'] = $in;
    			}
    			else{
    				$result['claimed'] = ' ';
    			}
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('GU/addClaim',$result);
				$this->load->view('templetes/welcome_footer');
    		}
    		else{
    			$result['claimed'] = ' ';
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('GU/addClaim');
				$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Users/login');
    	}
	}	

	public function addClaimProcess(){
		if($this->session->userdata('loggedin')){
			date_default_timezone_set('Asia/kolkata');
			$t_name ='tm_claim';
			$var = 'claim_cd';
			$maxCode = $this->process->maxCode($t_name,$var);
  			$curYr = date("Y");
  			if ($maxCode->claim_cd) {
  				$finYr = substr($maxCode->claim_cd, 0,4);
  				$prvId = substr($maxCode->claim_cd, 4,100);
  				
  				if($curYr != $finYr){
  					$claimCode = $curYr.'1';
  				}
  				else{
  					$prvId += 1;
  					$claimCode = $curYr.$prvId;
  				}
  			}
  			else{
  				$prvId += 1;
  				$claimCode = $curYr.'1';
  			} 
  				
		//$claimCode = $this->input->post('claimCode');
		$purpose = $this->input->post('purpose');
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$date1 = $date1_temp->format('Y-m-d');
		$projectName = $this->input->post('projectName');
		$projectType = $this->input->post('projectType');
		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$date2 = $date2_temp->format('Y-m-d');
		$narration = $this->input->post('narration');
		$chead = implode('*/*',$this->input->post('chead'));
		$remarks = implode('*/*',$this->input->post('remarks'));
		$amount = implode('*/*',$this->input->post('amount'));

		$array_hd = explode('*/*', $chead);
		$array_remarks = explode('*/*', $remarks);
    	$array_amount = explode('*/*', $amount);

	    	for ($i=0; $i < sizeof($array_hd); $i++) { 
	    		$sl_no = $i+1;
	    		$total_amt += $array_amount[$i];
	        	$this->process->addClaimTrans($claimCode,$sl_no,$array_hd[$i],$array_remarks[$i],$array_amount[$i]);
	         }
			
			$res = $this->process->addClaimProcess($claimCode,$purpose,$date1,$date2,$projectName,$projectType,$narration,$total_amt);
			if($res){
				$in = 1;
					redirect('Users/addClaim/'.$in);
			}else{
				redirect('Users/addClaim');
	    	}
    	}
    	else{
			redirect('Users/login');
    	}
	}

	public function editClaimProcess(){
		if($this->session->userdata('loggedin')){
	
		$claimCode = $this->input->post('claimCode');
		$purpose = $this->input->post('purpose');
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$date1 = $date1_temp->format('Y-m-d');
		$projectName = $this->input->post('projectName');
		$projectType = $this->input->post('projectType');
		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$date2 = $date2_temp->format('Y-m-d');
		$narration = $this->input->post('narration');
		$misRows = implode(',',$this->input->post('rmv_slno'));
		$chead = implode('*/*',$this->input->post('chead'));
		$remarks = implode('*/*',$this->input->post('remarks'));
		$amount = implode('*/*',$this->input->post('amount'));

		$array_sl_no = explode(',',$misRows);
		$array_hd = explode('*/*', $chead);
		$array_remarks = explode('*/*', $remarks);
    	$array_amount = explode('*/*', $amount);
    	$total_amt = 0;

    	$this->process->delClTransRow($claimCode/8191,$array_sl_no);
    	$clrow = $this->process->count_row($claimCode/8191,sizeof($array_hd));

    	if($clrow){
    		$j = 0;
    		for ($i=0; $i < $clrow; $i++) { 
	    		$sl_no = $array_sl_no[$i];
	    		$total_amt += $array_amount[$i];
	        	$this->process->editClaimTrans($claimCode/8191,$sl_no,$array_hd[$i],$array_remarks[$i],$array_amount[$i]);
	        	$j = $i;
         	}
         	
         	for ($i=0; $i < sizeof($array_hd) - $clrow; $i++) {
         		
         		$sl_no = ($this->process->maxCode('tm_claim_trans','sl_no')->sl_no)+1;
    			$total_amt += $array_amount[++$j];
        		$res = $this->process->addClaimTrans($claimCode/8191,$sl_no,$array_hd[$j],$array_remarks[$j],$array_amount[$j]);
    		}
    	}
    	else{
    		for ($i=0; $i < sizeof($array_sl_no); $i++) { 
	    		$sl_no = $array_sl_no[$i];
	    		$total_amt += $array_amount[$i];
	        	$this->process->editClaimTrans($claimCode/8191,$sl_no,$array_hd[$i],$array_remarks[$i],$array_amount[$i]);
         	}
    	}
    	
    	
		$res1 = $this->process->editClaimProcess($claimCode/8191,$purpose,$date1,$date2,$projectName,$projectType,$narration,$total_amt);
		if($res1){
				$in = 2;
				redirect('Users/addClaim/'.$in);
		}else{
			redirect('Users/addClaim');
    	}
		}
    	else{
			redirect('Users/login');
    	}
	}

	public function deleteClaimProcess(){
		if($this->session->userdata('loggedin')){
			$id = $this->input->post('del');
			$t_name = 'tm_claim';
			$this->process->deleteClaimProcess($id/8191,$t_name);
			$t_name = 'tm_claim_trans';
			$res = $this->process->deleteClaimProcess($id/8191,$t_name);
			if($res){
				$in = 3;
						redirect('Users/addClaim/'.$in);
			}else{
				redirect('Users/addClaim');
	    	}
		}
		else{
			redirect('Users/login');
    	}
	}

	public function show_claim_ajax(){
		$id = $this->input->get('id');
		$t_name = 'tm_claim';
		$t_name1 = 'tm_claim_trans';
		$data['claim'] = $this->process->getDetailsbyClaimCd($id,$t_name);
		$data['cltrans'] = $this->process->getClTransbyClaimCd($id,$t_name1);

		$this->load->view('GU/showClaimModal',$data);
	}

	public function edit_claim_ajax(){
		$id = $this->input->get('id');
		$t_name = 'tm_claim';
		$t_name2 ='mm_claim_head';
		$t_name3 = 'mm_project';
		$t_name4 = 'tm_claim_trans';
		$data['chead'] = $this->process->getAll($t_name2);
		$data['project_name'] = $this->process->getAll($t_name3);
		$data['purpose'] = $this->process->getAll('mm_purpose');
		$data['project_type'] = $this->process->getAll('mm_project_type');
		$data['claim'] = $this->process->getDetailsbyClaimCd($id,$t_name);
		$data['cltrans'] = $this->process->getClTransbyClaimCd($id,$t_name4);

		$this->load->view('GU/editClaimModal',$data);
	}

	public function print_claim_ajax(){
		$id = $this->input->get('id');
		$t_name = 'tm_claim';
		$t_name1 ='mm_employee';
		$t_name2 = 'tm_claim_trans';
    	$data['alldata'] = $this->process->getDetailsbyEmpNo($t_name1);
		$data['claim'] = $this->process->getDetailsbyClaimCd($id,$t_name);
		$data['cltrans'] = $this->process->getClTransbyClaimCd($id,$t_name2);
		$this->load->view('GU/printClaimModal',$data);
	}

	public function del_claim_ajax(){
		$id = $this->input->get('id');
		$t_name = 'tm_claim';
		$data['claim'] = $this->process->getDetailsbyClaimCd($id,$t_name);
		$this->load->view('GU/deleteClaimModal',$data);
	}

	public function add_claim_ajax(){
		$t_name ='mm_claim_head';
		$t_name2 ='mm_project';
		$t_name3 = 'mm_purpose';
		$result['project_name'] = $this->process->getAll($t_name2);
		$result['purpose'] = $this->process->getAll($t_name3);
		$result['project_type'] = $this->process->getAll('mm_project_type');
		$result['chead'] = $this->process->getAll($t_name);
		$this->load->view('GU/addClaimModal',$result);
	}


// For Reject Claim................................................

	public function rejectClaim(){
		if($this->session->userdata('loggedin')->user_type) {
    		$title['title'] = 'Claim-Rejected';
    		$t_name ='tm_claim';
    		$result['alldata'] = $this->process->getRejectClaim();

    		if($result){
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');

    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('GU/rejectClaim',$result);
				$this->load->view('templetes/welcome_footer');
    		}
    		else{

    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('GU/rejectClaim');
				$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Users/login');
    	}
	}

	public function reject_claim_ajax(){
		$id = $this->input->get('id');
		$t_name = 'tm_claim';
		$t_name2 ='mm_claim_head';
		$t_name3 = 'mm_project';
		$t_name4 = 'tm_claim_trans';
		$data['alldata'] = $this->process->getDetailsbyEmpNo('mm_employee');
		$data['chead'] = $this->process->getAll($t_name2);
		$data['project_name'] = $this->process->getAll($t_name3);
		$data['purpose'] = $this->process->getAll('mm_purpose');
		$data['project_type'] = $this->process->getAll('mm_project_type');
		$data['claim'] = $this->process->getDetailsbyClaimCd($id,$t_name);
		$data['cltrans'] = $this->process->getClTransbyClaimCd($id,$t_name4);

		$this->load->view('GU/rejectClaimModal',$data);
	}

// For Report......................................................


	// Claim Details-----------------------------------------------

	public function claimDetails(){
		if($this->session->userdata('loggedin')){

		$title['title'] = 'Claim-Details';
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);

		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);

		$to_date = $date2_temp->format('Y-m-d');
		$data['alldata'] = $this->process->reportProcess($from_date,$to_date);
		$t_name3 = 'mm_employee';
		$data['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name3);
		$data['date'] = $this->process->get_dt();
		
		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('GU/claimDetails',$data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Users/login');
		}
	}	

	public function claim_dtl_ajax(){
    	
		$this->load->view('GU/claimDtlModal');
    }

    public function ind_claim_dtl_ajax(){
    	
		$id = $this->input->get('id');
		$t_name = 'tm_claim';
		$t_name1 = 'tm_claim_trans';
		$t_name3 = 'mm_employee';
		$data['claim'] = $this->process->getDetailsbyClaimCd($id,$t_name);
		$data['cltrans'] = $this->process->getClTransbyClaimCd($id,$t_name1);
		$data['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name3);
		$data['date'] = $this->process->get_dt();
		$this->load->view('indClaimDetailsModal',$data);
    }

    // Ledger Details-----------------------------------------------

	public function ledgerDetails(){
		if($this->session->userdata('loggedin')){

		$title['title'] = 'Claim-Personal Ledger';
		$t_name = 'mm_employee';
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);

		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);

		$to_date = $date2_temp->format('Y-m-d');
		$data['alldata'] = $this->process->personalLedger($from_date,$to_date);
		$data['opening_balance'] = $this->process->opening_balance($from_date);
		$data['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name);
		$data['date'] = $this->process->get_dt();

		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('GU/ledgerDetails',$data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Users/login');
		}
	}

    	
    public function ledger_dtl_ajax(){
    	
		$this->load->view('GU/ledgerDtlModal');
    }

    // For Payment Details.....................................................

	public function paymentDetails(){
		if($this->session->userdata('loggedin')){

		$title['title'] = 'Claim-Personal Ledger';
		$t_name = 'mm_employee';
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$to_date = $date2_temp->format('Y-m-d');

		$data['alldata'] = $this->process->paymentDetails($from_date,$to_date,'tm_payment');
		$data['emp_dtls'] = $this->process->getDetailsbyEmpNo($t_name);
		$data['date'] = $this->process->get_dt();

		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('GU/paymentDetails',$data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Users/login');
		}
	}

    	
    public function payment_dtl_ajax(){
    	
		$this->load->view('GU/paymentDtlModal');
    }
    

// will Check valid userid and password

	public function logout(){  
    	if($this->session->userdata('loggedin')){
    		$this->process->f_audit_trail_logout(); 
    		$this->process->changeUserStatus('N');
    		$this->session->unset_userdata('is_login');
	    	$this->session->unset_userdata('loggedin');
	    	$this->session->unset_userdata('tm_audit_sl_no');
	        
	        redirect('Users/login');
    	}
    	else{
    		redirect('Users/login');
    	}
    }
}
