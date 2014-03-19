  <?php

class Parent_model extends CI_Model 
{

  //Login
  public function loginParent($username, $password) { 
    $this->db->select(); 
    $this->db->from('account');              
    $this->db->where('account_id', $username);
    $this->db->where('password', sha1($password));

    $query = $this->db->get();
    $result = $query->first_row('array');

    return $result;
  }

  //View Parent's Info
  public function trackerInfo($data) {
    $this-> db -> select();
    $this-> db -> from('tracker');
    $this-> db -> where('tracker_id',$data['account_id']);
    
    $query = $this -> db -> get();
    $result = $query->result_array();

    return $result;
  }

  //Parent Registration
  public function add_parent($data) 
  {
      $combinedate = $this->input->post('byear').'-'.$this->input->post('months').'-'.$this->input->post('days');
      $date = date("Y-m-d", strtotime($combinedate));

      $account = array(
                        'account_id' => $this->input->post('username'),
                        'account_type' =>'tracker',
                        'password' => sha1($this->input->post('password')),
                      );

      $this->db->where('referral_key', $data['referral_key']);
      $this->db->insert('account', $account);

      //Tawgon ang public function exist() if ni exist ba ang key

      $tracker = array( 
                        'tracker_id'=>$this->input->post('username'), 
                        'account_id' => $data['account_id'],
                        'gender' => $this->input->post('gender'),
                        'last_name'=>ucfirst($this->input->post('last_name')), 
                        'first_name'=>ucfirst($this->input->post('first_name')),
                        'middle_name'=>ucfirst($this->input->post('middle_name')), 
                        'address'=>ucfirst($this->input->post('address')),
                        'contact_number'=>$this->input->post('contact_number'),
                        'date_of_birth'=>$date,
                        'address' => $this->input->post('address')
                      );
      
      $this->db->insert('tracker',$tracker);
  }

