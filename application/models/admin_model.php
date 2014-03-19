<?php
  class Admin_model extends CI_Model 
  {
    public function loginAdmin($username, $password)
    {
       $this -> db -> select(); 
       $this -> db -> from('account');              
       $this -> db -> where('account_id', $username);
       $this -> db -> where('password', $password);

       $query = $this -> db -> get();
       $result = $query -> first_row('array');

       return $result;
    }

    public function addAccount($data) {
      $data['account_info'] = array (                              
                                    'account_type' => $this->input->post('account_type'),
                                    'account_id' => $this->input->post('faculty_id'),
                                    'password' => sha1($this->input->post('password'))
                                    );

      $this->db->insert('account',$data['account_info']);
  }

  public function checkFaculty($data) {
    $this->db->select();
    $this->db->from('faculty');          
    $this->db->where('faculty_id', $data['faculty_id']);

    $query = $this->db->get();
    return $query->result_array();
  }


    //View Admin Profile Info
    public function adminInfo($data) {
        $this-> db -> select();
        $this-> db -> from('account');
        $this-> db -> where('account_id',$data['account_id']);
        $query = $this -> db -> get();
        $result = $query -> first_row('array');

        return $result;
    }

    //Checks if student number exists on database
    public function check_id_numbers($check_id_number) {
      $check_from_faculty = mysql_query("select * from faculty where faculty_id='$check_id_number'");
      $from_faculty = mysql_num_rows($check_from_faculty);

      return $from_faculty;
    }

    public function verify_faculty_id($faculty_id) {
      $this -> db -> select('faculty_id');
      $this -> db -> from('faculty');
      $this -> db -> where('faculty_id', $faculty_id, NULL);
      $query = $this -> db -> get();

      return $query;
    }

    public function check_usernames($username) {
      $check_username = mysql_query("select * from account where account_id='$username'");
      $result = mysql_num_rows($check_username);

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

     //Change Password
    public function changepassword($data)
    {
        $new_password = array(
                                'password' => $data['new_password']
                              );

        $this->db->where('account_id',$data['username']);
        $this->db->update('account',$new_password);
    }

    //Compare Password
    public function compare_password($data)
    {
      $this -> db -> select();
      $this -> db -> from('account');
      $this -> db -> where('account_id',$data['account_id']);

      $query = $this -> db -> get();
      
      return $query;
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
    $day = $this->getEvents($year,$month);
    $this->load->library('calendar',$config);
    
    return $this->calendar->generate($year,$month,$events);
  }

//View details
        public function calendar_details($data) 
        { 
          if($data['months'] == "1")
          {
            $data['filter'] = '-01-';
          }
          else if($data['months'] == "2")
          {
            $data['filter'] = '-02-';
          }
          else if($data['months'] == "3")
          {
            $data['filter'] = '-03-';
          }
          else if($data['months'] == "4")
          {
            $data['filter'] = '-04-';
          }
          else if($data['months'] == "5")
          {
            $data['filter'] = '-05-';
          }
          else if($data['months'] == "6")
          {
            $data['filter'] = '-06-';
          }
          else if($data['months'] == "7")
          {
            $data['filter'] = '-07-';
          }
          if($data['months'] == "8")
          {
            $data['filter'] = '-08-';
          }
          if($data['months'] == "9")
          {
            $data['filter'] = '-09-';
          }
          if($data['months'] == "10")
          {
            $data['filter'] = '-10-';
          }
          if($data['months'] == "11")
          {
            $data['filter'] = '-11-';
          }
          if($data['months'] == "12")
          {
            $data['filter'] = '-12-';
          }
          $this->db->select();
          $this->db->from('calendar');
          $this->db->like('date',$data['filter']);
          $this->db->order_by('date');
          
          $query = $this->db->get();
          $result = $query -> result_array();

          return $result;
        } 

//Add Events
  public function addEvents($data)
  {
    $data['events'] = array(
                              'event' => $data['event'],
                              'date' => $data['date']
                            );
    
    $result = $this->db->insert('calendar',$data['events']);
  }

//Update Details
        public function calendar_update($data)
        {
          $update = array(
                          'date' => $data['date'],
                          'event' => $data['event']
                          );
          
          $this->db->where('calendar_id',$data['id']);
          $this->db->update('calendar',$update);
        }  
//Delete Details
      public function calendar_delete($id)
      {
        $this->db->delete('calendar', array('calendar_id' => $id)); 
      }


//Get events on calendar table from database
  public function getEvents($year , $month)
  {
    $query = $this->db->select('date,event')->from('calendar')->like('date', "$year-$month")->get();
    $result = $query->result_array();
    return $result;
  }

}

?>