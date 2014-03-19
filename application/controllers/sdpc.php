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
					
				$data['sdpcinfo'] = $this->sdpc_model->sdpcInfo($data);	
				$data['view'] = $this->sdpc_model->viewPhoto($data);
				$data['image_path'] = $data['view']['image_path'];
				$config['upload_path'] = "./images/others";
				$this->load->view('sdpc/home',$data);
			} else
				$this->index();
  		}

		//Change Password
		public function view_changepassword() 
	    {
	      $data['sdpc_info'] = $this->session->userdata('logged_in');
	      if($data['sdpc_info'] == TRUE){
		      $data['username'] = $data['sdpc_info']['account_id'];
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
		//Calendar
		public function calendar_sdpc($year=null,$month=null) 
		{
			$data['sdpcInfo'] = $this->session->userdata('logged_in');
			if($data['sdpcInfo'] == TRUE)
			{
				$data['first_name'] = $data['sdpcInfo']['first_name'];
				$data['last_name'] = $data['sdpcInfo']['last_name'];
				$data['event'] = $this->input->post('event');
				$data['date'] = $this->input->post('date');	
				
				$data['result'] = $this->sdpc_model->getEvents();

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
					$this->sdpc_model->addEvents($data);
					header('Location: http://localhost/sms/sdpc/calendar_sdpc/2014/03');
				}

				$config['show_next_prev'] = 'TRUE';
			    $config['day_type'] = 'long';
			    $config['next_prev_url'] = base_url().'sdpc/calendar_sdpc';
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
					
				$this->load->view('calendar/calendar_sdpc',$data);	

			}
			else
				$this->index();
		}

		//Edit Calendar
  		public function edit_calendar() 
	    {
	      $data['sdpc_info'] = $this->session->userdata('logged_in');
	      if($data['sdpc_info'] == TRUE)
	      {		
		      	$data['first_name'] = $data['sdpc_info']['first_name'];
				$data['last_name'] = $data['sdpc_info']['last_name'];
				$data['info'] = $this->sdpc_model->calendar_details($data);
				$data['months'] = $this->input->post('months');
				$count = count($data['info'] = $this->sdpc_model->calendar_details());	

				if(isset($_POST['submit']))
				{
					$data['info'] = $this->sdpc_model->calendar_details($data);
					$this->load->view('sdpc/edit_calendar', $data);									 				 
				}
				else if(isset($_POST['update']))
				{
					for($i=0; $i <= $count; $i++) 
					{
						 $data['id'] = $_POST['id'.$i];
						 $data['date'] = $_POST['date'.$i];
						 $data['event'] = $_POST['event'.$i];

						 $this->sdpc_model->calendar_update($data);
						 header('Location: http://localhost/sms/sdpc/edit_calendar');
					}	
				}
				else { $this->load->view('sdpc/edit_calendar', $data); }
		   }

			else { $this->index(); }
		}

		public function deleteEvent($id) 
		{
			$id = $_GET['id'];
			$this->sdpc_model->calendar_delete($id);
			redirect($_SERVER['HTTP_REFERER']);
		}


		public function logout() 
		{
			   $this->session->unset_userdata('logged_in');
			   session_destroy();
			   $this->index();
	  	}
}

?>