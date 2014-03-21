<?php
	
	class Sao_model extends CI_Model 
	{	
	  	public function loginSao($username, $password)
	  	{ 
	       $this -> db -> select(); 
	       $this -> db -> from('account');              
	       $this -> db -> where('username', $username);
	       $this -> db -> where('password', $password);
	       $query = $this -> db -> get();
	       $result = $query -> first_row('array');

	       return $result;
	  	}

	  	public function saoInfo($data)
  		{
		     $this-> db -> select();
		     $this-> db -> from('account');
		     $this-> db -> where('account_id',$data['account_id']);
		     $query = $this -> db -> get();
		     $result = $query -> first_row('array');
		  
		     return $result;
 		}

 		//View photo in profile
	    public function viewPhoto($data)
	    {
	      $this->db->select();
	      $this->db->from('account');
	      $this->db->where('account_id',$data['account_id']);

	      $query = $this->db->get();
	      $result = $query -> first_row('array');

	      return $result;
	    }

 		//Checks if student number exists on database
		public function check_student_numbers($student_number) 
		{
		  $query = mysql_query("select * from students where student_number='$student_number'");
		  $result = mysql_num_rows($query);

		  return $result;
		}

 		public function add_violation() {
			date_default_timezone_set('Asia/Manila');
      		$date = date('Y-m-d');

			$student_violation = array(                          
									'student_number' => $this->input->post('student_number'),
                                    'violation' => ucfirst(strtolower($this->input->post('violation'))),
                                    'date' => $date,
                                    'status' => "In campus with violation"
        					         );

      		$this->db->insert('violation',$student_violation);
		}

		public function get_student_info($student_number) {
			$this->db->select();
            $this->db->from('students');          
      		$this->db->where('student_number', $student_number);
      		$query = $this->db->get();
          
            return $query->result_array();
		}

		public function view_violators() {
			$this->db->select();
            $this->db->from('violation');          
            $this->db->order_by('violation_id');
            $this->db->join('students','students.student_number = violation.student_number');
            //$this->db->join('violation','account.account_id = students.account_id');

            $query = $this->db->get();
          
            return $query->result_array();
		}

		public function viewViolatorsByStudentNumber($student_number) {
			$this->db->select();
            $this->db->from('violation');          
            $this->db->order_by('violation_id');
            $this->db->join('students','students.student_number = violation.student_number');
            //$this->db->join('account','account.account_id = students.account_id');
      		$this->db->where('students.student_number', $student_number);
      		$query = $this->db->get();

			return $query->result_array();
    	}

    	public function viewViolatorsByDate($searched_date) {
    		$this->db->select();
            $this->db->from('violation');          
            $this->db->order_by('violation_id');
            $this->db->join('students','students.student_number = violation.student_number');
            $this->db->join('account','account.account_id = students.account_id');
      		$this->db->where('violation.date', $searched_date);
      		$query = $this->db->get();

			return $query->result_array();

    	}

		public function remove_violators($id) {
			$status = array('status' => 'Claimed');

	  		$this->db->where('student_number', $id);
      		$this->db->update('violation', $status);  
		}

		public function suspend_violators() 
		{
			date_default_timezone_set('Asia/Manila');
      		$date = date('Y-m-d');

			$suspend = array(                          
								'student_number' => $this->input->post('student_number'),
	                            'start_date' => $date,
	                            'end_date' => $this->input->post('end_date'),
	                            'status' => "Suspended"
        					);

      		$this->db->insert('suspend',$suspend);
		}


		//Change Password   
		public function changepassword($data)
		{
		   $new_password = array(
			                       'password' => $data['new_password']
		                         );

		    $this->db->where('username',$data['username']);
		    $this->db->update('account',$new_password);
		}

		//Compare Password
	    public function compare_password($data)
	    {
	      $this -> db -> select();
	      $this -> db -> from('account');
	      $this -> db -> where('username',$data['username']);

	      $query = $this -> db -> get();
	      
	      return $query;
	    }


    //CALENDAR
    public function showCalendar($year,$month)
    {    
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

      $events = $this->getEvents($year,$month);
      $day = $this->getEvents($year,$month);
      $this->load->library('calendar',$config);
      
      return $this->calendar->generate($year,$month,$events);
    }

//Get events on calendar table from database
  public function getEvents($year , $month)
  {
    $query = $this->db->select('date,event')->from('calendar')->like('date', "$year-$month")->get();
    $result = $query->result_array();
    return $result;
  }


  public function updateStatus()
  {
  	date_default_timezone_set('Asia/Manila');
  	$date = date('Y-m-d');

  	$update = array(
  						'status' => "Not Suspended"
  					);

  	$this->db->where('end_date',date('Y-m-d'));
  	$this->db->update('suspend',$update);  
  }

//END CALENDAR

}
?>