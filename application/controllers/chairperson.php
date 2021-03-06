<?php
	session_start();
	class Chairperson extends CI_Controller 
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
				$data['email_address'] = $data['info']['email_address'];
				$data['contact_number'] = $data['info']['contact_number'];
				$data['date_of_birth'] = $data['info']['date_of_birth'];
				$data['address'] = $data['info']['address'];
				$data['department_id'] = $data['info']['department_id'];

				$data['faculty_id'] = $data['info']['faculty_id'];
				$data['chairpersoninfo'] = $this->chairperson_model->chairpersonInfo($data);

				//Get college
				$data['college_id'] = $data['info']['college_id'];
				$data['collegeinfo'] = $this->teacher_model->get_college($data);
				
				//Upload Photo
				$data['view'] = $this->chairperson_model->viewPhoto($data);
				$data['image_path'] = $data['view']['image_path'];
				$config['upload_path'] = "./images/faculty";
	     		$config['allowed_types'] = 'jpg|jpeg|png';
	      		$this->load->library('upload',$config);     		    

	     		if(!$this->upload->do_upload())
	     		{  
	     			$data['error'] = $this->upload->display_errors();
	     			$this->load->view('chairperson/home',$data);
	     		}
	     		
	     		else
	     		{     	
		     	   	$data['upload'] = $this->upload->data();      		    
		     	   	$data['file_path'] = "../images/faculty/";  		    	     		    	
		     	  	$data['file_name'] = $data['upload']['file_name'];     		    	
		     	  	$data['update'] = $this->chairperson_model->upload($data);
		     	  	
					$this->load->view('chairperson/home',$data);
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

				$data['viewSubjects'] = $this->chairperson_model->viewSDPC($data);
				$data['viewCandidates'] = $this->chairperson_model->viewCandidates($data);

				$this->load->view('chairperson/viewsdpc',$data);
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

				$data['classes'] = $this->chairperson_model->viewClasses($data);

				$this->load->view('chairperson/attendance',$data);
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

				$data['classes'] = $this->chairperson_model->viewClasses($data);

				$this->load->view('chairperson/logs',$data);
			} else
				$this->index();
		}

		public function message()
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$this->load->view('chairperson/message',$data);
			} else
				$this->index();
		}

		public function edit_profile() 
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$data['username'] = $data['info']['username'];
				$data['chairpersoninfo'] = $this->chairperson_model->editProfile($data);

				//Get college
				$data['college_id'] = $data['info']['college_id'];
				$data['collegeinfo'] = $this->teacher_model->get_college($data);
				
				$this->load->view('chairperson/edit_profile',$data);

				if(isset($_POST['submit'])) 
				{
					$newURL = "http://localhost/sms/chairperson/edit_profile";
					header('Location: '.$newURL);		
					$data['username'] = $data['info']['username'];
					$data['address'] = $this->input->post('address');
					$data['contact_number'] = $this->input->post('contact_number');
					
					$this->chairperson_model->edit_profile($data);
				}
			}
			else
					$this->index();
		}
		
		//Change Password
	 	public function view_changepassword() 
	    {
	      $data['chairperson_info'] = $this->session->userdata('logged_in');
	      if($data['chairperson_info'] == TRUE){
		      $data['username'] = $data['chairperson_info']['username'];
		      $data['first_name'] = $data['chairperson_info']['first_name'];
		      $data['last_name'] = $data['chairperson_info']['last_name'];

		      $this->form_validation->set_rules('password','Password','required|trim|callback_change');
		      $this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]');
		      $this->form_validation->set_rules('cnew_password','Confirm Password','required|trim|matches[new_password]');

		      if($this->form_validation->run() == FALSE) 
		      {
		        $this->load->view('chairperson/change_password', $data);
		      }   
		  }
		  else
		  	$this->index();
	    }

	    public function change() 
	    {
	      $data['chairperson_info'] = $this->session->userdata('logged_in');
	      $data['username'] = $data['chairperson_info']['username'];
	      $data['first_name'] = $data['chairperson_info']['first_name'];
	      $data['last_name'] = $data['chairperson_info']['last_name'];
	      $data['password'] = $data['chairperson_info']['password'];

	      $this->chairperson_model->compare_password($data);

	      $password = $this->input->post('password');
	      $db_password = $data['password'];

	      
	      if($password == $db_password) 
	      {
	        $newURL = "http://localhost/sms/chairperson/view_changepassword";
	          header('Location: '.$newURL);
	          $data['password'] = $data['chairperson_info']['password'];  
	          $data['new_password'] = $this->input->post('new_password');
	          $data['cnew_password'] = $this->input->post('cnew_password');

	          $this->chairperson_model->changepassword($data);

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
	        $data['chairperson_info'] = $this->session->userdata('logged_in');
	        $data['username'] = $data['chairperson_info']['username'];
	        $data['first_name'] = $data['chairperson_info']['first_name'];
	        $data['last_name'] = $data['chairperson_info']['last_name'];
	        $data['password'] = $data['chairperson_info']['password'];

	        $this->chairperson_model->compare_password($data);

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
		public function classroom($id)
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['viewAttendance'] = $this->chairperson_model->viewAttendance($data);				
				$data['logins'] = $this->chairperson_model->viewCampusLogin($data);
				$data['violation'] = $this->chairperson_model->viewViolation($data);	
				$data['suspension'] = $this->chairperson_model->viewSuspension($data);

				
				for ($i=1; $i <41 ; $i++) { 
					$data['a'.$i] = $this->input->post('attendance'.$i);		
				}

				for ($i=1; $i <41 ; $i++) { 
				$data['student_number'.$i] = $this->input->post('student_number'.$i);	
				}						
							
				if(isset($_POST['submit']))
				{								
					$this->chairperson_model->insertAttendance($data);
					header('Location:http://localhost/sms/chairperson/classroom/'.$data['id_code']);							
				}

				$data['viewStudents'] = $this->chairperson_model->viewStudents($data);
				$this->load->view('seatplan_chairperson/classroom',$data);	
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
				$data['viewStudents'] = $this->chairperson_model->viewStudents($data);
				$data['assigned_seats'] = $this->chairperson_model->viewAssignedStudents($data);
				for ($i=1; $i < 41 ; $i++) { 
				$data['a'.$i] = $this->input->post(''.$i);
				}					
				

				if(isset($_POST['submit'])){			
					$this->chairperson_model->updateSeat($data);
					header('Location:http://localhost/sms/chairperson/assign_classroom/'.$data['id_code']);
				}
				else					
					$this->load->view('seatplan_chairperson/assign_classroom',$data);
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
				$data['viewAttendance'] = $this->chairperson_model->viewAttendance($data);				
				$data['logins'] = $this->chairperson_model->viewCampusLogin($data);
				$data['violation'] = $this->chairperson_model->viewViolation($data);		
				$data['suspension'] = $this->chairperson_model->viewSuspension($data);


				for ($i=1; $i <49 ; $i++) { 
					$data['a'.$i] = $this->input->post('attendance'.$i);		
				}

				for ($i=1; $i <49 ; $i++) { 
				$data['student_number'.$i] = $this->input->post('student_number'.$i);	
				}						
							
				if(isset($_POST['submit']))
				{								
					$this->chairperson_model->insertAttendance($data);
					header('Location:http://localhost/sms/chairperson/laboratory/'.$data['id_code']);							
				}

				$data['viewStudents'] = $this->chairperson_model->viewStudents($data);
				$this->load->view('seatplan_chairperson/laboratory',$data);		
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
				$data['viewStudents'] = $this->chairperson_model->viewStudents($data);
				$data['assigned_seats'] = $this->chairperson_model->viewAssignedStudents($data);		
				
				for ($i=1; $i < 41 ; $i++) { 
					$data['a'.$i] = $this->input->post($i);
				}					
				
				if(isset($_POST['submit'])) {		

					if(!in_array($data['a'.$i], $data['assigned_seats'])) {
						$this->chairperson_model->updateSeat($data);
						header('Location:http://localhost/sms/chairperson/assign_laboratory/'.$data['id_code']);
						
					} else {
						echo "Not allowed.";
					}
					
				}
				else {
					$this->load->view('seatplan_chairperson/assign_laboratory',$data);
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
				$data['viewStudents'] = $this->chairperson_model->viewStudents($data);
				$data['viewAttendance'] = $this->chairperson_model->viewAttendance($data);				
			
				for ($i=1; $i < 49 ; $i++) { 
					$data['a'.$i] = $this->input->post('attendance'.$i);		
				}
				for ($i=1; $i < 49 ; $i++) { 
				$data['student_number'.$i] = $this->input->post('student_number'.$i);	
				}								
											
				if(isset($_POST['submit']))
				{								
					$this->chairperson_model->insertAttendance($data);		
					header('Location:http://localhost/sms/chairperson/brd2/'.$data['id_code']);					
				}				
				$this->load->view('seatplan_chairperson/brd2',$data);		
			} else 
				$this->index();	
	    }	

		public function assign_brd1($id)
		{
			
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['viewStudents'] = $this->chairperson_model->viewStudents($data);
				$data['assigned_seats'] = $this->chairperson_model->viewAssignedStudents($data);
				
				for ($i=1; $i < 49 ; $i++) { 
				$data['a'.$i] = $this->input->post($i);
				}	
				
				if(isset($_POST['submit'])){			
				$this->chairperson_model->updateSeat($data);				
				header('Location:http://localhost/sms/chairperson/assign_brd1/'.$data['id_code']);
				} 
				else				
				$this->load->view('seatplan_chairperson/assign_brd1',$data);

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
				$data['viewStudents'] = $this->chairperson_model->viewStudents($data);
				$data['viewAttendance'] = $this->chairperson_model->viewAttendance($data);		
				$data['suspension'] = $this->chairperson_model->viewSuspension($data);		
			
				for ($i=1; $i < 32 ; $i++) { 
					$data['a'.$i] = $this->input->post('attendance'.$i);		
				}
				for ($i=1; $i < 32 ; $i++) { 
				$data['student_number'.$i] = $this->input->post('student_number'.$i);	
				}								
											
				if(isset($_POST['submit']))
				{								
					$this->chairperson_model->insertAttendance($data);		
					header('Location:http://localhost/sms/chairperson/brd2/'.$data['id_code']);					
				}				
				$this->load->view('seatplan_chairperson/brd2',$data);		
			} else 
				$this->index();	
	    }	

		public function assign_brd2($id)
		{
			
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['id_code'] = $id;
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];			
				$data['viewStudents'] = $this->chairperson_model->viewStudents($data);
				$data['assigned_seats'] = $this->chairperson_model->viewAssignedStudents($data);


				for ($i=1; $i < 41 ; $i++) { 
				$data['a'.$i] = $this->input->post(''.$i);
				}					
				
				if(isset($_POST['submit'])){			
				$this->chairperson_model->updateSeat($data);
				header('Location:http://localhost/sms/chairperson/assign_brd2/'.$data['id_code']);
				}
				else

				$this->load->view('seatplan_chairperson/assign_brd2',$data);
			} else
				$this->index();
		}



		//Show Calendar
		//Calendar
		public function calendar_chairperson($year=null,$month=null) 
		{
			$data['chairpersonInfo'] = $this->session->userdata('logged_in');
			if($data['chairpersonInfo'] == TRUE)
			{
				$data['first_name'] = $data['chairpersonInfo']['first_name'];
				$data['last_name'] = $data['chairpersonInfo']['last_name'];
				$data['event'] = $this->input->post('event');
				$data['date'] = $this->input->post('date');	
				
				$data['result'] = $this->chairperson_model->getEvents();

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

				if(isset($_POST['add']))
				{	
					$this->chairperson_model->addEvents($data);
					header('Location: http://localhost/sms/chairperson/calendar_chairperson/2014/03');
				}

				$config['show_next_prev'] = 'TRUE';
			    $config['day_type'] = 'long';
			    $config['next_prev_url'] = base_url().'chairperson/calendar_chairperson';
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
					
				$this->load->view('calendar/calendar_chairperson',$data);

			}
			else
				$this->index();
		}

		//Edit Calendar
  		public function edit_calendar() 
	    {
	      $data['chairperson_info'] = $this->session->userdata('logged_in');
	      if($data['chairperson_info'] == TRUE)
	      {		
		      	$data['first_name'] = $data['chairperson_info']['first_name'];
				$data['last_name'] = $data['chairperson_info']['last_name'];
				$data['info'] = $this->chairperson_model->calendar_details($data);
				$data['months'] = $this->input->post('months');
				$count = count($data['info'] = $this->chairperson_model->calendar_details());	

				if(isset($_POST['submit']))
				{
					$data['info'] = $this->chairperson_model->calendar_details($data);
					$this->load->view('chairperson/edit_calendar', $data);									 				 
				}
				else if(isset($_POST['update']))
				{
					for($i=0; $i <= $count; $i++) 
					{
						 $data['id'] = $_POST['id'.$i];
						 $data['date'] = $_POST['date'.$i];
						 $data['event'] = $_POST['event'.$i];

						 $this->chairperson_model->calendar_update($data);
						 header('Location: http://localhost/sms/chairperson/edit_calendar');
					}	
				}
				else { $this->load->view('chairperson/edit_calendar', $data); }
		   }

		    else{
		      		$this->index();
		    }
		}

		public function deleteEvent($id) {
			$id = $_GET['id'];
			$this->chairperson_model->calendar_delete($id);
			redirect($_SERVER['HTTP_REFERER']);
		}


		public function logout() 
		{
			   $this->session->unset_userdata('logged_in');
			   session_destroy();
			   $this->index();
	  	}

	}