<?php
	class Admin_model extends CI_Model 
	{
    public function loginAdmin($username, $password)
    {
       $this -> db -> select(); 
       $this -> db -> from('account');              
       $this -> db -> where('username', $username);
       $this -> db -> where('password', $password);
       $query = $this -> db -> get();
       $result = $query -> first_row('array');

       return $result;
    }

    public function addAccount($data)
    {
      $combinedate = $this->input->post('byear').'-'.$this->input->post('months').'-'.$this->input->post('days');
        $date = date("Y-m-d", strtotime($combinedate));

        $data['account_info'] = array (                              
                                      'account_type' => $data['account_type'],
                                      'last_name'=>ucfirst($data['last_name']),                    
                                      'first_name'=>ucfirst($data['first_name']),
                                      'middle_name'=>ucfirst($data['middle_name']),
                                      'gender'=>ucfirst($data['gender']),
                                      'contact_number' => $data['contact_number'],
                                      'address' => $data['address'],
                                      'date_of_birth' => $date,
                                      'email_address' => $data['email_address'],
                                      'username' => $data['username'],
                                      'password' => $data['password'],
                                      );

      $this->db->insert('account',$data['account_info']);
      $account_id = $this->db->insert_id();

      $faculty_id = $this->input->post('faculty_id');

      $faculty_data = array('account_id'=>$account_id);                   
       
      $this->db->where('faculty_id', $faculty_id);                   
      $this->db->update('faculty',$faculty_data);
  }

  /*//Get specfic college
      public function get_college() {
        $this->db->select('college_id , college_name')->from('college');
        $query = $this->db->get();
        return $query->result();
      }*/

/*      //Get course based on college
      public function get_course($college)  {
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

    //View Admin Profile Info
	  public function adminInfo($data)
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

    //Updates Info in the database
    public function updateProfile($data)
    {
       $update = array(
                        'address' => $data['address'],
                        'contact_number' => $data['contact_number']
                      );
          
      $this->db->where('username',$data['username']);
      $this->db->update('account',$update);
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

    //Checks if student number exists on database
    public function check_id_numbers($check_id_number) {
      $check_from_faculty = mysql_query("select * from faculty where faculty_id='$check_id_number' OR account_id='NULL'");
      $from_faculty = mysql_num_rows($check_from_faculty);

      return $from_faculty;
    }

    public function verify_faculty_id($faculty_id) {
      $this -> db -> select('account_id');
      $this -> db -> from('faculty');
      $this -> db -> where('faculty_id, account_id ==', $faculty_id, NULL);
      $query = $this -> db -> get();

      return $query;
    }

    //Checks if student number exists on database
    public function check_usernames($username) {
      $query = mysql_query("select * from account where username='$username'");
      $result = mysql_num_rows($query);

      return $result;
    }

    //Calendar
public function showCalendar($year,$month)
  {    
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
    $this->load->library('calendar',$config);
   
    return $this->calendar->generate($year,$month,$events);
  }

  //Get events on calendar table from database
  public function getEvents($year , $month)
  {
    $query = $this->db->select('date,event')->from('calendar')->like('date',"$year-$month")->get();
    $this->db->DISTINCT('date');
    $eventvents = array();

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

   $query = $this->db->query("SELECT DISTINCT date AS date
                                            FROM calendar
                                            WHERE date LIKE '$year-$month%' ");
    $data['events'] = array(
                              'event' => $data['event'],
                              'date' => $data['date']
                            );
    
    $result = $this->db->insert('calendar',$data['events']);
  }

   public function updateEvents($data)
  {
   
    $data = array(
                  'event' => $data['event'],
                 );
    
    $this->db->where('calendar_id', $calendar_id);
    $this->db->update('calendar',$data);
  

  }

  public function deleteEvents($data)
  {
    $this->db->delete('calendar',array('date' => $data['date']));

  }
}

?>