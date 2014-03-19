<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();

	class Admin extends CI_Controller 
	{
		public function __construct()  {
			error_reporting(0);
			parent::__construct();
		}

		public function index() {
			$data['logged_in'] = $this->session->userdata('logged_in');
			if($data['logged_in'] == TRUE){
				$this->profile();
			} else
				$this->load->view('pages/signin');
		} 

		//View Admin Information
		public function profile() {
    	$data['info'] = $this->session->userdata('logged_in'); 
    	if($data['info'] == TRUE) {	
    		$data['account_id'] = $data['info']['account_id'];
    		$data['account_type'] = $data['info']['account_type'];

			$data['admininfo'] = $this->admin_model->adminInfo($data);
			$data['view'] = $this->admin_model->viewPhoto($data);
			$data['image_path'] = $data['view']['image_path'];
			$config['upload_path'] = "./images/others";
			
			$this->load->view('admin/home',$data);
		}
		else
			$this->index();
		}

		public function checkFaculty() {
			$data['faculty_id'] = $_POST['faculty_id'];
			$data['details'] = $this->admin_model->checkFaculty($data);

			$this->load->view('admin/add_account', $data);
		}

  		//View Add an account (Teacher, Chairperson, Dean)
  		public function add_account()
  		{	
  			$data['info'] = $this->session->userdata('logged_in');
  			if($data['info'] == TRUE){	

	  			$combinedate = $this->input->post('byear').'-'.$this->input->post('months').'-'.$this->input->post('days');
	        	$date = date("Y-m-d", strtotime($combinedate));

	  			if ($_POST) {
						$this->form_validation->set_rules('username','Username','trim|required|min_length[6]|is_unique[account.account_id]');
						$this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
						$this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[password]');
					
					if($this->form_validation->run()) {
						$month = $this->input->post('months');
					    $day = $this->input->post('days');
					    $year = $this->input->post('byear');
			    
			    		$birthday = date("m-d-Y H:i:s",mktime(0,0,0,$month,$day,$year));
		 			} 

					if($this->form_validation->run() == FALSE) {
						$this->load->view('admin/add_account',$data);
					} else {
							$data['faculty_id'] = $_POST['faculty_id'];
							$data['facultyDetails'] = $this->sms_model->viewStudentDetails($data);
	  			
			  			$this->admin_model->addAccount($data);

		  				redirect('admin/profile');
		  			}
		  		} else 
		  			$this->load->view('admin/add_account', $data);
		  		}
		  		else
		  			$this->index();
  		}

  		//Checks id number if it exist in the students/faculty table
    	public function check_id_number() {
    		$check_id_number = $this->input->post('faculty_id');

				$check_id_numbers = $this->admin_model->check_id_numbers($check_id_number);

				if($check_id_numbers == 1 && strlen($check_id_number) <= 10) { //Checks the inputted student number from database and checks the length
					echo "Invalid";
				} else {
					echo "Valid";
				}
    	} 

    	public function verify_faculty_id() {
    		$faculty_id = $this->input->post('faculty_id');
    		$verify_faculty_id = $this->admin_model->verify_faculty_id($faculty_id);

    		if($verify_faculty_id == TRUE) { //Checks the inputted student number from database and checks the length
				echo "Valid";
			} else {
				echo "Invalid";
			}
    	}

    	//Checks the username if it already exist and length must be 6 and above
    	public function check_username() {
    		$username = $this->input->post('username');
    		$usernames = $this->admin_model->check_usernames($username);
    			if($usernames == 0 && strlen($username) > 5) { //Checks the inputted number from database and checks the length
    				echo "Valid";
    			} else {
    				echo "Invalid";
    			}
    	}

		
		//Change Password
  		public function view_changepassword() 
	    {
	      $data['admin_info'] = $this->session->userdata('logged_in');
	      	if($data['admin_info'] == TRUE){
				$data['username'] = $data['admin_info']['username'];
				$data['first_name'] = $data['admin_info']['first_name'];
				$data['last_name'] = $data['admin_info']['last_name'];

				$this->form_validation->set_rules('password','Password','required|trim|callback_change');
				$this->form_validation->set_rules('new_password','New Password','required|trim|min_length[6]');
				$this->form_validation->set_rules('cnew_password','Confirm Password','required|trim|matches[new_password]');

				if($this->form_validation->run() == FALSE) 
				{
					$this->load->view('admin/change_password', $data);
				}   
		    else
		      	$this->index();
		    }
		}

	    public function change() 
	    {
	      $data['admin_info'] = $this->session->userdata('logged_in');
	      if($data['admin_info'] == TRUE){
		      $data['username'] = $data['admin_info']['username'];
		      $data['first_name'] = $data['admin_info']['first_name'];
		      $data['last_name'] = $data['admin_info']['last_name'];
		      $data['password'] = $data['admin_info']['password'];

		      $this->admin_model->compare_password($data);

		      $password = $this->input->post('password');
		      $db_password = $data['password'];

		      
		      if($password == $db_password) 
		      {
		        $newURL = "http://localhost/sms/admin/view_changepassword";
		          header('Location: '.$newURL);
		          $data['password'] = $data['admin_info']['password'];  
		          $data['new_password'] = $this->input->post('new_password');
		          $data['cnew_password'] = $this->input->post('cnew_password');

		          $this->admin_model->changepassword($data);

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

	      public function validate_password() 
	      {
	        $data['admin_info'] = $this->session->userdata('logged_in');
	        $data['first_name'] = $data['admin_info']['first_name'];
	        $data['last_name'] = $data['admin_info']['last_name'];
	        $data['username'] = $data['admin_info']['username'];

	        $this->admin_model->compare_password($data);

	        $password = $this->input->post('password');
	        $db_password = $data['password'];

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

		//Calendar
		public function calendar($year=null,$month=null) 
		{
			$data['adminInfo'] = $this->session->userdata('logged_in');
			if($data['adminInfo'] == TRUE)
			{
				$data['first_name'] = $data['adminInfo']['first_name'];
				$data['last_name'] = $data['adminInfo']['last_name'];
				$data['event'] = $this->input->post('event');
				$data['date'] = $this->input->post('date');	
				
				$data['result'] = $this->admin_model->getEvents();

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
					$this->admin_model->addEvents($data);
					header('Location: http://localhost/sms/admin/calendar/2014/03');
				}

				$config['show_next_prev'] = 'TRUE';
			    $config['day_type'] = 'long';
			    $config['next_prev_url'] = base_url().'admin/calendar';
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
					
				$this->load->view('calendar/calendar',$data);	

			}
			else
				$this->index();
		}

		//Edit Calendar
  		public function edit_calendar() 
	    {
	      $data['admin_info'] = $this->session->userdata('logged_in');
	      if($data['admin_info'] == TRUE)
	      {		
		      	$data['first_name'] = $data['admin_info']['first_name'];
				$data['last_name'] = $data['admin_info']['last_name'];
				$data['info'] = $this->admin_model->calendar_details($data);
				$data['months'] = $this->input->post('months');
				$count = count($data['info'] = $this->admin_model->calendar_details());
				//$this->load->view('admin/edit_calendar', $data);	

				if(isset($_POST['submit']))
				{
					$data['info'] = $this->admin_model->calendar_details($data);
					$this->load->view('admin/edit_calendar', $data);									 				 
				}
				else if(isset($_POST['update']))
				{
					for($i=0; $i <= $count; $i++) 
					{
						 $data['id'] = $_POST['id'.$i];
						 $data['date'] = $_POST['date'.$i];
						 $data['event'] = $_POST['event'.$i];

						 $this->admin_model->calendar_update($data);
						 header('Location: http://localhost/sms/admin/edit_calendar');
					}	
				}
				else { $this->load->view('admin/edit_calendar', $data); }
		   }

			else { $this->index(); }
		}

		public function deleteEvent($id) 
		{
			$id = $_GET['id'];
			$this->admin_model->calendar_delete($id);
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