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

        public function viewSDPC($data)
        {
            $this->db->select();
            $this->db->from('offering');          
            $this->db->join('study_load','study_load.offer_code = offering.offer_code');
            $this->db->join('students','students.student_number = study_load.student_number');
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
            $this->db->join('students', 'students.student_number = attendance.student_number');
            $this->db->where('offer_code', $data['offer_code']);
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