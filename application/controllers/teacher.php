<?php
	session_start();
	class Teacher extends CI_Controller 
	{
		public function __construct() {
			error_reporting(0);
			parent::__construct();			
		}

		public function index() {
			$data['logged_in'] = $this->session->userdata('logged_in');
			if($data['logged_in'] == TRUE){
				$this->profile();
			}
			else
				$this->load->view('pages/signin');
		} 

		public function huehue($id) {
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE) {
				$data['account_id'] = $data['info']['account_id'];	 
				$data['account_type'] = $data['info']['account_type'];

				$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
				$data['faculty_id'] = $data['teacherInfo']['faculty_id'];
				$data['first_name'] = $data['teacherInfo']['first_name'];
				$data['last_name'] = $data['teacherInfo']['last_name'];

				$data['id_code'] = $id;
				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				$data['viewAttendance'] = $this->teacher_model->viewReviewAttendance($data);			

				$this->load->view('seatplan_teacher/review_laboratory',$data);
			} else
				$this->index();
		}

		public function huehue2($id) {
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE) {
				$data['account_id'] = $data['info']['account_id'];	 
				$data['account_type'] = $data['info']['account_type'];

				$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
				$data['faculty_id'] = $data['teacherInfo']['faculty_id'];
				$data['first_name'] = $data['teacherInfo']['first_name'];
				$data['last_name'] = $data['teacherInfo']['last_name'];

				$data['id_code'] = $id;
				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				$data['viewAttendance'] = $this->teacher_model->viewReviewAttendance($data);			

				$this->load->view('seatplan_teacher/review_classroom',$data);
			} else
				$this->index();
		}

		public function viewRevAttendance($date,$code) {
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE) {

				$data['date'] = $date;
				$data['id_code'] = $code;
				$data['account_id'] = $data['info']['account_id'];	 
				$data['account_type'] = $data['info']['account_type'];

				$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
				$data['faculty_id'] = $data['teacherInfo']['faculty_id'];
				$data['first_name'] = $data['teacherInfo']['first_name'];
				$data['last_name'] = $data['teacherInfo']['last_name'];
					
				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				$data['viewAttendance'] = $this->teacher_model->checkReviewAttendance($data);							

				$this->load->view('seatplan_teacher/review_classroom',$data);
			} else
				$this->index();
		}

	     public function huehue3($id)
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE) {
				$data['account_id'] = $data['info']['account_id'];	 
				$data['account_type'] = $data['info']['account_type'];

				$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
				$data['faculty_id'] = $data['teacherInfo']['faculty_id'];
				$data['first_name'] = $data['teacherInfo']['first_name'];
				$data['last_name'] = $data['teacherInfo']['last_name'];

				$data['id_code'] = $id;
				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				$data['viewAttendance'] = $this->teacher_model->viewReviewAttendance($data);			

				$this->load->view('seatplan_teacher/review_brd2',$data);
			} else
				$this->index();
		}

		public function huehue4($id)
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE) {
				$data['account_id'] = $data['info']['account_id'];	 
				$data['account_type'] = $data['info']['account_type'];

				$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
				$data['faculty_id'] = $data['teacherInfo']['faculty_id'];
				$data['first_name'] = $data['teacherInfo']['first_name'];
				$data['last_name'] = $data['teacherInfo']['last_name'];

				$data['id_code'] = $id;
				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				$data['viewAttendance'] = $this->teacher_model->viewReviewAttendance($data);			

				$this->load->view('seatplan_teacher/review_brd1',$data);
			} else
				$this->index();
		}

		public function profile() {			
    	$data['info'] = $this->session->userdata('logged_in'); 
    	if($data['info'] == TRUE){

  		date_default_timezone_set('Asia/Manila');
			$data['date'] = date('Y-m-d');
			$data['time'] = date('h:i A');

    		$data['account_id'] = $data['info']['account_id'];	 
			$data['account_type'] = $data['info']['account_type'];


			$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
			
			$data['first_name'] = $data['teacherInfo']['first_name'];
			$data['middle_name'] = $data['teacherInfo']['middle_name'];
			$data['last_name'] = $data['teacherInfo']['last_name'];
			$data['middle_name'] = $data['teacherInfo']['middle_name'];
			$data['gender'] = $data['teacherInfo']['gender'];
			$data['contact_number'] = $data['teacherInfo']['contact_number'];
			$data['address'] = $data['teacherInfo']['address'];
			$data['date_of_birth'] = $data['teacherInfo']['date_of_birth'];

			$data['faculty_id'] = $data['teacherInfo']['faculty_id'];
			$data['classes'] = $this->teacher_model->viewClasses($data);
			$data['students_load'] = $this->teacher_model->studentsStudyLoad();

			//Get college
			$data['college_id'] = $data['teacherInfo']['college_id'];
			$data['collegeinfo'] = $this->teacher_model->get_college($data);
			$data['teacherinfo'] = $this->teacher_model->teacherInfo($data);	
			//$this->load->view('teacher/home',$data);

			//Upload Photo
			$data['view'] = $this->teacher_model->viewPhoto($data);
			$data['image_path'] = $data['view']['image_path'];
			$config['upload_path'] = "./images/faculty";
	   		$config['allowed_types'] = 'jpg|jpeg|png';
	  		$this->load->library('upload',$config);    

	  		$data['noClass'] = $this->teacher_model->noClass($data);	
	  		$data['wayKlase'] = $data['noClass']['date'];	

	  		$data['datepicker'] = $this->input->post('date');
				$data['start_time'] = $this->input->post('start_time');
				$data['end_time'] = $this->input->post('end_time');

	  		$data['suspendClass'] = $this->teacher_model->suspendClass($data);
	  		$data['petsa'] = $data['suspendClass']['date'];
	  		$data['sugod'] = $data['suspendClass']['start_time'];
	  		$data['human'] = $data['suspendClass']['end_time'];
	  		$data['event'] = $data['suspendClass']['event'];

   		if(!$this->upload->do_upload()) {  
   			$data['error'] = $this->upload->display_errors();
   			$this->load->view('teacher/home',$data);
   		} else {     	
   	   	$data['upload'] = $this->upload->data();      		    
   	   	$data['file_path'] = "../images/faculty/";  		    	     		    	
   	  	$data['file_name'] = $data['upload']['file_name'];     		    	
   	  	$data['update'] = $this->teacher_model->upload($data);
	     	  	
				$this->load->view('teacher/home',$data);
				}
			} else
				$this->index();
  		}

		public function get_offer_codes() {
			$data['info'] = $this->session->userdata('logged_in');
			$data['account_id'] = $data['info']['account_id'];	 
			$data['account_type'] = $data['info']['account_type'];

			$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
			
			$data['first_name'] = $data['teacherInfo']['first_name'];
			$data['last_name'] = $data['teacherInfo']['last_name'];
			$data['faculty_id'] = $data['teacherInfo']['faculty_id'];

			$data['subject'] = $this->input->post('subject');
			$data['offer_code'] = $this->input->post('offer_code');
			$data['subjects'] = $this->teacher_model->get_subject($data);

			$offer_codes = $this->teacher_model->get_offer_code($data);
				foreach ($offer_codes as $offer_code) {
					$value[$i]['id'] = $offer_code->subject_code;
					$value[$i]['o_code'] = $offer_code->subject_code;
					$i++;
				}
				echo json_encode($value);
		}


		public function view_candidates() 
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE) {
				$data['account_id'] = $data['info']['account_id'];	 
				$data['account_type'] = $data['info']['account_type'];

				$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
					
				$data['first_name'] = $data['teacherInfo']['first_name'];
				$data['last_name'] = $data['teacherInfo']['last_name'];
				$data['faculty_id'] = $data['teacherInfo']['faculty_id'];

				$data['subjects'] = $this->teacher_model->get_subject($data);
				$data['offer_code'] = $this->input->post('offer_code');

				$data['viewSubjects'] = $this->teacher_model->viewClasses($data);
				$data['viewCandidates'] = $this->teacher_model->viewCandidates($data);

				$this->load->view('teacher/viewsdpc',$data);
			} else
				$this->index();
		}

		//View Attendance
		public function view_logs() {
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE) {
				$data['account_id'] = $data['info']['account_id'];	 
				$data['account_type'] = $data['info']['account_type'];

				$data['id'] = $_GET['id'];

				$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
				$data['faculty_id'] = $data['teacherInfo']['faculty_id'];
				$data['first_name'] = $data['teacherInfo']['first_name'];
				$data['last_name'] = $data['teacherInfo']['last_name'];

				$data['classes'] = $this->teacher_model->viewClasses($data);
				$data['students_load'] = $this->teacher_model->studentsStudyLoad();			

				$this->load->view('teacher/attendance',$data);
			} else
				$this->index();
		}

		//View Attendance Logs
		public function updateStatus($id){
			$data['student_number'] = $_GET['id'];
			$data['date'] = $id;
			$this->teacher_model->updateAttendance($data);	
			
			$newURL = "http://localhost/sms/teacher/logs";
        header('Location: '.$newURL);
		}

		//View Attendance Logs
		public function updateStatusLate($id){
			$data['student_number'] = $_GET['id'];
			$data['date'] = $id;
			$this->teacher_model->updateStatusOfLate($data);	
			
			$newURL = "http://localhost/sms/teacher/logs";
	          header('Location: '.$newURL);
		}

		public function logs() {

			$data['info'] = $this->session->userdata('logged_in');

			if($data['info'] == TRUE) {
				$data['account_id'] = $data['info']['account_id'];	 
				$data['account_type'] = $data['info']['account_type'];

				$data['id'] = $_GET['id'];

				$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
				$data['faculty_id'] = $data['teacherInfo']['faculty_id'];
				$data['first_name'] = $data['teacherInfo']['first_name'];
				$data['last_name'] = $data['teacherInfo']['last_name'];		

				$data['viewDistinctLogs'] = $this->teacher_model->viewDistinctLogs($data);
				$data['classes'] = $this->teacher_model->mgaKlase($data);

				//$data['viewLogs'] = $this->teacher_model->viewLogs($data); // subjects

				$this->load->view('teacher/logs',$data);
			} else
				 $this->index();
		}

		public function message()
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$this->load->view('teacher/message',$data);
			} else
				$this->index();
		}
		
		//Change Password
		public function view_changepassword() 
	    {
	      $data['teacher_info'] = $this->session->userdata('logged_in');
	      if($data['teacher_info'] == TRUE){
		      $data['username'] = $data['teacher_info']['username'];
		      $data['first_name'] = $data['teacher_info']['first_name'];
		      $data['last_name'] = $data['teacher_info']['last_name'];

		      $this->form_validation->set_rules('password','Password','required|trim|callback_change');
		      $this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]');
		      $this->form_validation->set_rules('cnew_password','Confirm Password','required|trim|matches[new_password]');

		      if($this->form_validation->run() == FALSE) 
		      {
		        $this->load->view('teacher/change_password', $data);
		      }   
		   } else
		   	$this->index();
	    }

	    public function change() 
	    {
	      $data['teacher_info'] = $this->session->userdata('logged_in');
	      $data['username'] = $data['teacher_info']['username'];
	      $data['first_name'] = $data['teacher_info']['first_name'];
	      $data['last_name'] = $data['teacher_info']['last_name'];
	      $data['password'] = $data['teacher_info']['password'];

	      $this->teacher_model->compare_password($data);

	      $password = $this->input->post('password');
	      $db_password = $data['password'];

	      
	      if($password == $db_password) 
	      {
	        $newURL = "http://localhost/sms/teacher/view_changepassword";
	          header('Location: '.$newURL);
	          $data['password'] = $data['teacher_info']['password'];  
	          $data['new_password'] = $this->input->post('new_password');
	          $data['cnew_password'] = $this->input->post('cnew_password');

	          $this->teacher_model->changepassword($data);

	        $this->form_validation->set_message('change','<div class="alert-success"><a href="#"" class="close" data-dismiss="alert">&nbsp;&times;</a>
	<		strong>Password Updated</strong></div>');
	   	    return false;
	      } else 

	        $this->form_validation->set_message('change','<div class="alert-error"><a href="#"" class="close" data-dismiss="alert">&nbsp;&times;</a>
			<strong>Invalid current password</strong> </div>');
	        return false;
	    }       

	      public function validate_password() 
	      {
	        $data['teacher_info'] = $this->session->userdata('logged_in');
	        $data['username'] = $data['teacher_info']['username'];
	        $data['first_name'] = $data['teacher_info']['first_name'];
	        $data['last_name'] = $data['teacher_info']['last_name'];
	        $data['password'] = $data['teacher_info']['password'];

	        $this->teacher_model->compare_password($data);

	        $password = $this->input->post('password');
	        $db_password = $data['password'];
	        $password = $this->input->post('password');

	        if(strlen($password) > 5 &&  $db_password == $password) 
	        { //Checks the length of the password
	            echo "Valid";
	        } 
	        else 
	        {
	          echo "Invalid";
	        }
	      }

	      public function check_passwordlength() 
	      {
	        $password = $this->input->post('password');

	        if(strlen($password) > 5)
	        {
	          echo "Valid";
	        } 
	        else 
	        {
	          echo "Invalid";
	        }
	      }

	      public function check_newpasswordlength() 
	      {
	        $new_password = $this->input->post('new_password');

	        if(strlen($new_password) > 5) 
	        {
	          echo "Valid";
	        } 
	        else 
	        {
	          echo "Invalid";
	        }
	      }

	  	//SEATPLAN VIEW
		public function classroom($date,$code) {
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['viewAttendance'] = $this->teacher_model->viewAttendance($data);				
				$data['logins'] = $this->teacher_model->viewCampusLogin($data);
				$data['violation'] = $this->teacher_model->viewViolation($data);		
				$data['suspension'] = $this->teacher_model->viewSuspension($data);

				date_default_timezone_set('Asia/Manila');
				$date = date('Y-m-d');
				$this->teacher_model->updateStatus();
				$data['onlyonce'] = $this->teacher_model->viewNumberOfAttendance();



			// 	for ($i=1; $i <41 ; $i++) { 
			// 		$data['a'.$i] = $this->input->post('attendance'.$i);		
			// 	}

			// 	for ($i=1; $i <41 ; $i++) { 
			// 	$data['student_number'.$i] = $this->input->post('student_number'.$i);	
			// 	}						
							
			// 	if(isset($_POST['submit']))
			// 	{								
			// 		$this->teacher_model->insertAttendance($data);
			// 		header('Location:http://localhost/sms/teacher/huehue2/'.$data['id_code']);							
			// 	}

			// 	$data['viewStudents'] = $this->teacher_model->viewStudents($data);
			// 	$this->load->view('seatplan_teacher/classroom',$data);		
			// } else 
			// 	$this->index();	

				// $data['logins'] = $this->teacher_model->viewCampusLogin($data);
				// $data['violation'] = $this->teacher_model->viewViolation($data);		
				// $data['suspension'] = $this->teacher_model->viewSuspension($data);
				
				// $this->teacher_model->updateStatus();
				// $data['onlyonce'] = $this->teacher_model->viewNumberOfAttendance();
				
				for ($i=1; $i <49 ; $i++) { 
					$data['a'.$i] = $this->input->post('attendance'.$i);		
				}

				for ($i=1; $i <49 ; $i++) { 
					$data['student_number'.$i] = $this->input->post('student_number'.$i);	
				}						
							
				if(isset($_POST['submit'])){								
					$this->teacher_model->insertAttendance($data);
					header('Location:http://localhost/sms/teacher/huehue2/'.$data['id_code']);												
				}

				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				// $this->load->view('seatplan_teacher/classroom',$data);	
				header('Location:http://localhost/sms/teacher/viewRevAttendance/'.$date.'/'.$code);
			} else
				$this->index();

		}

		public function assign_classroom($id)
		{
			
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['viewStudents'] = $this->teacher_model->viewStudents($data);				
				$data['assigned_seats'] = $this->teacher_model->viewAssignedStudents($data);
				for ($i=1; $i <49 ; $i++) { 
				$data['a'.$i] = $this->input->post(''.$i);
				}					
				

				if(isset($_POST['submit'])){			
					$this->teacher_model->updateSeat($data);
					header('Location:http://localhost/sms/teacher/assign_classroom/'.$data['id_code']);
				}
				else					
					$this->load->view('seatplan_teacher/assign_classroom',$data);
			} else
				$this->index();
		}

		public function laboratory($id)
		{			
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['viewAttendance'] = $this->teacher_model->viewAttendance($data);				
				$data['logins'] = $this->teacher_model->viewCampusLogin($data);
				$data['violation'] = $this->teacher_model->viewViolation($data);		
				$data['suspension'] = $this->teacher_model->viewSuspension($data);

				date_default_timezone_set('Asia/Manila');
				$date = date('Y-m-d');
				$this->teacher_model->updateStatus();
				$data['onlyonce'] = $this->teacher_model->viewNumberOfAttendance();


				for ($i=1; $i <41 ; $i++) { 
					$data['a'.$i] = $this->input->post('attendance'.$i);		
				}

				for ($i=1; $i <41 ; $i++) { 
				$data['student_number'.$i] = $this->input->post('student_number'.$i);	
				}						
							
				if(isset($_POST['submit']))
				{								
					$this->teacher_model->insertAttendance($data);
					header('Location:http://localhost/sms/teacher/huehue/'.$data['id_code']);							
				}

				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				$this->load->view('seatplan_teacher/laboratory',$data);		
			} else 
				$this->index();		
				
		}

		public function assign_laboratory($id)
		{
			
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){

				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];				
				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				$data['assigned_seats'] = $this->teacher_model->viewAssignedStudents($data);		
				
				
				for ($i=1; $i < 41 ; $i++) { 
					$data['a'.$i] = $this->input->post($i);
				}					
				
				if(isset($_POST['submit'])) {		

					if(!in_array($data['a'.$i], $data['assigned_seats'])) {
						$this->teacher_model->updateSeat($data);
						header('Location:http://localhost/sms/teacher/assign_laboratory/'.$data['id_code']);
						
					} else {
						echo "Not allowed.";
					}
					
				}
				else {
					$this->load->view('seatplan_teacher/assign_laboratory',$data);
				}
					
			} else {
				$this->index();
			}
				
		}

		public function brd1($id)
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['viewAttendance'] = $this->teacher_model->viewAttendance($data);				
				$data['logins'] = $this->teacher_model->viewCampusLogin($data);
				$data['violation'] = $this->teacher_model->viewViolation($data);		
				$data['suspension'] = $this->teacher_model->viewSuspension($data);

				date_default_timezone_set('Asia/Manila');
				$date = date('Y-m-d');
				$this->teacher_model->updateStatus();
				$data['onlyonce'] = $this->teacher_model->viewNumberOfAttendance();


				for ($i=1; $i <49 ; $i++) { 
					$data['a'.$i] = $this->input->post('attendance'.$i);		
				}

				for ($i=1; $i <49 ; $i++) { 
				$data['student_number'.$i] = $this->input->post('student_number'.$i);	
				}						
							
				if(isset($_POST['submit']))
				{								
					$this->teacher_model->insertAttendance($data);
					header('Location:http://localhost/sms/teacher/huehue4/'.$data['id_code']);							
				}

				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				$this->load->view('seatplan_teacher/brd1',$data);		
			} else 
				$this->index();	
	    }	

		public function assign_brd1($id)
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE)
			{
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['viewStudents'] = $this->teacher_model->viewStudents($data);				
				$data['assigned_seats'] = $this->teacher_model->viewAssignedStudents($data);
				for ($i=1; $i <49 ; $i++) 
				{ 
					$data['a'.$i] = $this->input->post(''.$i);
				}					
				

				if(isset($_POST['submit'])){			
					$this->teacher_model->updateSeat($data);
					header('Location:http://localhost/sms/teacher/assign_brd1/'.$data['id_code']);
				}
				else					
					$this->load->view('seatplan_teacher/assign_brd1',$data);
			} else
				$this->index();
		
		}

		public function brd2($id)
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['viewAttendance'] = $this->teacher_model->viewAttendance($data);				
				$data['logins'] = $this->teacher_model->viewCampusLogin($data);
				$data['violation'] = $this->teacher_model->viewViolation($data);		
				$data['suspension'] = $this->teacher_model->viewSuspension($data);

				date_default_timezone_set('Asia/Manila');
				$date = date('Y-m-d');
				$this->teacher_model->updateStatus();
				$data['onlyonce'] = $this->teacher_model->viewNumberOfAttendance();


				for ($i=1; $i <33 ; $i++) { 
					$data['a'.$i] = $this->input->post('attendance'.$i);		
				}

				for ($i=1; $i <33 ; $i++) { 
				$data['student_number'.$i] = $this->input->post('student_number'.$i);	
				}						
							
				if(isset($_POST['submit']))
				{								
					$this->teacher_model->insertAttendance($data);
					header('Location:http://localhost/sms/teacher/huehue3/'.$data['id_code']);							
				}

				$data['viewStudents'] = $this->teacher_model->viewStudents($data);
				$this->load->view('seatplan_teacher/brd2',$data);		
			} else 
				$this->index();	
	    }	

		public function assign_brd2($id)
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE)
			{
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['viewStudents'] = $this->teacher_model->viewStudents($data);				
				$data['assigned_seats'] = $this->teacher_model->viewAssignedStudents($data);
				for ($i=1; $i <33 ; $i++) 
				{ 
					$data['a'.$i] = $this->input->post(''.$i);
				}					
				

				if(isset($_POST['submit'])){			
					$this->teacher_model->updateSeat($data);
					header('Location:http://localhost/sms/teacher/assign_brd2/'.$data['id_code']);
				}
				else					
					$this->load->view('seatplan_teacher/assign_brd2',$data);
			} else
				$this->index();
		}

		public function viewSpecificDate()
		{
			$data['id'] = $_GET['id'];
			$data['GraduatePlease'] = $this->teacher_model->viewSpecificdate($data);
			$this->load->view('teacher/viewSpecificdate',$data);
		}


		//Show Calendar
		public function calendar_teacher($year=null,$month=null) 
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE)
			{
				$data['account_id'] = $data['info']['account_id'];	 
				$data['account_type'] = $data['info']['account_type'];

				$data['teacherInfo'] = $this->teacher_model->teacherInfo($data);
				
				$data['first_name'] = $data['teacherInfo']['first_name'];
				$data['last_name'] = $data['teacherInfo']['last_name'];

				$data['event'] = $this->input->post('event');
				$data['date'] = $this->input->post('date');	
				
				$data['result'] = $this->teacher_model->getEvents();

				$day = (int)substr($row->date,8,2);
				$mon = (int)substr($row->date,6,2);

			    $events[(int)$day] = $row->event;
			    $events = array();

			    foreach($data['result'] as $row) {

			    	$day = (int)substr($row['date'],8,2);
			    	$mon = (int)substr($row['date'],5,2);

				    if(!array_key_exists($day,$events)) { 
						$events[$day] = $row['event'];
					}

					else {
						$temp = $row['event'];
						$events[$day] = $events[$day]."<br> <li>".$temp;
					}

					$events_month[$mon][$day] = $events; 
					
				} 

				$config['show_next_prev'] = 'TRUE';
			    $config['day_type'] = 'long';
			    $config['next_prev_url'] = base_url().'teacher/calendar_teacher';
			    $config['template'] = '
			    {cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
			    {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
			    {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
			    {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
			    '; 
			    $config['template'] = '
			    {table_open}<table class="calendar">{/table_open}
			    {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
			    {cal_cell_content}<span class="day_listing">{day}</span>&nbsp;&bull; {content}&nbsp;{/cal_cell_content}
			    {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span>&bull; {content}</div>{/cal_cell_content_today}
			    {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
			    {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
			    '; 

			    $this->load->library('calendar',$config);
			    $y = intval($this->uri->segment(3));
			    $m = intval($this->uri->segment(4));
    			$data['viewCalendar']= $this->calendar->generate($y,$m,$events_month[$m]);
					
				$this->load->view('calendar/calendar_teacher',$data);	
		  
		  } 
		  else
		  	$this->index();
		  }

		  public function logout() 
		  {
		    $this->session->unset_userdata('logged_in');
		    session_destroy();
		    $this->index();
	  	  }	  		  	 
	  	  
	  	 

}

?>