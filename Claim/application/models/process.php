<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Model {

	public function login_process($user_id)
	{ 
		$this->db->select('password');
		$this->db->where('user_id',$user_id);

		$row = $this->db->get('m_user_master');
		if($row->num_rows() == 1)
		{
			return $row->row();
		}
		else
		{
			return false;
		}
	}

	public function changeUserStatus($status){
		$value = array('user_status' => $status);
		$this->db->where('emp_no',$this->session->userdata('is_login')->emp_no);
		$this->db->update('m_user_master',$value);
		return true;
	}

	public function get_value($user_id){
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$details = $this->db->get('m_user_master');
		return $details->row();
	}

	public function f_audit_trail_login($user_id){
		$host_name = $this->get_host_name();
		$time = $this->get_time();
		
		$value = array(
	        'login_dt' => $time,
	        'user_id' => $user_id,
	        'terminal_name' => $host_name
		);
		$this->db->insert('tm_audit_trail', $value);
	}

	public function f_audit_trail_value($user_id){
		$this->db->select_max('sl_no');
		$this->db->where('user_id', $user_id);
		$details = $this->db->get('tm_audit_trail');
		return $details->row();
	}



	public function f_audit_trail_logout(){
		$time = $this->get_time();
		$sl_no = $this->session->userdata('tm_audit_sl_no')->sl_no;

		$value = array(
	        'logout_dt' => $time
		);
		$this->db->where('sl_no', $sl_no);
		$this->db->update('tm_audit_trail', $value); 
	}


	public function get_host_name(){
		$host_name = gethostname();
		return $host_name;
	}

	public function get_time(){
		date_default_timezone_set('Asia/kolkata');
		$time = date("Y-m-d H:i:sa");
		return $time;
	}

	public function addClaimProcess($claimCode,$purpose,$date1,$date2,$projectName,$projectType,$narration,$total_amt){

		$time = $this->get_time();

		$value = array(
			'claim_cd' => $claimCode,
			'emp_no' => $this->session->userdata('loggedin')->emp_no,
			'claim_dt' => $time,
	        'project_type' => $projectType,
	        'project_name' => $projectName,
	        'purpose' => $purpose,
	        'from_dt' => $date1,
	        'to_dt' => $date2,
	        'narration' => $narration,
	        'amount' => $total_amt,
	        'created_by' => $this->session->userdata('loggedin')->emp_name,
	        'created_dt' => $time
		);
		$this->db->insert('tm_claim', $value);
		return true;
	}

	public function addClaimTrans($claimCode,$sl_no,$array_hd,$remarks,$amount){

		$time = $this->get_time();

		$value = array(
		'claim_cd' => $claimCode,
		'emp_no' => $this->session->userdata('loggedin')->emp_no,
		'claim_dt' => $time,
		'sl_no' => $sl_no,
		'claim_hd' => $array_hd,
	    'remarks' => $remarks,
	    'amount' => $amount );
	    $this->db->insert('tm_claim_trans', $value);
		return true;
	}

//public function addClTransRow($claimCode,$sl_no,$array_hd,$remarks,$amount);

	public function editClaimTrans($claimCode,$sl_no,$array_hd,$remarks,$array_amount){
		$time = $this->get_time();

		$value = array(
		'claim_hd' => $array_hd,
	    'remarks' => $remarks,
	    'amount' => $array_amount
	     );

		$this->db->where('claim_cd',$claimCode);
		$this->db->where('sl_no',$sl_no);
		$this->db->update('tm_claim_trans',$value);
		return true;
	}

	public function editClaimProcess($claimCode,$purpose,$date1,$date2,$projectName,$projectType,$narration,$total_amt){
		$value = $this->getDetailsbyEmpNo('mm_employee');
		foreach ($value as $key) {
			$modified_by = $key->emp_name;
		}
		$value = array(
	        'project_type' => $projectType,
	        'project_name' => $projectName,
	        'purpose' => $purpose,
	        'from_dt' => $date1,
	        'to_dt' => $date2,
	        'narration' => $narration,
	        'amount' => $total_amt,
	        'modified_by' => $modified_by,
	    	'modified_dt' => $this->get_time()
		);
		$this->db->where('claim_cd',$claimCode);
		$this->db->update('tm_claim', $value);
		return true;
	}

	public function count_row($claimCode,$array_sl_no){
		$this->db->select('*');
		$this->db->where('claim_cd',$claimCode);
		$query = $this->db->get('tm_claim_trans');
		if($query->num_rows() < $array_sl_no){
    		return $query->num_rows();
    	} else{
    		return false;
    	}
	}

	public function delClTransRow($claimCode,$array_sl_no){
		$this->db->where('claim_cd',$claimCode);
		$this->db->where_not_in('sl_no', $array_sl_no);
		$this->db->delete('tm_claim_trans');
		return true;
	}

	public function deleteClaimProcess($id,$t_name){
		$this->db->where('claim_cd',$id);
		$this->db->delete($t_name);
		return true;
	}

	public function addEmpProcess($emp_no,$emp_name,$status,$date1,$date2,$sector,$designation){
		$data = array(
	        'emp_no' => $emp_no,
	        'emp_name' => $emp_name,
	        'designation' => $designation,
	        'sector' => $sector,
	        'date_of_joining' => $date1,
	   		'status_flag' => $status,
	   		'date_of_termination' => $date2
		);

		$this->db->insert('mm_employee', $data);
	}
// getAll returns select * .....................................
	
	public function getAll($t_name){
		$this->db->select('*');
		$this->db->from($t_name);
		$result = $this->db->get();
		if( $result->num_rows() > 0) {
	        foreach ($result->result() as $row) {
	            $data[] = $row;
	        }
	        return $data;
    	}
		return false;
	}

	public function editEmployeeProcess($emp_no,$emp_name,$status,$date1,$date2,$sector,$designation){
		$value = array(
	        'emp_name' => $emp_name,
	        'designation' => $designation,
	        'sector' => $sector,
	        'date_of_joining' => $date1,
	        'status_flag' => $status,
	        'date_of_termination' => $date2
		);
		$this->db->where('id',$emp_no);
		$this->db->update('mm_employee', $value);
		return true;
	}

	public function addProjectProcess($project_cd,$project_name,$project_type,$district){
		$value = array(
	        'project_cd' => $project_cd,
	        'project_name' => $project_name,
	        'project_type' => $project_type,
	        'dist' => $district,
	        'created_by' => $this->session->userdata('loggedin')->emp_name
		);
		$this->db->insert('mm_project', $value);
	}

	public function editProjectProcess($id,$project_cd,$project_name,$project_type,$district){
		$time = $this->get_time();
		$value = array(
	        'project_cd' => $project_cd,
	        'project_name' => $project_name,
	        'project_type' => $project_type,
	        'dist' => $district,
	        'modified_by' => $this->session->userdata('loggedin')->emp_name,
	        'modified_dt' => $time
		);
		$this->db->where('id',$id);
		$this->db->update('mm_project', $value);
		return true;
	}

	public function addProjectTypeProcess($type_cd,$type_desc){
		$value = array(
	        'type_cd' => $type_cd,
	        'type_desc' => $type_desc,
	        'created_by' => $this->session->userdata('loggedin')->emp_name
		);
		$this->db->insert('mm_project_type', $value);
	}

	public function editProjectTypeProcess($id,$type_cd,$type_desc){
		$time = $this->get_time();
		$value = array(
	        'type_cd' => $type_cd,
	        'type_desc' => $type_desc,
	        'modified_by' => $this->session->userdata('loggedin')->emp_name,
	        'modified_dt' => $time
		);
		$this->db->where('id',$id);
		$this->db->update('mm_project_type', $value);
		return true;
	}


	public function getDetailsbyId($id,$t_name){
		$this->db->where('id',$id);
		$query = $this->db->get($t_name);
		return $query->row();
	}

	public function getDetailsbyClaimCd($id,$t_name){
		$this->db->where('claim_cd',$id);
		$query = $this->db->get($t_name);
		return $query->row();
	}

	public function getClTransbyClaimCd($id,$t_name){
		$this->db->where('claim_cd',$id);
		$query = $this->db->get($t_name);
		if( $query->num_rows() > 0) {
        // loop through each record (row) and place that
        // record into an array called $data
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
    }
		return $data;
	}


	public function getEmp($t_name,$id){
		$this->db->select('*');
		$this->db->where('claim_cd', $id);
		$result = $this->db->get('tm_claim');

		if( $result->num_rows() > 0) {
        	foreach ($result->result() as $row) {
            	$data[] = $row;
        	}
        	foreach ($data as $key) {
    			$emp_no = $key->emp_no;
    			$data1 = $this->getDetailsOfEmpNo($t_name,$emp_no);
			}	
		}
		return $data1;
    }

    public function getDetailsOfEmpNo($t_name,$emp_no){
		$this->db->select('*');
		$this->db->where('emp_no',$emp_no);
		$result = $this->db->get($t_name);
		if( $result->num_rows() > 0) {
        // loop through each record (row) and place that
        // record into an array called $data
        foreach ($result->result() as $row) {
            $data[] = $row;
        }
        return $data;
    	}
    	else{
    		return false;
    	}
    }

// For Report........................................................

	public function reportProcess($date1,$date2){

		$this->db->where('emp_no' , $this->session->userdata('loggedin')->emp_no);
		$this->db->where('approval_status' , 1);
		$this->db->where('claim_dt >= ' , $date1);
		$this->db->where('claim_dt <= ' , $date2);
		
		$query = $this->db->get('tm_claim');
		$this->set_dt($date1,$date2);
		if( $query->num_rows() > 0) {
	        foreach ($query->result() as $row) {
    	        $data[] = $row;
        	}
        	return $data;
    	}
    	else{
    		return 0;
    	}
	}	

	public function personalLedger($date1,$date2){
		
		$emp_no = $this->session->userdata('loggedin')->emp_no;
				
		$this->db->where('emp_no',$emp_no);
		$this->db->where('balance_dt >= ' , $date1);
		$this->db->where('balance_dt <= ' , $date2);
		$this->db->order_by('balance_dt', 'asc');
		$query = $this->db->get('tm_balance_amt');

		$this->set_dt($date1,$date2);

		if( $query -> num_rows() > 0) {
	        foreach ($query->result() as $row) {
    	        $data[] = $row;
        	}
        	return $data;
    	}
    	else{
    		return 0;
    	}
	}

	public function paymentDetails($date1,$date2){
		
		$emp_no = $this->session->userdata('loggedin')->emp_no;
				
		$this->db->where('emp_no',$emp_no);
		$this->db->where('approval_status',1);
		$this->db->where('trans_dt >= ' , $date1);
		$this->db->where('trans_dt <= ' , $date2);
		$this->db->order_by('trans_dt', 'asc');
		$query = $this->db->get('tm_payment');

		$this->set_dt($date1,$date2);

		if( $query -> num_rows() > 0) {
	        foreach ($query->result() as $row) {
    	        $data[] = $row;
        	}
        	return $data;
    	}
    	else{
    		return 0;
    	}
	}

	public function opening_balance($from_date){
		$emp_no = $this->session->userdata('loggedin')->emp_no;
		$this->db->select("* FROM tm_balance_amt
			WHERE emp_no = $emp_no and
					balance_dt = (select max(balance_dt)
                    from   tm_balance_amt
                    where  balance_dt < '$from_date')");
		$query = $this->db->get();
		
        return $query->row();
    	
	}

	public function closing_balance(){
		$emp_no = $this->session->userdata('loggedin')->emp_no;
		$this->db->select("* FROM tm_balance_amt
			WHERE emp_no = $emp_no and
					balance_dt = (select max(balance_dt)
                    from   tm_balance_amt)");
		$query = $this->db->get();
		
        return $query->row();
    	
	}

	public function get_dt(){
		$this->db->select('*');
		$this->db->where('id',$this->session->userdata('loggedin')->emp_no);
		$query = $this->db->get('tt');

		return $query->row();
	}

	public function set_dt($date1,$date2){
		$value = array(
			'from_date' => $date1,
			'to_date' =>$date2
		);
		$this->db->select('*');
		$this->db->where('id',$this->session->userdata('loggedin')->emp_no);
		$query = $this->db->get('tt');
		if($query->num_rows() > 0){
			$this->db->where('id',$this->session->userdata('loggedin')->emp_no);
			$this->db->update('tt',$value);
		}
		else{
			$value = array(
				'id' =>  $this->session->userdata('loggedin')->emp_no,
				'from_date' => $date1,
				'to_date' => $date2
			);
			$this->db->insert('tt',$value);
		}

		
		return 1;
	}

	public function countRow($t_name){
		$this->db->select('count(*) as count');
		$this->db->where('emp_no <>', $this->session->userdata('loggedin')->emp_no);
		$this->db->where('approval_status <> 1');
		$query = $this->db->get($t_name);

		 return $query->row();
	}

	public function getDetailsbyEmpNo($t_name){
			$this->db->select('*');
		$this->db->where('emp_no', $this->session->userdata('loggedin')->emp_no);
		$result = $this->db->get($t_name);
		if( $result->num_rows() > 0) {
	        foreach ($result->result() as $row) {
	            $data[] = $row;
	        }
        return $data;
    	}
    }


	public function getDetailsbyTransCd($id,$t_name){
		$this->db->where('trans_cd',$id);
		$query = $this->db->get($t_name);
		return $query->row();
	}


    public function maxCode($t_name,$var){
    	$this->db->select_max($var);
    	$result = $this->db->get($t_name);
    	if($result){
    		return $result->row();
    	}
    	else{
    		return 0;
    	}
    	
    }

    public function editNameProcess($name){
    	$value = array('emp_name' => $name );
    	$this->db->where('emp_no', $this->session->userdata('loggedin')->emp_no);
    	$this->db->update('mm_employee',$value);
    	return true;
    }

    public function matchPass($oldPass){
    	$this->db->select('password');
    	$this->db->where('emp_no', $this->session->userdata('loggedin')->emp_no);
    	
    	$query = $this->db->get('m_user_master');
    	if ($query->num_rows() == 1) {
    		return $query->row();
    	}
    	else{
    		return false;
    	}
    }

    public function editPassProcess($newPass){
    	$value = array('password' => $newPass );
    	$this->db->where('emp_no', $this->session->userdata('loggedin')->emp_no);
    	$this->db->update('m_user_master',$value);
    	return true;
    }

    public function getRejectClaim(){
    	$this->db->select('*');
    	$this->db->where('emp_no', $this->session->userdata('loggedin')->emp_no);
    	$this->db->where('rejection_status', 1);
    	$result = $this->db->get('tm_claim');

    	if($result->num_rows() > 0) {
	        foreach ($result->result() as $row) {
	            $data[] = $row;
	        }
        return $data;
    	}
    }

    public function countRejClaim($t_name){
		$this->db->select('count(*) as count');
		$this->db->where('emp_no', $this->session->userdata('loggedin')->emp_no);
		$this->db->where('rejection_status', 1);
		$query = $this->db->get($t_name);

		 return $query->row();
	}

}
