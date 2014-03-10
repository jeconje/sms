<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	session_start();

	class Parents extends CI_Controller 
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


		//VIEWING 
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
				$data['email_address'] = $data['info']['email_address'];
				$data['contact_number'] = $data['info']['contact_number'];
				$data['date_of_birth'] = $data['info']['date_of_birth'];
				$data['address'] = $data['info']['address'];
				$data['view'] = $this->parent_model->viewPhoto($data);
		     	$data['image_path'] = $data['view']['image_path'];

				$data['viewLogs'] = $this->parent_model->viewLogs($data);

				$data['id']	= $_GET['id'];
				$data['result'] = $this->parent_model->displayNames($data);

				$config['upload_path'] = "./images/parents";
	     		$config['allowed_types'] = 'jpg|jpeg|png';
	      		$this->load->library('upload',$config);     		    

	     		if(!$this->upload->do_upload())
	     		{  
	     			$data['error'] = $this->upload->display_errors();
	     			$this->load->view('parent/home',$data);
	     		}
	     		
	     		else
	     		{     	
		     	   	$data['upload'] = $this->upload->data();      		    
		     	   	$data['file_path'] = "../images/parents/";  		    	     		    	
		     	  	$data['file_name'] = $data['upload']['file_name'];     		    	
		     	  	$data['update'] = $this->parent_model->upload($data);

					$this->load->view('parent/home',$data);
				}
			} else
				$this->index();
  		}

  		//Checks referral key if it exista in the 'student' table in DB
    	public function check_referral_key() {
    		$referral_key = $this->input->post('referral_key');
			$referral_keys = $this->parent_model->check_referral_key($referral_key);
				if($referral_keys == 0) { //Checks the inputted referral key from database
					echo "Invalid";
				} else {
					echo "Valid";
				}
    	} 

  		public function parent_registration()
  		{
  			$this->load->view('parent/parent_registration',$data);
  		}

  		public function view_registration_ajax() {
			// field name, error message, validation rules
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('first_name','First Name','trim|required');
			$this->form_validation->set_rules('middle_name','Middle Name','trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('address','Address','trim|required');
			$this->form_validation->set_rules('contact_number','Contact Number','trim|required|numeric');
			$this->form_validation->set_rules('username','Username','trim|required|min_length[6]|is_unique[account.username]');
			$this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
			
			if($this->form_validation->run()) {
				$month = $this->input->post('months');
			    $day = $this->input->post('days');
			    $year = $this->input->post('byear');
	    
	    		$birthday = date("m-d-Y H:i:s",mktime(0,0,0,$month,$day,$year));
 			} 

			if($this->form_validation->run() == FALSE) {
				$this->load->view('parent/parent_registration',$data);
			} else {
				$referral_key = $this->input->post('referral_key');

					$selected_student_account_id = $this->parent_model->get_student_account_id($referral_key);
					$this->parent_model->add_parent($selected_student_account_id);
					redirect('sms','refresh');
				}
		}

		public function message()
		{
			$data['parentInfo'] = $this->session->userdata('logged_in');
			if($data['parentInfo'] == TRUE){
				$data['first_name'] = $data['parentInfo']['first_name'];
				$data['last_name'] = $data['parentInfo']['last_name'];


				$this->load->view('parent/message',$data);
			} else
				$this->index();
		}

		public function viewLogs()
		{
			$data['parentInfo'] = $this->session->userdata('logged_in');
			if($data['parentInfo'] == TRUE){
				$data['account_id'] = $data['parentInfo']['account_id'];
				$data['first_name'] = $data['parentInfo']['first_name'];
				$data['last_name'] = $data['parentInfo']['last_name'];

				$data['logs'] = $this->parent_model->logs($data);
				$this->load->view('parent/viewlogs',$data);
			} else
				$this->index();
		}

		public function viewGrades()
		{
			$data['parentInfo'] = $this->session->userdata('logged_in');
			if($data['parentInfo'] == TRUE){
				$data['first_name'] = $data['parentInfo']['first_name'];
				$data['last_name'] = $data['parentInfo']['last_name'];
				$data['referral_key'] = $data['parentInfo']['referral_key'];
				$data['account_id'] = $data['parentInfo']['account_id'];

				$data['id']	= $_GET['id'];
				$data['result'] = $this->parent_model->displayNames($data);	
				$data['result2'] = $this->parent_model->viewChildrensGrades($data);

				$this->load->view('parent/viewgrades',$data);
			} else
				$this->index();
		}
		
		public function viewStudyload()
		{
			$data['parentInfo'] = $this->session->userdata('logged_in');
			if($data['parentInfo'] == TRUE){
				$data['account_id'] = $data['parentInfo']['account_id'];
				$data['first_name'] = $data['parentInfo']['first_name'];
				$data['last_name'] = $data['parentInfo']['last_name'];

				$data['id']	= $_GET['id'];
				$data['result'] = $this->parent_model->displayNames($data);
				$data['result2'] = $this->parent_model->viewStudyLoad($data);

				$data['info'] = $this->parent_model->viewStudentInfoInSL($data);						
				$data['student_number'] = $data['info']['student_number'];
				$data['course'] = $data['info']['course'];
				$data['year'] = $data['info']['year'];

				$this->load->view('parent/viewstudyload',$data);
			}
		}


		public function viewlasent()
		{
			$data['parentInfo'] = $this->session->userdata('logged_in');
			if($data['parentInfo'] == TRUE){
				$data['account_id'] = $data['parentInfo']['account_id'];
				$data['first_name'] = $data['parentInfo']['first_name'];
				$data['last_name'] = $data['parentInfo']['last_name'];
				$data['id'] = $_GET['id'];

				$data['result'] = $this->parent_model->displayNames($data);
				$data['displaySubjects'] = $this->parent_model->displaySubjects($data);

				$data['info'] = $this->parent_model->viewStudentInfoInSL($data);										
				$data['displayAttendance'] = $this->parent_model->childrensAttendance($data);
				
				$this->load->view('parent/viewlasent',$data);
			} else
				$this->index();
		}

		public function viewAddChild()
		{
			$data['parentInfo'] = $this->session->userdata('logged_in');
			if($data['parentInfo'] == TRUE){
				$data['account_id'] = $data['parentInfo']['account_id'];
				$data['first_name'] = $data['parentInfo']['first_name'];
				$data['last_name'] = $data['parentInfo']['last_name'];
	 
				$data['result'] = $this->parent_model->displayNames($data);
				$data['referral_key'] = $this->input->post('referral_key');
				$data['select_referral_key'] = $this->parent_model->viewAddChild($data);
				$data['id'] = $data['select_referral_key']['account_id'];
				
				if(isset($_POST['submit']))
				{
		  			if($data['referral_key'] == "")
		  			{  				
		  				$this->load->view('parent/addchild',$data);		  						
		  			}
		  			else if($data['select_referral_key'])
					{					
						header("location:profile");
						$this->parent_model->addChild($data);	  																		
		  			}		  			
		  			else
		  			{
		  				echo "";
		  			}
		  		}

		  		else
		  			$this->load->view('parent/addchild',$data);
		  	} else
		  		$this->index();
  			
		}
  		
  		public function edit_profile() 
  		{
			$data['parent_info'] = $this->session->userdata('logged_in');
			if($data['parent_info'] == TRUE){
				$data['first_name'] = $data['parent_info']['first_name'];
				$data['last_name'] = $data['parent_info']['last_name'];

				$data['username'] = $data['parent_info']['username'];
				$data['info'] = $this->parent_model->editProfile($data);
				
				$this->load->view('parent/edit_profile',$data);

				if(isset($_POST['submit'])) 
				{
					$newURL = "http://localhost/sms/parents/edit_profile";
					header('Location: '.$newURL);		
					$data['username'] = $data['parent_info']['username'];
					$data['address'] = $this->input->post('address');
					$data['contact_number'] = $this->input->post('contact_number');
					
					$this->parent_model->updateProfile($data);
				}
			} else
				$this->index();
		}
		
		//Change Password
		 public function view_changepassword() 
	    {
	      $data['parent_info'] = $this->session->userdata('logged_in');
	      if($data['parent_info'] == TRUE){
		      $data['username'] = $data['parent_info']['username'];
		      $data['first_name'] = $data['parent_info']['first_name'];
		      $data['last_name'] = $data['parent_info']['last_name'];

		      $this->form_validation->set_rules('password','Password','required|trim|callback_change');
		      $this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]');
		      $this->form_validation->set_rules('cnew_password','Confirm Password','required|trim|matches[new_password]');

		      if($this->form_validation->run() == FALSE) 
		      {
		        $this->load->view('parent/change_password', $data);
		      }   
		  } else
		  	$this->index();
	    }

	    public function change() 
	    {
	      $data['parent_info'] = $this->session->userdata('logged_in');
	      if($data['logged_in'] == TRUE){
	      $data['username'] = $data['parent_info']['username'];
	      $data['first_name'] = $data['parent_info']['first_name'];
	      $data['last_name'] = $data['parent_info']['last_name'];
	      $data['password'] = $data['parent_info']['password'];

	      $this->parent_model->compare_password($data);

	      $password = $this->input->post('password');
	      $db_password = $data['password'];

	      
	      if($password == $db_password) 
	      {
	          $newURL = "http://localhost/sms/parents/view_changepassword";
	          header('Location: '.$newURL);
	          $data['password'] = $data['parent_info']['password'];  
	          $data['new_password'] = $this->input->post('new_password');
	          $data['cnew_password'] = $this->input->post('cnew_password');

	          $this->parent_model->changepassword($data);

	        $this->form_validation->set_message('change','<div class="alert-success"><a href="#"" class="close" data-dismiss="alert">&nbsp;&times;</a>
	<strong>Password Updated</strong></div>');
	      return false;
	      } else 

	        $this->form_validation->set_message('change','<div class="alert-error"><a href="#"" class="close" data-dismiss="alert">&nbsp;&times;</a>
	<strong>Invalid current password</strong> </div>');
	      return false;
	    }
	    }       

	      public function validate_password() 
	      {
	        $data['parent_info'] = $this->session->userdata('logged_in');
	        $data['username'] = $data['parent_info']['username'];
	        $data['first_name'] = $data['parent_info']['first_name'];
	        $data['last_name'] = $data['parent_info']['last_name'];
	        $data['password'] = $data['parent_info']['password'];

	        $this->parent_model->compare_password($data);

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

		//ShowCalendar
		public function calendarforparents($year = null,$month = null)
		{			
			$data['parentInfo'] = $this->session->userdata('logged_in');
			if($data['logged_in'] == TRUE){
				$data['first_name'] = $data['parentInfo']['first_name'];
				$data['last_name'] = $data['parentInfo']['last_name'];
				$data['event'] = $this->input->post('event');
				$data['atays'] = $this->parent_model->getEvents();
				if(isset($_POST['event']))
				{	
					$data['result'] = $this->parent_model->addEvents($data);
				}
				$data['atay'] = $this->parent_model->showCalendar($year,$month,$events);			
				$this->load->view('calendar/calendarforparents',$data);		
			} else
				$this->index();
			
		}

		//LOGOUT
		public function logout() 
		{
		   $this->session->unset_userdata('logged_in');
		   session_destroy();
		   $this->index();
  		}
  	}