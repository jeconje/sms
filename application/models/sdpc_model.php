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

        //Checks if student number exists on database
        public function check_student_numbers($student_number) 
        {
          $query = mysql_query("select * from attendance where student_number='$student_number'");
          $result = mysql_num_rows($query);

          return $result;
        }

       /* public function viewAllCandidates() {
          $this->db->select();
            $this->db->from('attendance');          
            $this->db->order_by('attendance_id');
            $this->db->join('students','students.student_number = attendance.student_number');

            $query = $this->db->get();
          
            return $query->result_array();
        }*/

        public function viewClasses() {
          $this->db->select();
          $this->db->from('offering');
          $this->db->join('subject','offering.offer_code = subject.offer_code');
          
          $query = $this->db->get();
          $result = $query -> result_array();

          return $result;
        }

        public function viewCandidates($data) {
          $this->db->select();
          $this->db->from('attendance');
          $this->db->join('students', 'attendance.student_number = students.student_number');
          $this->db->where('attendance.student_number', $data['student_number']);

          $query = $this->db->get();
          $result = $query -> result_array();

          return $result;
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
  //Get events on calendar table from database
  public function getEvents($year , $month)
  {
    $query = $this->db->select('date,event')->from('calendar')->like('date', "$year-$month")->get();
    $result = $query->result_array();
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

  //View Parent's Info
  public function parentInfo($data)
  {
    $this-> db -> select();
    $this-> db -> from('parent');
    $this-> db -> where('parent_id',$data['account_id']);
    $query = $this -> db -> get();
    $result = $query -> first_row('array');

    return $result;
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