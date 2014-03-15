  <?php

class Parent_model extends CI_Model 
{
  //Parent Registration
	public function add_parent($selected_student_account_id) 
	{
		$combinedate = $this->input->post('byear').'-'.$this->input->post('months').'-'.$this->input->post('days');
      $date = date("Y-m-d", strtotime($combinedate));

		$parentaccount_data = array(                                     
	                              'account_type'=>'parent',                                                             
	                        		  'last_name'=>ucfirst($this->input->post('last_name')),                    
	                        		  'first_name'=>ucfirst($this->input->post('first_name')),
	                        		  'middle_name'=>ucfirst($this->input->post('middle_name')),
	                              'gender'=>ucfirst($this->input->post('gender')),
	                        		  'address'=>ucfirst($this->input->post('address')),
	                        		  'contact_number'=>$this->input->post('contact_number'),
	                        		  'date_of_birth'=>$date,
	                        		  'username'=>$this->input->post('username'),
	                        		  'password'=>$this->input->post('password')
                					     );

    //Gets the account_id of the last inserted row to be used as foreign key in student table    
    $referral_key = $this->input->post('referral_key');
      
    //Inserts at account table
    $this->db->where('referral_key',$referral_key);
      $this->db->insert('account',$parentaccount_data);

    //Gets the account id of the latest inserted row
    $account_id = $this->db->insert_id();

    //Inserts account id for parents table
    $parent_data = array('account_id'=>$account_id);     
      $this->db->insert('parent',$parent_data);

    //Gets the account id of the latest inserted parent
    $parent_account_id = $this->db->insert_id();

    //Inserts parents and students to tracker table
    $parent_student_data = array(
                                'account_id' => $selected_student_account_id['account_id'],
                                'parent_id' => $parent_account_id
                                );
    $this->db->insert('tracker',$parent_student_data);
  }

  //Checks referral key from student database if it exists
  public function check_referral_key($data) 
  {
    $student_number = $data['student_number'];
    $referral_key = $data['referral_key'];
    
    $query = mysql_query("select * from students where student_number='$student_number' AND referral_key='$referral_key'");
    $result = mysql_num_rows($query);

    return $result;
  }

  //loginParent
  public function loginParent($username, $password)
  { 
    $this -> db -> select(); 
    $this -> db -> from('account');              
    $this -> db -> join ('parent','account.account_id = parent.account_id');
    $this -> db -> where('username', $username);
    $this -> db -> where('password', $password);
    $query = $this -> db -> get();
    $result = $query -> first_row('array');

    return $result;
  }

  //View Parent's Info
  public function parentInfo($data)
  {
    $this-> db -> select();
    $this-> db -> from('parent');
    $this-> db -> where('account_id',$data['account_id']);
    $query = $this -> db -> get();
    $result = $query -> first_row('array');

    return $result;
  }

  //View add child
  public function viewAddChild($data)
  {
    $this->db->select();
    $this->db->from('students');
    $this->db->where('referral_key',$data['referral_key']);
    $query = $this->db->get();
    $result = $query -> first_row('array');

    return $result;
  }
  
  //Gets the account id of the inputted referral key
  public function get_student_account_id($referral_key) {
    $referral_key = $this->input->post('referral_key');

    $this -> db -> select('account_id');
    $this -> db -> from('students');
    $this -> db -> where('referral_key', $referral_key);

    $query = $this->db->get();

    $result = $query -> first_row('array');

    return $result;
  }

  //Add child in database
  public function addChild($data)
  {
    $data['info'] = array (
                          'account_id' => $data['id'],                
                           'parent_id' => $data['account_id']
                          );  
    
    $this->db->insert('tracker',$data['info']);
  }

  //Display names
  public function displayNames($data)
  {
    $this->db->select();
    $this->db->from('students');
    $this->db->join('tracker','tracker.account_id = students.account_id');    
    $this->db->join('parent','parent.parent_id = tracker.parent_id');
    $this->db->join('account','students.account_id = account.account_id');   
    $this->db->where('parent.account_id',$data['account_id']);     
    $query = $this->db->get();  
    $result = $query -> result_array(); 

    return $result;
  }

