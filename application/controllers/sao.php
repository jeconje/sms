<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();

	class Sao extends CI_Controller 
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
	    	if($data['info'] == TRUE)
	    	{
		    	$data['account_id'] = $data['info']['account_id'];
				$data['account_type'] = $data['info']['account_type'];

				$data['saoinfo'] = $this->sao_model->saoInfo($data);
				$data['view'] = $this->sao_model->viewPhoto($data);
				$data['image_path'] = $data['view']['image_path'];
				$config['upload_path'] = "./images/others";	
				$this->load->view('sao/home',$data);
			} 
			else
				$this->index();
  		 }

  		//Checks student number if it exista in the 'student' table in DB
    	public function check_student_number()
    	{
    		$student_number = $this->input->post('student_number');
			$student_numbers = $this->sao_model->check_student_numbers($student_number);
				if($student_numbers == 0 && strlen($student_numbers) < 10) { //Checks the inputted student number from database and checks the length
					echo "Invalid";
				} else {
					echo "Valid";
				}
    	} 

    	public function get_student_info() {
    		$data['info'] = $this->session->userdata('logged_in');
    		if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$student_number = $this->input->post('student_number');
				$data['student_info'] = $this->sao_model->get_student_info($student_number);

				$this->load->view('sao/add_violation', $data);
			} else
				$this->index();
    	}

    	public function get_student_info_suspension() {
    		$data['info'] = $this->session->userdata('logged_in');
    		if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$student_number = $this->input->post('student_number');
				$data['student_info'] = $this->sao_model->get_student_info($student_number);

				$this->load->view('sao/suspended', $data);
			} else
				$this->index();
    	}

    	public function get_student_info1() 
    	{
    		$data['info'] = $this->session->userdata('logged_in');
    		if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$data = $this->input->post('student_number');
				$data['student_info'] = $this->sao_model->get_student_info($student_number);

				$this->load->view('sao/suspended', $data);
			} else
				$this->index();
    	}

    	public function add_violation_view() {
    		$data['info'] = $this->session->userdata('logged_in');
    		if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$this->load->view('sao/add_violation', $data);
			} else
				$this->index();
    	}

  		public function add_violation() {
			$this->sao_model->add_violation();

			redirect('sao/add_violation_view','refresh');
		}

		public function suspend_violators() {
			$data['info'] = $this->session->userdata('logged_in');
			$data['id'] = $data['info']['id'];
			$data['student_number'] = $this->input->post('student_number');
			$data['end_date'] = $this->input->post('end_date');
			
    		$this->sao_model->suspend_violators($data);
		    $this->load->view('sao/suspended', 'refresh');
		}

		public function violators(){	
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];		

				$student_number = $this->input->post('student_number');
				$date = $this->input->post('year'). '-' .$this->input->post('months'). '-'. $this->input->post('days');
				$choices = $this->input->post('choices');

				if($choices == 'student_number'){
					$data['violators'] = $this->sao_model->viewViolatorsByStudentNumber($student_number);
				} 
				else if($choices == 'date') {
					$data['violators'] = $this->sao_model->viewViolatorsByDate($date);
				} else
					$data['violators'] = $this->sao_model->view_violators();
					
				$this->load->view('sao/view_violators',$data);
			} else
				$this->index();
		}

		public function removeviolators() {
			$id = $this->input->get('id');

    		$this->sao_model->remove_violators($id);
		    redirect($_SERVER['HTTP_REFERER']);
		}

		public function suspendviolators() 
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE)
			{
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];
				$data['id'] = $data['info']['id'];
				$data['student_number'] = $this->input->post('student_number');
				$data['end_date'] = $this->input->post('end_date');
			
	    		$this->sao_model->suspend_violators($data);
			    $this->load->view('sao/suspended','refresh');
			}
			 else
				$this->index();
		}

		public function message()
		{
			$data['info'] = $this->session->userdata('logged_in');
			if($data['info'] == TRUE){
				$data['first_name'] = $data['info']['first_name'];
				$data['last_name'] = $data['info']['last_name'];

				$this->load->view('sao/message',$data);
			} else
				$this->index();
		}
		
		

		//Change Password
  		public function view_changepassword() 
	    {
	      $data['sao_info'] = $this->session->userdata('logged_in');
	      if($data['sao_info'] == TRUE){
		      $data['username'] = $data['sao_info']['account_id'];
		      $data['first_name'] = $data['sao_info']['first_name'];
		      $data['last_name'] = $data['sao_info']['last_name'];

		      $this->form_validation->set_rules('password','Password','required|trim|callback_change');
		      $this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]');
		      $this->form_validation->set_rules('cnew_password','Confirm Password','required|trim|matches[new_password]');

		      if($this->form_validation->run() == FALSE) 
		      {
		        $this->load->view('sao/change_password', $data);
		      }   
		  } else
		  	$this->index();
	    }

	    public function change() 
	    {
	      $data['sao_info'] = $this->session->userdata('logged_in');
	      $data['username'] = $data['sao_info']['username'];
	      $data['first_name'] = $data['sao_info']['first_name'];
	      $data['last_name'] = $data['sao_info']['last_name'];
	      $data['password'] = $data['sao_info']['password'];

	      $this->sao_model->compare_password($data);

	      $password = $this->input->post('password');
	      $db_password = $data['password'];

	      
	      if($password == $db_password) 
	      {
	        $newURL = "http://localhost/sms/sao/view_changepassword";
	          header('Location: '.$newURL);
	          $data['password'] = $data['sao_info']['password'];  
	          $data['new_password'] = $this->input->post('new_password');
	          $data['cnew_password'] = $this->input->post('cnew_password');

	          $this->sao_model->changepassword($data);

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
	        $data['sao_info'] = $this->session->userdata('logged_in');
	        $data['username'] = $data['sao_info']['username'];
	        $data['first_name'] = $data['sao_info']['first_name'];
	        $data['last_name'] = $data['sao_info']['last_name'];
	        $data['password'] = $data['sao_info']['password'];

	        $this->sao_model->compare_password($data);

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
		public function calendar_sao($year=null,$month=null)
		{
			$data['saoInfo'] = $this->session->userdata('logged_in');
			if($data['saoInfo'] == TRUE)
			{
				$data['first_name'] = $data['saoInfo']['first_name'];
				$data['last_name'] = $data['saoInfo']['last_name'];
				$data['event'] = $this->input->post('event');
				$data['date'] = $this->input->post('date');	
				
				$data['result'] = $this->sao_model->getEvents();

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
			    $config['next_prev_url'] = base_url().'sao/calendar_sao';
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
					
				$this->load->view('calendar/calendar_sao',$data);	

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
