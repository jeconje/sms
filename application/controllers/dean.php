<?php
	session_start();
	class Dean extends CI_Controller 
	{
		public function __construct()
		{
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

		public function profile() 
		{
	    	$data['info'] = $this->session->userdata('logged_in');
	    	if($data['info'] == TRUE){
		    	$data['account_id'] = $data['info']['account_id'];	  
				$data['account_type'] = $data['info']['account_type'];
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['middle_name'] = $data['info']['middle_name'];
				$data['gender'] = $data['info']['gender'];
				$data['contact_number'] = $data['info']['contact_number'];
				$data['email_address'] = $data['info']['email_address'];
				$data['date_of_birth'] = $data['info']['date_of_birth'];
				$data['address'] = $data['info']['address'];
				$data['department_id'] = $data['info']['department_id'];

				$data['faculty_id'] = $data['info']['faculty_id'];
				$data['deaninfo'] = $this->dean_model->deanInfo($data);

				//Get college
				$data['college_id'] = $data['info']['college_id'];
				$data['collegeinfo'] = $this->teacher_model->get_college($data);

				//Upload Photo
				$data['view'] = $this->dean_model->viewPhoto($data);
				$data['image_path'] = $data['view']['image_path'];
				$config['upload_path'] = "./images/faculty";
	     		$config['allowed_types'] = 'jpg|jpeg|png';
	      		$this->load->library('upload',$config);     		    

	     		if(!$this->upload->do_upload())
	     		{  
	     			$data['error'] = $this->upload->display_errors();
	     			$this->load->view('dean/home',$data);
	     		}
	     		
	     		else
	     		{     	
		     	   	$data['upload'] = $this->upload->data();      		    
		     	   	$data['file_path'] = "../images/faculty/";  		    	     		    	
		     	  	$data['file_name'] = $data['upload']['file_name'];     		    	
		     	  	$data['update'] = $this->dean_model->upload($data);
		     	  	
					$this->load->view('dean/home',$data);
				}
			} else
				$this->index();
		
  		}

		public function view_candidates() 
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['faculty_id'] = $data['info']['faculty_id'];
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$data['viewSubjects'] = $this->dean_model->viewClasses($data);
				$data['viewCandidates'] = $this->dean_model->viewCandidates($data);

				$this->load->view('dean/viewsdpc',$data);
			} else
				$this->index();
		}

		//View Attendance
		public function view_logs()
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['faculty_id'] = $data['info']['faculty_id'];
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$data['classes'] = $this->dean_model->viewClasses($data);

				$this->load->view('dean/attendance',$data);
			} else
				$this->index();
		}

		//View Logs
		public function logs()
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['faculty_id'] = $data['info']['faculty_id'];
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$data['classes'] = $this->dean_model->viewClasses($data);

				$this->load->view('dean/logs',$data);
			} else
				$this->index();
		}

		public function message()
		{
			$data['deanInfo'] = $this->session->userdata('logged_in');
			if($data['deanInfo'] == TRUE){
				$data['first_name'] = $data['deanInfo']['first_name'];
				$data['last_name'] = $data['deanInfo']['last_name'];

				$this->load->view('dean/message',$data);
			} else
				$this->index();
		}

		public function edit_profile() 
		{
			$data['dean_info'] = $this->session->userdata('logged_in');
			if($data['dean_info'] == TRUE){
				$data['first_name'] = $data['dean_info']['first_name'];
				$data['last_name'] = $data['dean_info']['last_name'];

				$data['username'] = $data['dean_info']['username'];
				$data['info'] = $this->dean_model->editProfile($data);

				//Get college
				$data['college_id'] = $data['info']['college_id'];
				$data['collegeinfo'] = $this->teacher_model->get_college($data);
				
				$this->load->view('dean/edit_profile',$data);

				if(isset($_POST['submit'])) 
				{
					$newURL = "http://localhost/sms/dean/edit_profile";
					header('Location: '.$newURL);		
					$data['username'] = $data['dean_info']['username'];
					$data['address'] = $this->input->post('address');
					$data['contact_number'] = $this->input->post('contact_number');
					
					$this->dean_model->edit_profile($data);
				}
			} else
				$this->index();
		}
		
		//Change Password
		public function view_changepassword() 
	    {
	      $data['dean_info'] = $this->session->userdata('logged_in');
	      if($data['dean_info'] == TRUE){
		      $data['username'] = $data['dean_info']['username'];
		      $data['first_name'] = $data['dean_info']['first_name'];
		      $data['last_name'] = $data['dean_info']['last_name'];

		      $this->form_validation->set_rules('password','Password','required|trim|callback_change');
		      $this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]');
		      $this->form_validation->set_rules('cnew_password','Confirm Password','required|trim|matches[new_password]');

		      if($this->form_validation->run() == FALSE) 
		      {
		        $this->load->view('dean/change_password', $data);
		      }   
		  } else
		  	$this->index();
	    }

	    public function change() 
	    {
	      $data['dean_info'] = $this->session->userdata('logged_in');
	      $data['username'] = $data['dean_info']['username'];
	      $data['first_name'] = $data['dean_info']['first_name'];
	      $data['last_name'] = $data['dean_info']['last_name'];
	      $data['password'] = $data['dean_info']['password'];

	      $this->dean_model->compare_password($data);

	      $password = $this->input->post('password');
	      $db_password = $data['password'];

	      
	      if($password == $db_password) 
	      {
	        $newURL = "http://localhost/dean/dean/view_changepassword";
	          header('Location: '.$newURL);
	          $data['password'] = $data['dean_info']['password'];  
	          $data['new_password'] = $this->input->post('new_password');
	          $data['cnew_password'] = $this->input->post('cnew_password');

	          $this->dean_model->changepassword($data);

	        $this->form_validation->set_message('change','<div class="alert-success"><a href="#"" class="close" data-dismiss="alert">&nbsp;&times;</a>
	<strong>Password Updated</strong></div>');
	      return false;
	      } else 

	        $this->form_validation->set_message('change','<div class="alert-error"><a href="#"" class="close" data-dismiss="alert">&nbsp;&times;</a>
	<strong>Invalid current password</strong> </div>');
	      return false;
	    }       

	      public function validate_password() 
	      {
	        $data['dean_info'] = $this->session->userdata('logged_in');
	        $data['username'] = $data['dean_info']['username'];
	        $data['first_name'] = $data['dean_info']['first_name'];
	        $data['last_name'] = $data['dean_info']['last_name'];
	        $data['password'] = $data['dean_info']['password'];

	        $this->dean_model->compare_password($data);

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
		public function classroom()
		{
			$data['deanInfo'] = $this->session->userdata('logged_in');
			if($data['deanInfo'] == TRUE){
				$data['first_name'] = $data['deanInfo']['first_name'];
				$data['last_name'] = $data['deanInfo']['last_name'];

				$this->load->view('seatplan/classroom',$data);	
			} else
				$this->index();
		}

		public function laboratory()
		{
			$data['deanInfo'] = $this->session->userdata('logged_in');
			if($data['deanInfo'] == TRUE){
				$data['first_name'] = $data['deanInfo']['first_name'];
				$data['last_name'] = $data['deanInfo']['last_name'];

				$this->load->view('seatplan/laboratory',$data);	
			} else
				$this->index();
		}

		public function brd1()
		{
			$data['deanInfo'] = $this->session->userdata('logged_in');
			if($data['deanInfo'] == TRUE){
				$data['first_name'] = $data['deanInfo']['first_name'];
				$data['last_name'] = $data['deanInfo']['last_name'];

				$this->load->view('seatplan/brd1',$data);	
			} else 
				$this->index();
		}

		public function brd2()
		{
			$data['deanInfo'] = $this->session->userdata('logged_in');
			if($data['deanInfo'] == TRUE){
				$data['first_name'] = $data['deanInfo']['first_name'];
				$data['last_name'] = $data['deanInfo']['last_name'];

				$this->load->view('seatplan/brd2',$data);	
			} else
				$this->index();
		}


		//Show Calendar
		public function calendar_dean($year=null,$month=null) 
		{
		  $data['deanInfo'] = $this->session->userdata('logged_in');
		  if($data['deanInfo'] == TRUE){
		      $data['first_name'] = $data['deanInfo']['first_name'];
		      $data['last_name'] = $data['deanInfo']['last_name'];
		      $data['event'] = $this->input->post('event');
		      $data['atays'] = $this->dean_model->getEvents();
		      if(isset($_POST['event']))
		      { 
		        $data['result'] = $this->dean_model->addEvents($data);
		      }
		      
		      $data['atay'] = $this->dean_model->showCalendar($year,$month,$events);     
		      $this->load->view('calendar/calendar_dean',$data);
		  } else
		  	$this->index();
		}

		public function logout() 
		{
			   $this->session->unset_userdata('logged_in');
			   session_destroy();
			   $this->index();
	  	}

	}