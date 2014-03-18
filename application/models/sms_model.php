<?php
	class Sms_model extends CI_Model 
  {
    //Login
    public function loginStudent($account_id, $password) {
       $this -> db -> select(); 
       $this -> db -> from('account');       
       $this -> db -> where('account_id', $account_id);
       $this -> db -> where('password', sha1($password));
       $query = $this -> db -> get();
       $result = $query -> first_row('array');

       return $result;
    }

    //During student registration
    public function viewStudentDetails($data) {
      $this->db->select();
      $this->db->from('students');          
      $this->db->where('student_number', $data['student_number']);

      $query = $this->db->get();
      return $query->result_array();
    }
    
		// Inserts student data to students table in database
		public function add_student($data) {
			$studentaccount_data = array(                                     
                                  'account_type'=>'student',       
                                  'account_id' => $this->input->post('student_number'),
                                  'parent_email' => $this->input->post('parent_email'),
                          				'password' => sha1($this->input->post('password')),
                                  'referral_key' => sha1(rand())
                                  );

      $this->db->where('account_id',$data['student_number']);
      $this->db->insert('account',$studentaccount_data); 
		}

    //Get Email
    public function emails($data) {
      $query = $this->db->select('referral_key')->from('account')->where('account_id',$data['student_number'])->get();
   
      return $query -> first_row('array');
    }

    //Gets information of student
    public function studentInfo($data) {
      $this-> db -> select();
      $this-> db -> from('students');
      $this-> db -> where('student_number',$data['account_id']);
      $query = $this -> db -> get();
      $result = $query->result_array();

      return $result;
    }

    //View Study Load
    public function viewStudyLoad($data) {
      $this->db->select();
      $this->db->from('study_load');
      $this->db->join('students','students.student_number = study_load.student_number');
      $this->db->join('offering','offering.offer_code = study_load.offer_code');        
      $this->db->join('subject','subject.offer_code = study_load.offer_code');
      $this->db->join('faculty','faculty.faculty_id = offering.faculty_id');
      $this->db->where('students.student_number',$data['account_id']);

      $query = $this->db->get();
      $result = $query->result_array();
      
      return $result;
    }

    //View Student Logs in home
    public function logs($data) {
      $this->db->select();
      $this->db->from('campus_login');
      $this->db->join('students', 'students.student_number = campus_login.student_number');      
      $this->db->where('campus_login.student_number',$data['account_id']);

      $this->db->limit('5');
      $this->db->order_by('log_id','desc');
               
      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;
    }

    //View Logs
    public function viewLogs($data) {      
      $this->db->limit($data['limit'], $data['start']);
      $this->db->select();
      $this->db->from('campus_login');
      $this->db->join('students', 'students.student_number = campus_login.student_number');      
      $this->db->where('campus_login.student_number',$data['account_id']);
      $this->db->order_by('date','desc');

      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }

    //View Grades
    public function viewGrades($data) {
      $this->db->select();
      $this->db->from('study_load');
      $this->db->join('students','students.student_number = study_load.student_number');
      $this->db->join('subject','subject.offer_code = study_load.offer_code');
      $this->db->where('students.student_number',$data['account_id']);

      $query = $this->db->get();
      return $query -> result_array();
    }

    //View lates and absences
    public function viewsubjects($data) {
       $this->db->select()->from('study_load');
       $this->db->join('offering','offering.offer_code = study_load.offer_code');
       $this->db->join('subject','subject.offer_code = study_load.offer_code');
       $this->db->where('student_number',$data['account_id']);    

       $query = $this->db->get();
       $result = $query -> result_array();
    
       return $result;
    }

    public function viewLates($data) {
      $this->db->select();
      $this->db->from('attendance');
      $this->db->where('student_number',$data['account_id']);

      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;
    }

    public function viewTrackers($data) {
      $this->db->select();
      $this->db->from('tracker');
      $this->db->join('account','account.account_id = tracker.account_id');
      $this->db->where('tracker.account_id', $data['account_id']);

      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }

    public function viewAttendanceLogs($data) {
    $this->db->select();
    $this->db->from('attendance');
    $this->db->join('students','attendance.student_number = students.student_number');
    $this->db->join('offering','offering.offer_code = attendance.offer_code');
    $this->db->join('subject','offering.offer_code = subject.offer_code');
    $this->db->where('attendance.offer_code',$data['offer_code_id']);
    $this->db->where('students.student_number',$data['account_id']);
    $this->db->order_by('date');

    $query = $this->db->get();
    $result = $query -> result_array();

    return $result;
    }

     //Upload
    public function upload($data) {    
        $this->db->where('account_id',$data['account_id']);
        $path = array( 'image_path' => $data['file_path'].$data['file_name']);

        $this->db->update('account',$path);
    }

    //View photo in profile
    public function viewPhoto($data) {
      $this->db->select();
      $this->db->from('account');
      $this->db->where('account_id',$data['account_id']);

      $query = $this->db->get();
      $result = $query -> first_row('array');

      return $result;
    }

    //Count
    public function count($data) {
      $this->db->select();
      $this->db->from('campus_login');     
      $this->db->where('campus_login.student_number',$data['account_id']);

      $query = $this->db->get();
      $result = $query -> num_rows();

      return $result;
    }


    //Change Password
    public function changepassword($data) {
        $new_password = array(
                                'password' => $data['new_password']
                              );

        $this->db->where('account_id',$data['account_id']);
        $this->db->update('account',$new_password);
    }

    //Compare Password
    public function compare_password($data) {
      $this -> db -> select();
      $this -> db -> from('account');
      $this -> db -> where('account_id',$data['account_id']);

      $query = $this -> db -> get();
      
      return $query;
    }

    //CALENDAR
    public function showCalendar($year,$month) {    
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

      $events = $this->getEvents($year,$month);
      $day = $this->getEvents($year,$month);
      $this->load->library('calendar',$config);
      
      return $this->calendar->generate($year,$month,$events);
    }

  //Get events on calendar table from database
  public function getEvents($year , $month) {
    $query = $this->db->select('date,event')->from('calendar')->like('date', "$year-$month")->get();

    $result = $query->result_array();
    return $result;
  }

  //Checks if student number exists on database
  public function check_student_numbers($student_number) {
    $query = mysql_query("select * from students where student_number='$student_number'");
    $result = mysql_num_rows($query);

    return $result;
  }

  //Checks if student number exists on database
  public function check_account_ids($account_id) {
    $query = mysql_query("select * from account where account_id='$account_id'");
    $result = mysql_num_rows($query);

    return $result;
  }

  //Checks if student number exists on database
  public function check_currentpassword($data) {
    $query = $this->db->select('password')->from('account')->where('password',$data['password'])->get();
   
    return $query -> first_row('array');
  }   

/*    //Get specfic college
    public function get_college() 
    {
      $this->db->select('college_id , college_name')->from('college');
      $query = $this->db->get();
      return $query->result();
    }

    //Get course based on college
    public function get_course($college) 
    {
      $this->db->select()->from('college')->where(array('college_name' => $college ));
      $query = $this->db->get();
      $college = $query->result_array();

      $id = array(0=>0);
      foreach ($college as $value) 
      {
        $id[$value['college_id']] = $value['college_id'];
      }
  
      $this->db->select()->from('course');
      $this->db->where_in('college_id',$id);
      $query = $this->db->get();

      return $query->result();
    }*/

	}
?>

