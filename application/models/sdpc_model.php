<?php

	class Sdpc_model extends CI_Model 
  {
        //Redirect Login
        public function loginSdpc($username, $password)
        {
           
           $this -> db -> select(); 
           $this -> db -> from('account');              
           $this -> db -> where('username', $username);
           $this -> db -> where('password', $password);
           $query = $this -> db -> get();
           $result = $query -> first_row('array');

           return $result;
        }

        //View Teacher's Info
        public function sdpcInfo($data)
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

        public function viewAttendance()
        {
          $this->db->select();
          $this->db->from('attendance');                        
          $query = $this->db->get();
          $result = $query -> result_array();

          return $result;

        }

       //Change password
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
                  'event' => $data['event']
                  //'date' => $date
                  );
    $result = $this->db->insert('calendar',$data);
  }

  public function notification_parent($data) {
    $this->db->select()->from('notifications');/*->where(array('account_id' => $data['account_id'], 'seen' =>'no'));*/
    $query = $this->db->get();

    return $query->result_array();
  }

  public function notification_update_parent($data) {
    for($x=0; $x < count($data['notification_id']); $x++) {
      $seen_update = array('seen'=>'yes');
      $this->db->where(array('parent_id' => $data['parent_id'], 'notification_id' => $data['id_for_update'][$x]));
    }
    $this->db->select()->from('notification')->where(array('account_id' => $data['account_id']));
    $query = $this->db->get();

    return $query->result_array();
  }

  public function childrensAttendance($data) {
    $this->db->select();
    $this->db->from('attendance');
    $this->db->where('student_number',$data['id']);

    $query = $this->db->get();
    $result = mysql_num_rows($query);

    return $result;
  }
}

?>