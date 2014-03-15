<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	session_start();

	class Sms extends CI_Controller 
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

		//Checks student number if it exista in the 'student' table in DB
    	public function check_student_number()
    	{
    		$student_number = $this->input->post('student_number');
			$student_numbers = $this->sms_model->check_student_numbers($student_number);
				if($student_numbers == 0 && strlen($student_numbers) < 10) { //Checks the inputted student number from database and checks the length
					echo "Invalid";
				} else {
					echo "Valid";
				}
    	} 

    	public function check_username() {
    		$username = $this->input->post('username');
    		$usernames = $this->sms_model->check_usernames($username);
    			if($usernames == 0 && strlen($username) > 5) { //Checks the inputted number from database and checks the length
    				echo "Valid";
    			} else {
    				echo "Invalid";
    			}
    	}

    	public function validate_password() 
    	{
    		$data['student_info'] = $this->session->userdata('logged_in');
			$data['username'] = $data['student_info']['username'];
			$data['first_name'] = $data['student_info']['first_name'];
			$data['last_name'] = $data['student_info']['last_name'];
			$data['password'] = $data['student_info']['password'];

			$this->sms_model->compare_password($data);

			$password = $this->input->post('password');
			$db_password = $data['password'];
    		$password = $this->input->post('password');

				if(strlen($password) > 5 &&  $db_password == $password) { //Checks the length of the password
					echo "Valid";
				} else {
					echo "Invalid";
				}
    	}

    	public function check_passwordlength() {
    		$password = $this->input->post('password');

    		if(strlen($password) > 5) {
    			echo "Valid";
    		} else {
    			echo "Invalid";
    		}
    	}

    	public function check_newpasswordlength() {
    		$new_password = $this->input->post('new_password');

    		if(strlen($new_password) > 5) {
    			echo "Valid";
    		} else {
    			echo "Invalid";
    		}
    	}

  		// Student Registration View
		public function registration() {
			$this->load->view('student/student_registration',$data);
		}

		public function view_registration_ajax() {
			$combinedate = $this->input->post('byear').'-'.$this->input->post('months').'-'.$this->input->post('days');
        	$date = date("Y-m-d", strtotime($combinedate));

			if ($_POST) {
				// field name, error message, validation rules
				$this->form_validation->set_rules('last_name','Last Name','trim|required');
				$this->form_validation->set_rules('first_name','First Name','trim|required');
				$this->form_validation->set_rules('middle_name','Middle Name','trim|required');
				$this->form_validation->set_rules('gender', 'Gender', 'required');
				$this->form_validation->set_rules('address','Address','trim|required');
				$this->form_validation->set_rules('contact_number','Contact Number','trim|required|numeric');
				$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
				$this->form_validation->set_rules('parent_email', 'Parent Email Address', 'trim|required|valid_email');
				$this->form_validation->set_rules('username','Username','trim|required|min_length[6]|is_unique[account.username]');
				$this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
				$this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[password]');
				
				if($this->form_validation->run()) {
					$month = $this->input->post('months');
				    $day = $this->input->post('days');
				    $year = $this->input->post('byear');
		    
		    		$birthday = date("m-d-Y H:i:s",mktime(0,0,0,$month,$day,$year));
	 			} 

				if($this->form_validation->run() == FALSE) {
					$this->load->view('student/student_registration',$data);
				} else {
					$data['student_number'] = $this->input->post('student_number');
					$data['first_name'] = strtoupper($this->input->post('first_name'));
					$data['middle_name'] = strtoupper($this->input->post('middle_name'));
					$data['last_name'] = strtoupper($this->input->post('last_name'));
					$data['date_of_birth'] = $date;

					$this->sms_model->add_student($data);

					$config = Array (
					        		'protocol' => 'smtp',
					        		'smtp_host' => 'ssl://smtp.googlemail.com',
					        		'smtp_port' => 465,
					        		'smtp_user' => 'usjrsms@gmail.com', // sa hostinger nga add, pero okay ra dri sa localhost
					        		'smtp_pass' => 'adminteam@3', // sa hostinger pud ni
					        		'mailtype' => 'html',
									);

						$data['parent_email'] = $this->input->post('parent_email');
						$data['referral_key'] = $this->sms_model->emails($data);

					$this->load->library('email',$config);

					$message = '
								Good day!
								<br>
								<br>
								This is to verify if '.$data['first_name'].' '. ' '.$data['middle_name'].' '. ' '.$data['last_name'].' is your child.
								<br>
								<br>
								To continue your registration. Please copy the referral code below. <br>
								  Your referral code: <b>'.$data['referral_key']['referral_key']. ' '. '</b><br>
								  <br>
								  <br>

								Click this link to redirect you to your registration http://localhost/sms/parents/parent_registration
								<br>
								<br>

								Thank you,
								<br>
								SMS Team :)';
					
					$this->email->set_newLine("\r\n");
					$this->email->from('usjrsms@gmail.com', 'SMS Management Team'); 
					$this->email->to($data['parent_email']);
					$this->email->subject('Verification');
					$this->email->message($message);			    
			
					if ($this->email->send()) {
						$data['sent'] = 1;
						redirect('sms/index');
					} else {
						show_error($this->email->print_debugger());
					}
  				}
  			}
  			else
  				$this->load->view('student/student_registration');
}

		// View Student Profile
		public function profile() 
		{
	    	$data['info'] = $this->session->userdata('logged_in'); 
	    	if($data['info'] == TRUE) {	
		    	$data['account_id'] = $data['info']['account_id'];	    	
				$data['account_type'] = $data['info']['account_type'];
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['middle_name'] = $data['info']['middle_name'];			
				$data['gender'] = $data['info']['gender'];
				$data['contact_number'] = $data['info']['contact_number'];
				$data['date_of_birth'] = $data['info']['date_of_birth'];
				$data['address'] = $data['info']['address'];		
				$data['email_address'] = $data['info']['email_address'];	
				$data['referral_key'] = $data['info']['referral_key'];     	
				
				//Study Load 
				$data['studentinfo'] = $this->sms_model->studentInfo($data);	
				$data['student_number'] = $data['studentinfo']['student_number'];
				$data['college'] = $data['studentinfo']['college'];
				$data['course'] = $data['studentinfo']['course'];
				$data['year'] = $data['studentinfo']['year'];
				$data['viewStudyLoad'] = $this->sms_model->viewstudyload($data);
				//$this->load->view('student/home',$data);

				$data['logs'] = $this->sms_model->logs($data); //gi add na nga model sa profile sa student

				//Upload Photo
				$data['view'] = $this->sms_model->viewPhoto($data);
				$data['image_path'] = $data['view']['image_path'];
				$config['upload_path'] = "./images/students";
		 		$config['allowed_types'] = 'jpg|jpeg|png';
		  		$this->load->library('upload',$config);     		    

		 		if(!$this->upload->do_upload())
		 		{  
		 			$data['error'] = $this->upload->display_errors();
		 			$this->load->view('student/home',$data);
		 		}
     		
	     		else
	     		{     	
		     	   	$data['upload'] = $this->upload->data();      		    
		     	   	$data['file_path'] = "../images/students/";  		    	     		    	
		     	  	$data['file_name'] = $data['upload']['file_name'];     		    	
		     	  	$data['update'] = $this->sms_model->upload($data);
		     	  	
					$this->load->view('student/home',$data);
				}
			} else
				$this->index();
  		}