  //Display names
  public function displayNames($data) {
    $this->db->select();
    $this->db->from('tracker');
    $this->db->join('students','tracker.account_id = students.student_number');
    $this->db->where('tracker.tracker_id', $data['account_id']);

    $query = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

  public function viewLogs($data) {
    $this->db->select();
    $this->db->from('tracker');
    $this->db->join('campus_login', 'tracker.account_id = campus_login.student_number');      
    $this->db->join('account', 'campus_login.student_number = account.account_id');
    $this->db->join('students','account.account_id = students.student_number');
    $this->db->where('tracker.tracker_id',$data['account_id']);
    $this->db->limit('5');
    $this->db->order_by('log_id','desc');

    $query = $this->db->get();
    $result = $query -> result_array();
    return $result;
  }

  //View Logs (inig view all)
  public function logs($data) {
    $this->db->limit($data['limit'], $data['start']);
    $this->db->select();
    $this->db->from('tracker');
    $this->db->join('campus_login', 'tracker.account_id = campus_login.student_number');      
    $this->db->join('account', 'campus_login.student_number = account.account_id');
    $this->db->join('students','account.account_id = students.student_number');
    $this->db->where('tracker.tracker_id',$data['account_id']);   
    $this->db->order_by('log_id','desc');

    $query = $this->db->get();
    $result = $query -> result_array();

    return $result;

  }

  //Study load info
  public function viewStudentInfoInSL($data) {
    $this->db->select();
    $this->db->from('students');
    $this->db->where('student_number',$data['id']);

    $query = $this->db->get();
    $result = $query -> first_row('array');

    return $result;
  }

  //View study load
  public function viewStudyLoad($data) {
    $this->db->select();
    $this->db->from('study_load');
    $this->db->join('students','students.student_number = study_load.student_number');
    $this->db->join('offering','offering.offer_code = study_load.offer_code');        
    $this->db->join('subject','subject.offer_code = study_load.offer_code');
    $this->db->join('faculty','faculty.faculty_id = offering.faculty_id');
    $this->db->where('study_load.student_number',$data['id']); 

    $query = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

  //View grades
  public function viewChildrensGrades($data) {
    $this->db->select();
    $this->db->from('account');
    $this->db->join('study_load','account.account_id = study_load.student_number');       
    $this->db->join('subject','subject.offer_code = study_load.offer_code');    
    $this->db->where('account.account_id',$data['id']);

    $query = $this->db->get();
    $result = $query->result_array(); 

    return $result;
  }

  public function childrensAttendance($data)  {
    $this->db->select();
    $this->db->from('attendance');
    $this->db->where('student_number',$data['id']);
   
    $query = $this->db->get();
    $result = $query -> result_array();

    return $result;
  }

  //View add child
  public function viewAddChild($data) {
    $this->db->select();
    $this->db->from('account');
    $this->db->where('referral_key',$data['referral_key']);

    $query = $this->db->get();
    $result = $query -> first_row('array');

    return $result;
  }

  //Add child in database
  public function addChild($data) {
    foreach($data['trackerInfo'] as $tracker) {
    $data['info'] = array (
                            'tracker_id' => $data['account_id'],
                            'account_id' => $data['id'],
                            'first_name' => $tracker['first_name'],
                            'middle_name' => $tracker['middle_name'], 
                            'last_name' => $tracker['last_name'],
                            'gender' => $tracker['gender'],
                            'date_of_birth' => $tracker['date_of_birth'],
                            'contact_number' => $tracker['contact_number'],
                            'address' => $tracker['address']
                          );  
    
    $this->db->insert('tracker',$data['info']);
     }
  }

  //Compare Password
    public function compare_password($data) {
      $this -> db -> select();
      $this -> db -> from('account');
      $this -> db -> where('account_id',$data['account_id']);

      $query = $this -> db -> get();
      
      return $query;
    }











  //Checks referral key from student database if it exists
  public function check_referral_key($data) 
  {
    $student_number = $data['student_number'];
    $referral_key = $data['referral_key'];
    
    $query = mysql_query("select * from account where account_id='$student_number' AND referral_key='$referral_key'");
    $result = mysql_num_rows($query);

    return $result;
  }

  public function check_referral_key_registration($data) 
  {
    $referral_key = $data['referral_key'];
    
    $query = mysql_query("select * from account where referral_key='$referral_key'");
    $result = mysql_num_rows($query);

    return $result;
  }

  


  
  
  //Gets the account id of the inputted referral key
  public function get_student_account_id($data) 
  {
    $this -> db -> select('account_id');
    $this -> db -> from('account');
    $this -> db -> where('referral_key', $data['referral_key']);

    $query = $this->db->get();
    $result = $query -> first_row('array');

    return $result;
  }

  

  

  

  //View child/children
  public function viewDependents($data)
  {
    $this->db->select();
    $this->db->from('tracker');
    $this->db->join('students', 'students.student_number = tracker.account_id');

    $this->db->where('tracker.tracker_id',$data['account_id']);

    $query = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

  

  


    

    //Count for pagination
    public function count($data)
    {
      $this->db->select();
      $this->db->from('campus_login'); 
      $this->db->join('students','students.student_number = campus_login.student_number');
      $this->db->join('account','account.account_id = students.student_number');
      $this->db->join('tracker','tracker.account_id = account.account_id');
      // $this->db->join('tracker','parent.parent_id = tracker.parent_id');
      $this->db->where('tracker.tracker_id',$data['account_id']);
  
      $query = $this->db->get();
      $result = $query -> num_rows();

      return $result;
    }

    

    public function viewAttendanceLogs($data)
    {
      $this->db->select();
      $this->db->from('attendance');
      $this->db->join('students','attendance.student_number = students.student_number');
      $this->db->join('offering','offering.offer_code = attendance.offer_code');
      $this->db->join('subject','offering.offer_code = subject.offer_code');       
      $this->db->where('students.student_number',$data['number']);
      //$this->db->where('offering.offer_code',$data['id_code']);

      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;
    }

  public function displaySubjects($data)
  {
    $this->db->select();
    $this->db->from('study_load');
    $this->db->join('offering','offering.offer_code = study_load.offer_code');
    $this->db->join('subject','subject.offer_code = study_load.offer_code');
    $this->db->join('students','students.student_number = study_load.student_number');
    $this->db->join('tracker','tracker.account_id = students.student_number');

    $this->db->where('study_load.student_number',$data['id']);
    $this->db->where('tracker.tracker_id',$data['account_id']);   
    
    $query = $this->db->get();
    $result = $query -> result_array();
    return $result; 
  }

  

  //View Details in Edit Profile
  public function editProfile($data) 
  { 
    $this->db->select();
    $this->db->from('tracker');
    $this->db->where('tracker_id',$data['tracker_id']);

    $this->db->join('account','account.account_id = tracker.tracker_id');
    $query = $this->db->get();  

    return $query->first_row('array');
  }

  //Update details in databse
  public function updateProfile($data)
  {
    $update_data = array(
                          'address' => $data['address'],
                          'contact_number' => $data['contact_number']
                        );
          
    $this->db->where('tracker_id',$data['tracker_id']);
    $this->db->update('account',$update_data);
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
    
  //Change Password   
  public function changepassword($data)
  {
    $new_password = array(
                            'password' => $data['new_password']
                         );

    $this->db->where('account_id',$data['account_id']);
    $this->db->update('account',$new_password);
  }

  

         //Calendar
        public function showCalendar($year,$month)
        {    
              $config['show_next_prev'] = 'TRUE';
              $config['day_type'] = 'long';
              $config['next_prev_url'] = base_url().'parents/calendarforparents';
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

      //END CALENDAR

        public function check_usernames($username) {
          $query = mysql_query("select * from account where account_id='$username'");
          $result = mysql_num_rows($query);

          return $result;
        }
}