  //View grades
  public function viewChildrensGrades($data)
  {
    $this->db->select();
    $this->db->from('students');
    $this->db->join('study_load','students.student_number = study_load.student_number');
    $this->db->join('account','students.account_id = account.account_id');        
    $this->db->join('subject','subject.offer_code = study_load.offer_code');     
    $this->db->where('account.account_id',$data['id']);

    $query = $this->db->get();
    $result = $query->result_array(); 

    return $result;
  }

  //View child/ren
  public function viewDependents($data)
  {
    $this->db->select();
    $this->db->from('tracker');
    $this->db->join('account','account.account_id = tracker.account_id');
    $this->db->join('students','students.account_id = tracker.account_id');
    $this->db->where('tracker.parent_id',$data['account_id']);
    $query = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

  //View study load
  public function viewStudyLoad($data)
  {
    $this->db->select();
    $this->db->from('study_load');    
    $this->db->join('subject','study_load.offer_code = subject.offer_code');
    $this->db->join('offering','study_load.offer_code = offering.offer_code');
    $this->db->join('students','students.student_number = study_load.student_number');
    $this->db->where('students.account_id',$data['id']);
    $query = $this->db->get();
    $result = $query -> result_array();

    return $result;
  }

  //Study load info
  public function viewStudentInfoInSL($data)
  {
    $this->db->select();
    $this->db->from('students');
    $this->db->where('account_id',$data['id']);
    $query = $this->db->get();
    $result = $query -> first_row('array');

    return $result;
  }


    //Sa home ni
    public function viewLogs($data)
    {
      $this->db->select();
      $this->db->from('students');
      $this->db->join('campus_login', 'students.student_number = campus_login.student_number');      
      $this->db->join('account','students.account_id = account.account_id');
      $this->db->join('tracker','tracker.account_id = account.account_id');
      $this->db->where('tracker.parent_id',$data['account_id']);
      $this->db->limit('5');
      $this->db->order_by('log_id','desc');

      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;
    }

    //Count for pagination
    public function count($data)
    {
      $this->db->select();
      $this->db->from('campus_login'); 
      $this->db->join('students','students.student_number = campus_login.student_number');
      $this->db->join('account','account.account_id = students.account_id');
      $this->db->join('tracker','tracker.account_id = account.account_id');
      $this->db->join('parent','parent.parent_id = tracker.parent_id');
      $this->db->where('parent.account_id',$data['account_id']);
  
      
      $query = $this->db->get();
      $result = $query -> num_rows();

      return $result;
    }

    //View Logs
    public function logs($data)
    {
      $this->db->limit($data['limit'], $data['start']);
      $this->db->select();
      $this->db->from('students');
      $this->db->join('campus_login', 'students.student_number = campus_login.student_number');      
      $this->db->join('account','students.account_id = account.account_id');
      $this->db->join('tracker','tracker.account_id = account.account_id');
      $this->db->where('tracker.parent_id',$data['account_id']);      
      $this->db->order_by('log_id','desc');

      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;

    }



	//View Details in Edit Profile
	public function editProfile($data) 
  { 
    $this->db->select();
    $this->db->from('account');
    $this->db->where('username',$data['username']);
    $this->db->join('parent','account.account_id = parent.account_id');
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
          
          $this->db->where('username',$data['username']);
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


  public function displaySubjects($data)
  {
    $this->db->select();
    $this->db->from('study_load');
    $this->db->join('offering','offering.offer_code = study_load.offer_code');
    $this->db->join('subject','subject.offer_code = study_load.offer_code');
    $this->db->join('students','students.student_number = study_load.student_number');
    $this->db->join('tracker','tracker.account_id = students.account_id ');
    $this->db->where('study_load.student_number',$data['id']);
    $this->db->where('tracker.parent_id',$data['account_id']);   
    
    $query = $this->db->get();
    $result = $query -> result_array();
    return $result; 

  }

  public function childrensAttendance($data)
  {
    $this->db->select();
      $this->db->from('attendance');
      $this->db->where('student_number',$data['id']);
      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;
  }

}