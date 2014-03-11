<?php
	class Sms_model extends CI_Model 
  {
    //Login
    public function loginStudent($username, $password)
    {
       $this -> db -> select(); 
       $this -> db -> from('account');       
       $this -> db -> join ('students','account.account_id = students.account_id');
       $this -> db -> where('username', $username);
       $this -> db -> where('password', $password);
       $query = $this -> db -> get();
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

    //Checks if student number exists on database
    public function check_usernames($username) {
      $query = mysql_query("select * from account where username='$username'");
      $result = mysql_num_rows($query);

      return $result;
    }

     //Checks if student number exists on database
    public function check_currentpassword($data) {
      $query = $this->db->select('password')->from('account')->where('password',$data['password'])->get();
     
        return $query -> first_row('array');
    }
    
		// Inserts student data to students table in database
		public function add_student($data) 
    {
			$combinedate = $this->input->post('byear').'-'.$this->input->post('months').'-'.$this->input->post('days');
      $date = date("Y-m-d", strtotime($combinedate));

			$studentaccount_data = array(                                     
                                    'account_type'=>'student',                                                             
                          					'last_name'=>ucfirst($this->input->post('last_name')),                    
                          					'first_name'=>ucfirst($this->input->post('first_name')),
                          					'middle_name'=>ucfirst($this->input->post('middle_name')),
                                    'gender'=>ucfirst($this->input->post('gender')),
                          					'address'=>ucfirst($this->input->post('address')),
                          					'contact_number'=>$this->input->post('contact_number'),
                          					'date_of_birth'=>$date,
                                    'email_address'=>$this->input->post('email_address'),
                                    'parent_email'=>$this->input->post('parent_email'),
                          					'username'=>$this->input->post('username'),
                          					'password'=>$this->input->post('password')
                					         );

      //Gets the account_id of the last inserted row to be used as foreign key in students table  
      $this->db->insert('account',$studentaccount_data);  
      $account_id = $this->db->insert_id();
      
      $student_number = $this->input->post('student_number');

      $student_data = array(
                            'account_id'=>$account_id,
                            'referral_key'=>sha1(rand())                            
                          );

      $this->db->where('student_number', $student_number);
      $this->db->update('students',$student_data);
		}

    //Get the referral key
    public function get_code() 
    {
      $this->db->select()->from('students')->where(array('referral_key' => $referral_key));
      $query = $this->db->get();

      return $query->first_row('array');
    }

    //Upload
    public function upload($data)
    {    
        $this->db->where('account_id',$data['account_id']);
        $path = array( 'image_path' => $data['file_path'].$data['file_name']);

        $this->db->update('account',$path);
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

    //Get Email
    public function emails($data)
    {
        $query = $this->db->select('referral_key')->from('students')->where('student_number',$data['student_number'])->get();
     
        return $query -> first_row('array');
    }

    //Gets information of student
    public function studentInfo($data)
    {
       $this-> db -> select();
       $this-> db -> from('students');
       $this-> db -> where('account_id',$data['account_id']);
       $query = $this -> db -> get();
       $result = $query -> first_row('array');

       return $result;
    }

    //View Edit Profile
    public function viewProfile($data) 
    { 
        $this->db->select();
        $this->db->from('account');
        $this->db->where('username',$data['username']);
        $this->db->join('students','account.account_id = students.account_id');
        $query = $this->db->get();  

        return $query->first_row('array');
    }
   
    //View Parent/Guardian following student
    public function viewParents($data)
    {
      $this->db->select();
      $this->db->from('parent');
      $this->db->join('account','parent.account_id = account.account_id');      
      $this->db->join('tracker','parent.parent_id = tracker.parent_id');
      $this->db->where('tracker.account_id',$data['account_id']);
      $query = $this->db->get();

      $result = $query -> result_array();

      return $result;
    }

    //View lates and absences
    public function viewsubjects($data)
    {
       $this->db->select()->from('study_load');
       $this->db->join('offering','offering.offer_code = study_load.offer_code');
       $this->db->join('subject','subject.offer_code = study_load.offer_code');
       $this->db->where('student_number',$data['student_number']);       
       $query = $this->db->get();
       $result = $query -> result_array();
    
       return $result;
    }

    public function viewLates($data)
    {
      $this->db->select();
      $this->db->from('attendance');
      $this->db->where('student_number',$data['student_number']);
      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;
    }

    //View Grades
    public function viewGrades($data)
    {
       $this->db->select();
       $this->db->from('study_load');
       $this->db->join('students','students.student_number = study_load.student_number');
       $this->db->join('subject','subject.offer_code = study_load.offer_code');
       $this->db->where('students.student_number',$data['student_number']);
       $query = $this->db->get();
       
      return $query -> result_array();
    }

    //View Study Load
    public function viewStudyLoad($data)
    {
        $this->db->select();
        $this->db->from('study_load');
        $this->db->join('students','students.student_number = study_load.student_number');
        $this->db->join('offering','offering.offer_code = study_load.offer_code');        
        $this->db->join('subject','subject.offer_code = study_load.offer_code');
        $this->db->where('students.student_number',$data['student_number']);                  
        $query = $this->db->get();
        $result = $query->result_array();
        
        return $result;
    } 

    //Count
    public function count($data)
    {
      $this->db->select();
      $this->db->from('campus_login');     
      $this->db->where('campus_login.student_number',$data['student_number']);

      $query = $this->db->get();
      $result = $query -> num_rows();

      return $result;
    }

    //View Logs
    public function viewLogs($data)
    {      
      $this->db->limit($data['limit'], $data['start']);
      $this->db->select();
      $this->db->from('campus_login');
      $this->db->join('students', 'students.student_number = campus_login.student_number');      
      $this->db->where('campus_login.student_number',$data['student_number']);
      $query = $this->db->get();
      $result = $query -> result_array();
      return $result;
    }

    //sa home ni
    
    public function logs($data)
    {
      $this->db->select();
      $this->db->from('campus_login');
      $this->db->join('students', 'students.student_number = campus_login.student_number');
      $this->db->where('campus_login.student_number',$data['student_number']);
      $this->db->limit('5');
      $this->db->order_by('log_id','desc');
      //$this->db->order_by('time_out','desc');
               
      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;

    }

    //Update information in database
    public function editProfile($data)
    {
         $update_data = array(
                               'address' => $data['address'],
                               'contact_number' => $data['contact_number']
                            );
          
          $this->db->where('username',$data['username']);
          $this->db->update('account',$update_data);
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
      $events = $this->getEvents($year,$month);
      $this->load->library('calendar',$config);
     
      return $this->calendar->generate($year,$month,$events);
    }
  //Get events on calendar table from database
  public function getEvents($year , $month)
  {
    $events = array();
    $query = $this->db->select('date,event')->from('calendar')->like('date',"$year-$month")->get();
    $result = $query->result();
    foreach($result as $row)
    {
        $day = (int)substr($row->date,8,2);
        $events[(int)$day] = $row->event;
    }
    return $events;
  }
  public function addEvents($data)
  {
   
    $data = array(
                  'event' => $data['input_events']
                  //'date' => $date
                  );
    $result = $this->db->insert('calendar',$data);
  }
    //END CALENDAR

	}
?>

