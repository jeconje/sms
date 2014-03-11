<?php
	session_start();
	class Sdpc extends CI_Controller 
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
				$data['date_of_birth'] = $data['info']['date_of_birth'];
				$data['address'] = $data['info']['address'];		
					
				$data['sdpcinfo'] = $this->sdpc_model->sdpcInfo($data);	
				$data['view'] = $this->sdpc_model->viewPhoto($data);
				$data['image_path'] = $data['view']['image_path'];
				$config['upload_path'] = "./images/others";
				$this->load->view('sdpc/home',$data);
			} else
				$this->index();
  		}

		public function message()
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$this->load->view('sdpc/message',$data);
			} else
				$this->index();
		}

		//Change Password
		public function view_changepassword() 
	    {
	      $data['sdpc_info'] = $this->session->userdata('logged_in');
	      if($data['sdpc_info'] == TRUE){
		      $data['username'] = $data['sdpc_info']['username'];
		      $data['first_name'] = $data['sdpc_info']['first_name'];
		      $data['last_name'] = $data['sdpc_info']['last_name'];

		      $this->form_validation->set_rules('password','Password','required|trim|callback_change');
		      $this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]');
		      $this->form_validation->set_rules('cnew_password','Confirm Password','required|trim|matches[new_password]');

		      if($this->form_validation->run() == FALSE) 
		      {
		        $this->load->view('sdpc/change_password', $data);
		      }   
		   } else
		   	$this->index();
	    }

	    public function change() 
	    {
	      $data['sdpc_info'] = $this->session->userdata('logged_in');
	      $data['username'] = $data['sdpc_info']['username'];
	      $data['first_name'] = $data['sdpc_info']['first_name'];
	      $data['last_name'] = $data['sdpc_info']['last_name'];
	      $data['password'] = $data['sdpc_info']['password'];

	      $this->sdpc_model->compare_password($data);

	      $password = $this->input->post('password');
	      $db_password = $data['password'];

	      
	      if($password == $db_password) 
	      {
	        $newURL = "http://localhost/sms/sdpc/view_changepassword";
	          header('Location: '.$newURL);
	          $data['password'] = $data['sdpc_info']['password'];  
	          $data['new_password'] = $this->input->post('new_password');
	          $data['cnew_password'] = $this->input->post('cnew_password');

	          $this->sdpc_model->changepassword($data);

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
	        $data['sdpc_info'] = $this->session->userdata('logged_in');
	        $data['username'] = $data['sdpc_info']['username'];
	        $data['first_name'] = $data['sdpc_info']['first_name'];
	        $data['last_name'] = $data['sdpc_info']['last_name'];
	        $data['password'] = $data['sdpc_info']['password'];

	        $this->sdpc_model->compare_password($data);

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

		   //Checks student number if it exista in the 'student' table in DB
		  public function check_student_number()
		  {
		    $student_number = $this->input->post('student_number');
		    $student_numbers = $this->sdpc_model->check_student_numbers($student_number);
		    if($student_numbers == 0 && strlen($student_numbers) < 10) { //Checks the inputted student number from database and checks the length
		      echo "Invalid";
		    } else {
		      echo "Valid";
		    }
		  } 

		public function view_candidates() 
		{
			$data['info'] = $this->session->userdata('logged_in');	
			if($data['info'] == TRUE){		
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$data['viewSubjects'] = $this->sdpc_model->viewClasses();
				$data['student_number'] = $this->input->post('student_number');
				$data['viewCandidates'] = $this->sdpc_model->viewCandidates($data);
			
				$this->load->view('sdpc/viewsdpc',$data);
			} else
				$this->index();
		}


		//Show Calendar
		public function calendar_sdpc($year=null,$month=null) 
		{
			$data['sdpcInfo'] = $this->session->userdata('logged_in');
			$data['first_name'] = $data['sdpcInfo']['first_name'];
			$data['last_name'] = $data['sdpcInfo']['last_name'];
			$data['event'] = $this->input->post('event');
			$data['atays'] = $this->sdpc_model->getEvents();
			if(isset($_POST['event']))
			{ 
			$data['result'] = $this->sdpc_model->addEvents($data);
			}
			$data['atay'] = $this->sdpc_model->showCalendar($year,$month,$events);     
			$this->load->view('calendar/calendar_sdpc',$data);
		}

		public function notify() {
			header("Content-Type: text/event-stream");
			header("Cache-Control: no-cache");
			header("Access-Control-Allow-Origin: *");

			$lastEventId = floatval(isset($_SERVER["HTTP_LAST_EVENT_ID"]) ? $_SERVER["HTTP_LAST_EVENT_ID"] : 0);
			if ($lastEventId == 0) {
			$lastEventId = floatval(isset($_GET["lastEventId"]) ? $_GET["lastEventId"] : 0);
			}

			echo ":" . str_repeat(" ", 2048) . "\n"; // 2 kB padding for IE
			echo "retry: 2000\n";
		}
		
		public function notification_of_parent() {
			$this->notify();

			$data['notify'] = $this->sdpc_model->notification_parent($data);
		
			echo "data: ".json_encode($data['notify'])."\n\n";
			ob_flush(1);
			flush();
			sleep(1);
		}

		public function notfication_update_parent() {
			$data['parent_id'] = $this->session->userdata('logged_in');
			$data['id_for_update'] = $_POST['notification_id'];

			$data['new_notification'] = $this->sdpc_model->notification_update_parent($data);

			echo json_encode($data['new_notification']);
		}


		public function logout() 
		{
			   $this->session->unset_userdata('logged_in');
			   session_destroy();
			   $this->index();
	  	}
}

?>