/*		//Get course with specified college
		public function get_courses() 
		{
			$college = $this->input->post('college');
			$i = 0;
			$courses = $this->sms_model->get_course($college);
			foreach ($courses as $course) {
				$value[$i]['id'] = $course->course_id;
				$value[$i]['c_name'] = $course->course_name;
				$i++;
			}
			echo json_encode($value);
    	}
*/
    	//View Student's Grades
		public function viewGrades()
		{
			$data['studentInfo'] = $this->session->userdata('logged_in');
			if($data['studentInfo'] == TRUE) {	
				$data['student_number'] = $data['studentInfo']['student_number'];
				$data['first_name'] = $data['studentInfo']['first_name'];
				$data['last_name'] = $data['studentInfo']['last_name'];

				$data['info'] = $this->sms_model->viewgrades($data);
				$this->load->view('student/viewgrades',$data);
			}
			else
				$this->index();
		}
		
		//View Student's StudyLoad
		public function viewstudyload() 
		{
			$data['studentinfo'] = $this->session->userdata('logged_in');
			if($data['studentinfo'] == TRUE) {	
				$data['student_number'] = $data['studentinfo']['student_number'];
				$data['course'] = $data['studentinfo']['course'];
				$data['year'] = $data['studentinfo']['year'];
				$data['first_name'] = $data['studentinfo']['first_name'];
				$data['last_name'] = $data['studentinfo']['last_name'];

				$data['studentInfo'] = $this->sms_model->viewstudyload($data);
				$this->load->view('student/viewstudyload', $data);
			} else 
				$this->index();
		}

		//View Followers
		public function viewParents() 
		{
			$data['studentinfo'] = $this->session->userdata('logged_in'); 
			if($data['studentinfo'] == TRUE) {	
				
				$data['student_number'] = $data['studentinfo']['student_number'];
				$data['account_id'] = $data['studentinfo']['account_id'];			
				$data['first_name'] = $data['studentinfo']['first_name'];
				$data['last_name'] = $data['studentinfo']['last_name'];
						
				$data['info'] = $this->sms_model->viewParents($data);

				$this->load->view('student/viewdependent',$data);
			} else
				$this->index();
		}

		//View Lates and Absences
		public function viewlasent() 
		{			
			$data['studentinfo'] = $this->session->userdata('logged_in');
				if($data['studentinfo'] == TRUE) {	
				$data['student_number'] = $data['studentinfo']['student_number'];
				$data['account_id'] = $data['studentinfo']['account_id'];
				$data['first_name'] = $data['studentinfo']['first_name'];
				$data['last_name'] = $data['studentinfo']['last_name'];	

				$data['info'] = $this->sms_model->viewsubjects($data);		
				$data['lates'] = $this->sms_model->viewLates($data);

				$this->load->view('student/viewlasent',$data);
			} else
				$this->index();
		}

		//View All Logs
		public function viewlogs()
		{
			$data['studentinfo'] = $this->session->userdata('logged_in');
			if($data['studentinfo'] == TRUE) 
			{	
				$data['student_number'] = $data['studentinfo']['student_number'];
				$data['first_name'] = $data['studentinfo']['first_name'];
				$data['last_name'] = $data['studentinfo']['last_name'];
				$data['count'] =$this->sms_model->count($data);
				
				$this->load->library('pagination');				
				$config['base_url'] = base_url() . "sms/viewLogs";
				$config['total_rows'] = $data['count'];
				$data['limit'] = $config['per_page'] = 10; 
				$data['start'] = $this->uri->segment(3);		
				$this->pagination->initialize($config); 
				$data['viewLogs'] = $this->sms_model->viewLogs($data);	
				
				$data['pagination'] = $this->pagination->create_links();
				
				//$data["links"] = $this->pagination->create_links();

				$this->load->view('student/viewlogs',$data);

			} 
			else
				$this->index();

		}


		//View log details (Date of Absences and lates per subject)
		public function attendance_logs() 
		{
			$data['studentinfo'] = $this->session->userdata('logged_in'); 
			if($data['studentinfo'] == TRUE) 
			{	
				$data['student_number'] = $data['studentinfo']['student_number'];
				$data['first_name'] = $data['studentinfo']['first_name'];
				$data['last_name'] = $data['studentinfo']['last_name'];
				$data['offer_code_id'] = $_GET['id'];

				//$data['offer_code'] = hash('sha256',$_GET['id']);
				$data['viewLogs'] = $this->sms_model->viewAttendanceLogs($data);
				$this->load->view('student/attendance_logs',$data);
			} 
			else
				$this->index();
		}

		//View Messages
		public function message() 
		{
			$data['studentinfo'] = $this->session->userdata('logged_in'); 
			if($data['studentinfo'] == TRUE) {	
				$data['student_number'] = $data['studentinfo']['student_number'];
				$data['first_name'] = $data['studentinfo']['first_name'];
				$data['last_name'] = $data['studentinfo']['last_name'];
				$this->load->view('student/message',$data);
			} else
				$this->index();
		}

    	//View Edit Profile and update it
 		public function viewProfile() 
 		{
			$data['student_info'] = $this->session->userdata('logged_in');
			if($data['student_info'] == TRUE) {	
				$data['username'] = $data['student_info']['username'];
				
				$data['info'] = $this->sms_model->viewProfile($data);

				$this->load->view('student/view_profile',$data);

				if(isset($_POST['submit'])) 
				{
					$newURL = "http://localhost/sms/sms/viewprofile";
					header('Location: '.$newURL);		
					$data['username'] = $data['student_info']['username'];
					$data['address'] = $this->input->post('address');
					$data['contact_number'] = $this->input->post('contact_number');
					$this->sms_model->editProfile($data);
				}
			}
			else
				$this->index();
		}


		//Change Password
		public function view_changepassword() 
		{
			$data['student_info'] = $this->session->userdata('logged_in');
			if($data['student_info'] == TRUE) {	
				$data['username'] = $data['student_info']['username'];
				$data['first_name'] = $data['student_info']['first_name'];
				$data['last_name'] = $data['student_info']['last_name'];

				$this->form_validation->set_rules('password','Password','required|trim|callback_change');
				$this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]');
				$this->form_validation->set_rules('cnew_password','Confirm Password','required|trim|matches[new_password]');

				if($this->form_validation->run() == FALSE) 
				{
					$this->load->view('student/change_password', $data);
				}		
			}
			else
				$this->index();
		}

		public function change() 
		{
			$data['student_info'] = $this->session->userdata('logged_in');
			if($data['student_info'] == TRUE) {	
				$data['username'] = $data['student_info']['username'];
				$data['first_name'] = $data['student_info']['first_name'];
				$data['last_name'] = $data['student_info']['last_name'];
				$data['password'] = $data['student_info']['password'];

				$this->sms_model->compare_password($data);

				$password = $this->input->post('password');
				$db_password = $data['password'];

				
				if($password == $db_password) 
				{
					$newURL = "http://localhost/sms/sms/view_changepassword";
						header('Location: '.$newURL);
						$data['password'] = $data['student_info']['password'];	
						$data['new_password'] = $this->input->post('new_password');
						$data['cnew_password'] = $this->input->post('cnew_password');

						$this->sms_model->changepassword($data);

					$this->form_validation->set_message('change','<div class="alert-success"><a href="#"" class="close" data-dismiss="alert">&nbsp;&times;</a>
	<strong>Password Updated</strong></div>');
				return false;
				} else 

					$this->form_validation->set_message('change','<div class="alert-error"><a href="#"" class="close" data-dismiss="alert">&nbsp;&times;</a>
	<strong>Invalid current password</strong> </div>');
				return false;
			}
			else
				$this->index();
		}	

		//View Calendar
		public function calendarforstudent($year=null,$month=null) 
		{
			$data['studentInfo'] = $this->session->userdata('logged_in');
			if($data['studentInfo'] == TRUE)
			{
				$data['first_name'] = $data['studentInfo']['first_name'];
				$data['last_name'] = $data['studentInfo']['last_name'];
				$data['event'] = $this->input->post('event');
				$data['date'] = $this->input->post('date');	
				
				$data['result'] = $this->sms_model->getEvents();

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
			    $config['next_prev_url'] = base_url().'sms/calendarforstudent';
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
					
				$this->load->view('calendar/calendarforstudent',$data);	

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