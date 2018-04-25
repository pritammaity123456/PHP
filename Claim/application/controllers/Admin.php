<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

//	will be load each page-----------

	public function __construct(){
		parent::__construct();
		$this->load->model('adminProcess');
		$this->load->model('process');
		$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	}



// First load.......................................................

	public function index()	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			
			$user_id = $_POST['user_id'];
			$password = $_POST['password'];
			
			$result = $this->adminProcess->login_process($user_id);
			$temp = password_verify($password,$result->password);
			
			if($temp){
				$_SESSION['LAST_ACTIVITY'] = time();
				$user_data = $this->adminProcess->get_value($user_id);
//	Set Session Value for tm_audit_trail
				$this->session->set_userdata('is_login',$user_data);
				$this->adminProcess->f_audit_trail_login($user_id);

				$sl_no = $this->adminProcess->f_audit_trail_value($user_id);
				
				$this->session->set_userdata('tm_audit_sl_no',$sl_no);
				$this->adminProcess->changeAdmintatus('Y');
				redirect('Admin/welcome');
				//$this->welcome();
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
		if($this->session->userdata('is_login')){
    		redirect('Users/welcome');
    	}
    	else{
    		$title['title'] = 'Claim-Login';
	    	$this->load->view('templetes/header',$title);
			$this->load->view('login');
    	}
	}



//After login.................................................

	public function welcome(){
		if($this->session->userdata('is_login')){
			if($this->session->userdata('is_login')->user_type == 'A'){
    			$title['title'] = 'Claim-Welcome';
    		$t_name ='mm_employee';
    		$emp_no = $this->session->userdata('is_login')->emp_no;
    		$result['alldata'] = $this->adminProcess->getDetailsbyEmpNo($t_name,$emp_no);
    		$result['closing_bal'] = $this->adminProcess->closing_balance();
    		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    		$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    		//var_dump($result['total_claim']);die();
	    	$this->load->view('templetes/welcome_header',$title);
			$this->load->view('welcome',$result);
			$this->load->view('templetes/welcome_footer');
    		}
    		else{
			redirect('Users/login');
    		}
		}
		else{
			redirect('Users/login');
		}
	}	

//For Name....................................................
	public function editNameProcess(){
		$title['title'] = 'Claim-Settings';
		$t_name ='mm_employee';
		$t_name1 ='m_user_master';
		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
		$name = $this->input->get('name1');
		if ($name) {
			$msgName = $this->adminProcess->editNameProcess($name);
		}
		else{
			$msgName = false;
		}
		if($msgName){
			
			$result['msgName'] = 1;
			$result['msgPass'] = " ";
    		$result['emp_dtls'] = $this->adminProcess->getDetailsbyEmpNo($t_name,$this->session->userdata('is_login')->emp_no);
    		$result['user_dtls'] = $this->adminProcess->getDetailsbyEmpNo($t_name1,$this->session->userdata('is_login')->emp_no);
	    	$this->load->view('templetes/welcome_header',$title);
			$this->load->view('settings',$result);
			$this->load->view('templetes/welcome_footer');
		}
		else{
			$result['msgPass'] = " ";
			$result['msgName'] = 2;
			$result['emp_dtls'] = $this->adminProcess->getDetailsbyEmpNo($t_name,$this->session->userdata('is_login')->emp_no);
    		$result['user_dtls'] = $this->adminProcess->getDetailsbyEmpNo($t_name1,$this->session->userdata('is_login')->emp_no);
	    	$this->load->view('templetes/welcome_header',$title);
			$this->load->view('settings',$result);
			$this->load->view('templetes/welcome_footer');
		}
		
	}


