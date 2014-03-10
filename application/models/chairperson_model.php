<?php

	class Chairperson_model extends CI_Model 
  {
        //Redirect Login
        public function loginChairperson($username, $password)
        {
           $this -> db -> select(); 
           $this -> db -> from('account');              
           $this -> db -> join ('faculty','account.account_id = faculty.account_id');
           $this -> db -> where('username', $username);
           $this -> db -> where('password', $password);
           $query = $this -> db -> get();
           $result = $query -> first_row('array');

           return $result;
        }
        //View chairperson's Info
        public function chairpersonInfo($data)
        {
          $this-> db -> select();
          $this-> db -> from('faculty');
          $this-> db -> where('account_id',$data['account_id']);
          $query = $this -> db -> get();
          $result = $query -> first_row('array');

          return $result;
        }

        //Get specfic college
        public function get_college($data) 
        {
          $this-> db -> select();
          $this-> db -> from('college');
          $this-> db -> join('faculty', 'college.college_id = faculty.college_id');
          $this-> db -> where('faculty.college_id', $data['college_id']);
          $query = $this -> db -> get();
          $result = $query -> result_array();

          return $result;
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

        public function viewClasses($data)
        {
            $this->db->select();
            $this->db->from('offering');          
            $this->db->join('faculty','offering.faculty_id = faculty.faculty_id');
            $this->db->join('subject','offering.offer_code = subject.offer_code');            
            $this->db->where('offering.faculty_id',$data['faculty_id']);            
            $query = $this->db->get();
            $result = $query -> result_array();

            return $result;
        }

        public function viewCandidates($data)
        {
            $this->db->select();
            $this->db->from('attendance');
            $query = $this->db->get();
            $result = $query -> result_array();

            return $result;
        }


        //View Study Load
        public function viewStudyLoad($data)
        {
            $this->db->select();
            $this->db->from('teacher_load');
            //$this->db->join('faculty','faculty.faculty. = study_load.student_number');
            //$this->db->join('offering','offering.offer_code = study_load.offer_code');        
            //$this->db->join('subject','subject.offer_code = study_load.offer_code');
            //$this->db->where('students.student_number',$data['student_number']);                  
            $query = $this->db->get();
            $result = $query->result_array();
            
            return $result;
        }

       //Get values from database 
        public function editProfile($data) 
        { 
            $this->db->select();
            $this->db->from('account');
            $this->db->where('username',$data['username']);
            $this->db->join('faculty','account.account_id = faculty.account_id');
            $query = $this->db->get();  

            return $query->first_row('array');
        }

        //Updates Info in the database
        public function edit_profile($data)
        {
          $update = array(

            'address' => $data['address'],
            'contact_number' => $data['contact_number']

          );
          
          $this->db->where('username',$data['username']);
          $this->db->update('account',$update);

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
    $config['next_prev_url'] = base_url().'chairperson/calendar_chairperson';
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
  }



?>