// For Claim.................................................
	public function approveClaim(){
		if(($this->session->userdata('is_login')->user_type == 'A') || ($this->session->userdata('is_login')->user_type == 'M') || ($this->session->userdata('is_login')->user_type == 'AC')){
    		$title['title'] = 'Claim-Approve';
    		$t_name ='tm_claim';
    		$in = $this->uri->segment(3);
    		$result['alldata'] = $this->adminProcess->getAllClaim();

    		if($result){
    			if(is_numeric($in)){
    				$result['aprvd'] = $in;
    			}
    			else{
    				$result['aprvd'] = ' ';
    			}
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/approveClaim',$result);
				$this->load->view('templetes/welcome_footer');
    		}
    		else{
    			$result['aprvd'] = ' ';
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/approveClaim');
				$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Users/login');
    	}
	}


	public function editApproveClaimProcess(){
		if($this->session->userdata('is_login')->user_type == 'A' || $this->session->userdata('is_login')->user_type == 'M' || $this->session->userdata('is_login')->user_type == 'AC'){
	
		$claimCode = $this->input->post('claimCode');
		$approval_status = $this->input->post('approval_status');
		$rejection_status = $this->input->post('rejection_status');
		$rejection_remarks = $this->input->post('rejection_remarks');

		if($approval_status){
			$res = $this->adminProcess->approveClaimProcess($claimCode/8191,$approval_status);
		}
		else{
			$res = $this->adminProcess->rejectClaimProcess($claimCode/8191,$rejection_status,$rejection_remarks);
		}
		
		if($res){
			$in = $res;
				redirect('Admin/approveClaim/'.$in);
		}else{
			redirect('Admin/approveClaim');
    	}
		}
    	else{
			redirect('Admin/login');
    	}
	}

	public function edit_claim_ajax(){
		$id = $this->input->get('id');
		$t_name = 'tm_claim';
		$t_name1 = 'tm_claim_trans';
		$t_name2 ='mm_employee';
		$data['claim'] = $this->adminProcess->getDetailsbyClaimCd($id,$t_name);
		$data['alldata'] = $this->adminProcess->getEmp($t_name2,$id);
		$data['cltrans'] = $this->adminProcess->getClTransbyClaimCd($id,$t_name1);

		$this->load->view('SU/editClaimModal',$data);
	}


// For Adding Project type..............................................

	public function addProjectType(){
		if($this->session->userdata('is_login')->user_type == 'A'){
    		$title['title'] = 'Claim-Project Type';
    		$in = $this->uri->segment(3);
    		$t_name ='mm_project_type';
    		$result['alldata'] = $this->adminProcess->getAll($t_name);
    		$result['proType'] = ' ';
    		if($result){
    			if(is_numeric($in)){
    				$result['proType'] = $in;
    			}
    			else{
    				$result['proType'] = ' ';
    			}
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addProjectType',$result);
				$this->load->view('templetes/welcome_footer');
    		}
    		else{
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addProjectType');
				$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Admin/login');
    	}
	    	
	}

	public function insertProjectType(){
		if($this->session->userdata('is_login')->user_type == 'A'){
			$title['title'] = 'Claim-Project Type';
    		$type_cd = $this->input->post('type_cd');
			$type_desc = $this->input->post('type_desc');
			
			$res = $this->adminProcess->addProjectTypeProcess($type_cd,$type_desc);
			if($res){
				$in = 1;
				redirect('Admin/addProjectType/'.$in);
			}
			else{
			redirect('Admin/login');
    	}
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function editProjectTypeProcess(){
		if($this->session->userdata('is_login')->user_type == 'A'){
			$title['title'] = 'Claim-Project Type';
			$id = $this->input->post('id');
    		$type_cd = $this->input->post('type_cd');
			$type_desc = $this->input->post('type_desc');
			
			$res = $this->adminProcess->editProjectTypeProcess($id,$type_cd,$type_desc);
			if($res){
				$in = 2;
				redirect('Admin/addProjectType/'.$in);
			}
			else{
			redirect('Admin/addProjectType');
    	}
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function edit_project_type_ajax(){
		$id = $this->input->get('id');
		$t_name = 'mm_project_type';
		$data['project'] = $this->adminProcess->getDetailsbyId($id,$t_name);
		$this->load->view('SU/editProjectTypeModal',$data);
	}
	public function add_project_type_ajax(){
		$this->load->view('SU/addProjectTypeModal');
	}




// For Adding Project Names...............................

	public function addProjects(){
		if($this->session->userdata('is_login')->user_type == 'A'){
    		$title['title'] = 'Claim-Projects';
    		$in = $this->uri->segment(3);
    		$t_name ='mm_project';
    		$result['project'] = ' ';
    		$result['alldata'] = $this->adminProcess->getAll($t_name);
    		if($result){
    			if(is_numeric($in)){
    				$result['project'] = $in;
    			}
    			else{
    				$result['project'] = ' ';
    			}
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addProjects',$result);
				$this->load->view('templetes/welcome_footer');
    		}
    		else{
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addProjects');
				$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Admin/login');
    	}
	    	
	}

	public function addProjectProcess(){
		if($this->session->userdata('is_login')->user_type == 'A'){
    		$project_cd = $this->input->post('project_cd');
			$project_name = $this->input->post('project_name');
			$project_type = $this->input->post('project_type');
			$district = $this->input->post('district');
			$res = $this->adminProcess->addProjectProcess($project_cd,$project_name,$project_type,$district);
			if ($res) {
				$in = 1;
				redirect('Admin/addProjects/'.$in);
			}
			else{
				redirect('Admin/addProjects');
			}
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function editProjectProcess(){
		if($this->session->userdata('is_login')->user_type == 'A'){
			$id = $this->input->post('id');
    		$project_cd = $this->input->post('project_cd');
			$project_name = $this->input->post('project_name');
			$project_type = $this->input->post('project_type');
			$district = $this->input->post('district');
			$res = $this->adminProcess->editProjectProcess($id,$project_cd,$project_name,$project_type,$district);
			if ($res) {
				$in = 2;
				redirect('Admin/addProjects/'.$in);
			}
			else{
				redirect('Admin/addProjects');
			}
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function edit_project_ajax(){
		$id = $this->input->get('id');
		$t_name = 'mm_project';
		$data['alldata'] = $this->adminProcess->getAll('mm_project_type');
		$data['project'] = $this->adminProcess->getDetailsbyId($id,$t_name);
		$this->load->view('SU/editProjectModal',$data);
	}
	public function add_project_ajax(){
		$result['alldata'] = $this->adminProcess->getAll('mm_project_type');
		$this->load->view('SU/addProjectModal',$result);
	}

//For Purpose..........................................

	public function addPurpose(){
		if($this->session->userdata('is_login')->user_type == 'A'){
    		$title['title'] = 'Claim-Purpose';
    		$in = $this->uri->segment(3);  
    		$t_name ='mm_purpose';
    		$result['purpose'] = ' ';
    		$result['alldata'] = $this->adminProcess->getAll($t_name);
    		if($result){
    			if(is_numeric($in)){
    				$result['purpose'] = $in;
    			}
    			else{
    				$result['purpose'] = ' ';
    			}
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addPurpose',$result);
				$this->load->view('templetes/welcome_footer');
    		}
    		else{
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addPurpose');
				$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function addPurposeProcess(){
		if($this->session->userdata('is_login')->user_type == 'A'){
			$title['title'] = 'Claim-Purpose';
    		$purpose_id = $this->input->post('purpose_id');
			$purpose_desc = $this->input->post('purpose_desc');
			$res = $this->adminProcess->addPurposeProcess($purpose_id,$purpose_desc);
			if ($res) {
				$in = 1;
				redirect('Admin/addPurpose/'.$in);
			}
			else{
				redirect('Admin/addPurpose');
			}
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function editPurposeProcess(){
		if($this->session->userdata('is_login')->user_type == 'A'){
			$title['title'] = 'Claim-Purpose';
    		$purpose_id = $this->input->post('purpose_id');
			$purpose_desc = $this->input->post('purpose_desc');
			$res = $this->adminProcess->editPurposeProcess($purpose_id,$purpose_desc);
			if ($res) {
				$in = 2;
				redirect('Admin/addPurpose/'.$in);
			}
			else{
				redirect('Admin/addPurpose');
			}
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function edit_purpose_ajax(){
		$id = $this->input->get('id');
		$t_name = 'mm_purpose';
		$data['purpose'] = $this->adminProcess->getDetailsbyId($id,$t_name);
		$this->load->view('SU/editPurposeModal',$data);
	}
	public function add_purpose_ajax(){

		$this->load->view('SU/addPurposeModal');
	}

//For Claim Head..........................................

	public function addClaimHead(){
		if($this->session->userdata('is_login')->user_type == 'A'){
    		$title['title'] = 'Claim-Add Claim Head';
    		$t_name ='mm_claim_head';
    		$in = $this->uri->segment(3);
    		$result['alldata'] = $this->adminProcess->getAll($t_name);
    		if($result){
    			if(is_numeric($in)){
    				$result['cl_hd'] = $in;
    			}
    			else{
    				$result['cl_hd'] = ' ';
    			}
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addClaimHead',$result);
				$this->load->view('templetes/welcome_footer');
    		}
    		else{
    			$result['cl_hd'] = ' ';
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addClaimHead');
				$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function addClaimHeadProcess(){
		if($this->session->userdata('is_login')->user_type == 'A'){
			$title['title'] = 'Claim-Add Claim Head';
    		$head_cd = $this->input->post('head_cd');
			$head_desc = $this->input->post('head_desc');
			$res = $this->adminProcess->addClaimHeadProcess($head_cd,$head_desc);
			if ($res) {
				$in = 1;
    			redirect('Admin/addClaimHead/'.$in);
			}
			else{
				redirect('Admin/addClaimHead');
			}
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function editClaimHeadProcess(){
		if($this->session->userdata('is_login')->user_type == 'A'){
			$title['title'] = 'Claim-Add Claim Head';
    		$head_cd = $this->input->post('head_cd');
			$head_desc = $this->input->post('head_desc');
			$res = $this->adminProcess->editClaimHeadProcess($head_cd,$head_desc);
			if ($res) {
				$in = 2;
    			redirect('Admin/addClaimHead/'.$in);
			}
			else{
				redirect('Admin/addPurpose');
			}
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function edit_claim_head_ajax(){
		$id = $this->input->get('id');
		$t_name = 'mm_claim_head';
		$data['claim_head'] = $this->adminProcess->getDetailsbyId($id,$t_name);
		$this->load->view('SU/editClaimHeadModal',$data);
	}
	public function add_claim_head_ajax(){
		$this->load->view('SU/addClaimHeadModal');
	}


// For Employees.......................................
	
	public function addEmployee(){
		if($this->session->userdata('is_login')->user_type == 'A'){
    		$title['title'] = 'Claim-Employee Details';
    		$in = $this->uri->segment(3);
    		$t_name ='mm_employee';
    		$result['alldata'] = $this->adminProcess->getAll($t_name);
    		$result['empExists'] = ' ';
    		if($result){
    			if(is_numeric($in)){
    				$result['empExists'] = $in;
    			}
    			else{
    				$result['empExists'] = ' ';
    			}
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addEmployee',$result);
				$this->load->view('templetes/welcome_footer');
    		}
    		else{
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
				$this->load->view('SU/addEmployee');
				$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Admin/login');
    	}
	    	
	}
	
	public function addEmployeeProcess(){
			$emp_no = $_POST['emp_no'];
			$emp_name = $_POST['emp_name'];
			$status = $_POST['status'];
			$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
			$date1 = $date1_temp->format('Y-m-d');
			if("" == trim($_POST['date2'])){
				$date2='';
			}
			else{
				$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
				$date2 = $date2_temp->format('Y-m-d');
			}
			$sector = $_POST['sector'];
			$designation = $_POST['designation'];

			$res = $this->adminProcess->getDetailsbyEmpNo('mm_employee',$emp_no);
			if($res){
				$in = 2;
    			redirect('Admin/addEmployee/'.$in);
			}
			else{
				$res = $this->adminProcess->addEmpProcess($emp_no,$emp_name,$status,$date1,$date2,$sector,$designation);
				if($res){
					$in = 1;
    			redirect('Admin/addEmployee/'.$in);
				}
				else{
					redirect('Admin/addEmployee');
				}
			}
	}

	
	public function editEmployeeProcess(){
		$emp_no = $this->input->post('empid');
		$emp_name = $this->input->post('empName');
		$status = $this->input->post('status');
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$date1 = $date1_temp->format('Y-m-d');
		if("" == trim($_POST['date2'])){
				$date2='';
			}
			else{
				$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
				$date2 = $date2_temp->format('Y-m-d');
			}
		
		$sector = $this->input->post('sector');
		$designation = $this->input->post('designation');
		$data = $this->adminProcess->editEmployeeProcess($emp_no,$emp_name,$status,$date1,$date2,$sector,$designation);
		if($data){
			$in = 3;
    			redirect('Admin/addEmployee/'.$in);
		}
		else{
			redirect('Admin/addEmployee');
		}
	}

	public function edit_employee_ajax(){
		$id = $this->input->get('id');
		$t_name ='mm_employee';
		$data['employee'] = $this->adminProcess->getDetailsbyEmpNo($t_name,$id);
		$this->load->view('SU/edit_employee_modal',$data);
	}

	public function add_employee_ajax(){
		
		$this->load->view('SU/addEmployeeModal');
	}

//For User Maintenance.......................................

	public function userMaintenance(){
		if($this->session->userdata('is_login')->user_type == 'A'){
			$t_name ='tm_payment';
			$in = $this->uri->segment(3);
			if(is_numeric($in)){
    				$result['m_user'] = $in;
    			}
    			else{
    				$result['m_user'] = ' ';
    			}
			$title['title'] = 'Claim-User Maintenance';
			$result['alldata'] = $this->adminProcess->getAll('m_user_master');

			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
	    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
	    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
			$this->load->view('templetes/welcome_header',$title);
			$this->load->view('SU/userMaintenance',$result);
			$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Admin/login');
		}
	}

	public function edit_user_ajax(){
		$id = $this->input->get('id');
		
		$data['user'] = $this->adminProcess->getDetailsbyEmpNo('m_user_master',$id);
		$data['emp_dtls'] = $this->adminProcess->getAll('mm_employee');
		$data['data'] = $this->adminProcess->getDetailsbyEmpNo('mm_manager',$id);
		$this->load->view('SU/editUserModal',$data);
	}

	public function add_user_ajax(){
		$result['emp_dtls'] = $this->adminProcess->getAll('mm_employee');
		$this->load->view('SU/addUserModal',$result);
	}


	public function addUserProcess(){
		$emp_no = $this->input->post('emp_no');
		$user_type = $this->input->post('user_type');
		$user_id = $this->input->post('user_id');
		$pass = $this->input->post('pass');
		$password = password_hash($pass, PASSWORD_DEFAULT);
		$status = $this->input->post('status');
		$res = $this->adminProcess->getDetailsbyEmpNo('mm_employee',$emp_no);

		$empno = implode('#',$this->input->post('empno'));
		$eno = explode('#', $empno);


		if(!$res){
			$in = 3;
			redirect('Admin/userMaintenance/'.$in);
		}else{
			$res = $this->adminProcess->getDetailsbyEmpNo('m_user_master',$emp_no);
			if(!$res){
				if ($user_type != 'E') {
					for ($i=0; $i < sizeof($eno); $i++) 
					$this->adminProcess->addManager($emp_no,$eno[$i]);
				}
				
				$res = $this->adminProcess->addUserProcess($emp_no,$user_type,$f_name,$m_name,$l_name,$user_id,$password,$status);
				if($res){
					$in = 1;
		    			redirect('Admin/userMaintenance/'.$in);
				}
				else{
					redirect('Admin/userMaintenance');
				}
			}
			else{
				$in = 4;
				redirect('Admin/userMaintenance/'.$in);
			}
			
		}
		
	}

	public function editUserProcess(){
		$emp_no = $this->input->post('emp_no');
		$user_type = $this->input->post('user_type');
		$user_id = $this->input->post('user_id');
		$status = $this->input->post('status');
		//$misRows = implode(',',$this->input->post('rmv_slno'));
		$empno = implode('#',$this->input->post('empno'));

		//$array_sl_no = explode(',',$misRows);
		$eno = explode('#', $empno);

		$this->adminProcess->delRow($emp_no);

		if ($status == 'E') {
			$res = $this->adminProcess->editUserProcess($emp_no,$user_type,$user_id,$status);
		}else{
			for ($i=0; $i < sizeof($eno); $i++) {
				$this->adminProcess->addManager($emp_no,$eno[$i]);
			}
			$res = $this->adminProcess->editUserProcess($emp_no,$user_type,$user_id,$status);
		}
		
		if($res){
			$in = 2;
    			redirect('Admin/userMaintenance/'.$in);
		}
		else{
			redirect('Admin/userMaintenance');
		}
	}

// For Payments..............................................

	public function payment(){
		if($this->session->userdata('is_login')->user_type == 'AC'){
    		$title['title'] = 'Claim-Payment';
    		$t_name ='tm_payment';
    		$in = $this->uri->segment(3);
    		$result['alldata'] = $this->adminProcess->getAll($t_name);
    		if ($result) {
    			if(is_numeric($in)){
    				$result['pay'] = $in;
    			}
    			else{
    				$result['pay'] = ' ';
    			}
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
			$this->load->view('SU/payment',$result);
			$this->load->view('templetes/welcome_footer');
    		}
    		else{
    			$result['pay'] = ' ';
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
			$this->load->view('SU/payment');
			$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function addPaymentProcess(){
		if($this->session->userdata('is_login')->user_type == 'AC'){
			date_default_timezone_set('Asia/kolkata');
			$t_name ='tm_payment';
			$prvId = 0;
			$maxCode = $this->adminProcess->maxCode($t_name,'trans_cd');
  			$curYr = date("Y");
  			if ($maxCode->trans_cd) {
  				$finYr = substr($maxCode->trans_cd, 0,4);
  				$prvId = substr($maxCode->trans_cd, 4,100);
  				
  				if($curYr != $finYr){
  					$trans_cd = $curYr.'1';
  				}
  				else{
  					$prvId += 1;
  					$trans_cd = $curYr.$prvId;
  				}
  			}
  			else{
  				$prvId += 1;
  				$trans_cd = $curYr.'1';
  			}
			

		$emp_no = $this->input->post('emp_no');
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		if ($date1_temp) {
			$chq_dt = $date1_temp->format('Y-m-d');
		}else{
			$chq_dt = null;
		}
		
		$pay_mode = $this->input->post('pay_mode');
		$pay_type = $this->input->post('pay_type');
		$chq_no = $this->input->post('chq_no');
		if (!$chq_no) {
			$chq_no = null;
		}
		$bank = $this->input->post('bank');
		$amount = $this->input->post('amount');
		
		$res = $this->adminProcess->addPaymentProcess($trans_cd,$emp_no,$chq_dt,$pay_mode,$pay_type,$chq_no,$bank,$amount);
		if($res){
				$in = 1;
						redirect('Admin/payment/'.$in);
			}else{
				redirect('Admin/payment');
	    	}
		}
    	else{
			redirect('Admin/login');
    	}
	}

	public function editPaymentProcess(){
		if($this->session->userdata('is_login')->user_type == 'AC'){
	
			$trans_cd = $this->input->post('trans_cd');
			$emp_no = $this->input->post('emp_no');
			$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		
			if ($date1_temp) {
				$chq_dt = $date1_temp->format('Y-m-d');
			}else{
				$chq_dt = null;
			}
			$pay_mode = $this->input->post('pay_mode');
			$pay_type = $this->input->post('pay_type');
			$chq_no = $this->input->post('chq_no');

			if (!$chq_no) {
				$chq_no = null;
			}
			$bank = $this->input->post('bank');
			$amount = $this->input->post('amount');

			$res = $this->adminProcess->editPaymentProcess($trans_cd/8191,$emp_no,$chq_dt,$pay_mode,$pay_type,$chq_no,$bank,$amount);
			if($res){
				$in = 2;
				redirect('Admin/payment/'.$in);
			}else{
				redirect('Admin/payment');
    		}
		}
    	else{
			redirect('Admin/login');
    	}
	}

	public function add_payment_ajax(){
		$result['emp_dtls'] = $this->adminProcess->getAll('mm_employee');
		$this->load->view('SU/addPaymentModal',$result);
	}

	public function edit_payment_ajax(){
		$id = $this->input->get('id');
		$t_name ='tm_payment';
		$data['emp_dtls'] = $this->adminProcess->getAll('mm_employee');
		$data['payment'] = $this->adminProcess->getDetailsbyTransCd($id,$t_name);
		$this->load->view('SU/editPaymentModal',$data);
	}

// For Approval Payments..........................................

	public function approvePayment(){
		if($this->session->userdata('is_login')->user_type == 'AC'){
    		$title['title'] = 'Claim-Payment-Approval';
    		$t_name ='tm_payment';
    		$in = $this->uri->segment(3);
    		$result['alldata'] = $this->adminProcess->getAll($t_name);
    		if ($result) {
    			if(is_numeric($in)){
    				$result['paid'] = $in;
    			}
    			else{
    				$result['paid'] = ' ';
    			}
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
			$this->load->view('SU/approvePayment',$result);
			$this->load->view('templetes/welcome_footer');
    		}
    		else{
    			$result['paid'] = ' ';
    			$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    			$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    			$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    			$this->load->view('templetes/welcome_header',$title);
			$this->load->view('SU/approvePayment');
			$this->load->view('templetes/welcome_footer');
    		}
	    	
    	}
    	else{
			redirect('Admin/login');
    	}
	}

	public function	approvePaymentProcess(){
		if($this->session->userdata('is_login')->user_type == 'AC'){
			$trans_cd = $this->input->post('trans_cd');
			$status = $this->input->post('check');
			$res = $this->adminProcess->approvePaymentProcess($trans_cd/8191,$status);
			if($res){
				$in = 1;
				redirect('Admin/approvePayment/'.$in);
			}else{
				redirect('Admin/approvePayment');
    		}
		}
		else{
			redirect('Admin/login');
		}
	}

	public function approve_payment_ajax(){
		$trans_cd = $this->input->get('id');
		$t_name ='tm_payment';
		$data['emp_dtls'] = $this->adminProcess->getAll('mm_employee');
		$data['payment'] = $this->adminProcess->getDetailsbyTransCd($trans_cd,$t_name);
		$this->load->view('SU/approvePaymentModal',$data);

	}


//For Reports.......................................................

	public function projectWiseExpence(){
		if($this->session->userdata('is_login')->user_type == 'A' || $this->session->userdata('is_login')->user_type == 'M' || $this->session->userdata('is_login')->user_type == 'AC'){

		$title['title'] = 'Claim-Project Wise Expence';
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$to_date = $date2_temp->format('Y-m-d');

		$project_name = $this->input->post('projectName');

		$data['alldata'] = $this->adminProcess->reportProcess($from_date,$to_date);
		$data['date'] = $this->adminProcess->get_dt();
		
		$data['pwExpence'] = $this->adminProcess->pwExpence($project_name,$from_date,$to_date);
    	
		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
    	
		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('SU/projectWiseExpence',$data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Admin/login');
		}
	}	

	public function pwe_dtl_ajax(){
    	$t_name ='mm_project';
		$result['project_name'] = $this->adminProcess->getAll($t_name);
		$this->load->view('SU/pweModal',$result);
    }

//Purpose Wise Expence........................................................

    public function purposeWiseExpence(){
		if($this->session->userdata('is_login')->user_type == 'A' || $this->session->userdata('is_login')->user_type == 'M' || $this->session->userdata('is_login')->user_type == 'AC'){

		$title['title'] = 'Claim-Purpose Wise Expence';
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$to_date = $date2_temp->format('Y-m-d');

		$data['date'] = $this->adminProcess->get_dt();
		
		$data['prwExpence'] = $this->adminProcess->prwExpence($from_date,$to_date);
		$data['row'] = $this->adminProcess->countPRWE($from_date,$to_date);

		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('SU/purposeWiseExpence',$data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Admin/login');
		}
	}	

	public function prwe_dtl_ajax(){
		$this->load->view('SU/prpsWEModal');
    }

//For Payment Details.........................................................

	public function paymentDetails(){
		if($this->session->userdata('is_login')->user_type == 'A' || $this->session->userdata('is_login')->user_type == 'M' || $this->session->userdata('is_login')->user_type == 'AC'){

		$title['title'] = 'Claim-Personal Ledger';
		$t_name = 'mm_employee';
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$to_date = $date2_temp->format('Y-m-d');
		$emp_no = $this->input->post('emp_no');

		$data['alldata'] = $this->adminProcess->paymentDetails($from_date,$to_date,$emp_no);
		$data['emp_dtls'] = $this->adminProcess->getDetailsbyEmpNo($t_name,$emp_no);
		$data['date'] = $this->adminProcess->get_dt();
		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');

		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('SU/paymentDetails',$data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Admin/login');
		}
	}

    	
    public function payment_dtl_ajax(){
    	$result['dtls'] = $this->adminProcess->getEmpForManager();
		$this->load->view('SU/paymentDtlModal',$result);
    }

//For Claim Details............................................................

	public function claimDetails(){
		if($this->session->userdata('is_login')->user_type == 'A' || $this->session->userdata('is_login')->user_type == 'M' || $this->session->userdata('is_login')->user_type == 'AC'){

		$title['title'] = 'Claim-Details';
		$t_name = 'mm_employee';
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$to_date = $date2_temp->format('Y-m-d');

		$emp_no = $this->input->post('emp_no');
		
		$this->session->set_userdata('enoFrCdtl',$emp_no);
		$data['alldata'] = $this->adminProcess->claimDetails($from_date,$to_date,$emp_no);
		
		$data['emp_dtls'] = $this->adminProcess->getDetailsbyEmpNo($t_name,$emp_no);
		$data['date'] = $this->adminProcess->get_dt();
		
		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('SU/claimAdminDetails',$data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Admin/login');
		}
	}

	public function claim_dtl_ajax(){
    	$result['dtls'] = $this->adminProcess->getEmpForManager();
		$this->load->view('SU/claimAdminDtlModal',$result);
    }

//For Closing Balance.............................................Report

	public function closing_balance(){
		if($this->session->userdata('is_login')->user_type == 'A' || $this->session->userdata('is_login')->user_type == 'M' || $this->session->userdata('is_login')->user_type == 'AC'){

		$title['title'] = 'Claim-Closing Balance';
		$t_name = 'mm_employee';
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$to_date = $date2_temp->format('Y-m-d');

		$emp_no = $this->input->post('emp_no');
		
		$this->session->set_userdata('enoFrCdtl',$emp_no);
		$data['alldata'] = $this->adminProcess->closingBalance($from_date,$to_date);
		
		$data['emp_dtls'] = $this->adminProcess->getAll($t_name);
		$data['date'] = $this->adminProcess->get_dt();
		
		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('SU/closingBalance',$data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Admin/login');
		}
	}

	public function closing_balance_ajax(){
    	
		$this->load->view('SU/closingBalanceModal');
    }

 //For Individual claim Details...........................................       

    public function ind_claim_dtl_ajax(){
    	
		$id = $this->input->get('id');
		$emp_no = $this->session->userdata('enoFrCdtl');
		$t_name = 'tm_claim';
		$t_name1 = 'tm_claim_trans';
		$t_name2 = 'mm_employee';
		$data['claim'] = $this->adminProcess->getDetailsbyClaimCd($id,$t_name);
		$data['cltrans'] = $this->adminProcess->getClTransbyClaimCd($id,$t_name1);
		$data['emp_dtls'] = $this->adminProcess->getDetailsbyEmpNo($t_name2,$emp_no);
		$this->load->view('SU/indClaimDetailsModal',$data);
	}

  //For Employee Balance.........................

	public function empBalance(){
		$title['title'] = 'Claim-Employee Balance';

		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$from_date = $date1_temp->format('Y-m-d');

		$result['emp_dtls'] = $this->adminProcess->getAll('mm_employee');
		$result['empBalance'] = $this->adminProcess->empBalance($from_date);
		
		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('SU/empBalance',$result);
		$this->load->view('templetes/welcome_footer');
	}

	public function emp_balance_ajax(){	
		$this->load->view('SU/empBalanceModal');
	}	


//For Total Claim Details............................................
	public function totalClaimDetails(){
		if($this->session->userdata('is_login')->user_type == 'A' || $this->session->userdata('is_login')->user_type == 'M' || $this->session->userdata('is_login')->user_type == 'AC'){

		$title['title'] = 'Claim-All Details';
		$t_name = 'mm_employee';
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$to_date = $date2_temp->format('Y-m-d');

		$emp_no = $this->input->post('emp_no');
		
		$this->session->set_userdata('enoFrCdtl',$emp_no);
		$data['alldata'] = $this->adminProcess->totalClaimDetails($from_date,$to_date);
		
		$data['date'] = $this->adminProcess->get_dt();
		
		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
		$this->load->view('templetes/welcome_header',$title);
		$this->load->view('SU/totalClaimDetails',$data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Admin/login');
		}
	}

	public function total_claim_dtl_ajax() {
		$this->load->view('SU/totalClaimDtlModal');
	}

	public function distWiseExp_ajax() {
		$this->load->view('SU/distWiseExpModal');
	}

	public function distWiseExpence(){
		if($this->session->userdata('is_login')->user_type == 'A' || $this->session->userdata('is_login')->user_type == 'M' || $this->session->userdata('is_login')->user_type == 'AC'){

		$title['title'] = 'Claim-District Wise Exp';
		
		$date1_temp = DateTime::createFromFormat('d/m/Y',$_POST['date1']);
		$from_date = $date1_temp->format('Y-m-d');

		$date2_temp = DateTime::createFromFormat('d/m/Y',$_POST['date2']);
		$to_date = $date2_temp->format('Y-m-d');

		$emp_no = $this->input->post('emp_no');
		
		$this->session->set_userdata('enoFrCdtl',$emp_no);
		$data['alldata'] = $this->adminProcess->distWiseExpence($from_date,$to_date);
		$data['project'] = $this->adminProcess->distinctDist();
		$data['date'] = $this->adminProcess->get_dt();
		
		$title['total_claim'] = $this->adminProcess->countClaim('mm_manager');
    	$title['total_payment'] = $this->adminProcess->countRow('tm_payment');
    	$title['total_reject'] = $this->process->countRejClaim('tm_claim');
		$this->load->view('templetes/welcome_header', $title);
		$this->load->view('SU/distWiseExpence', $data);
		$this->load->view('templetes/welcome_footer');
		}
		else{
			redirect('Admin/login');
		}
	}

}