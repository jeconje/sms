<?php
	class Dean_model extends CI_Model 
  {
        //Redirect Login
        public function loginDean($username, $password) {
           $this -> db -> select(); 
           $this -> db -> from('account');              
           $this -> db -> where('account_id', $username);
           $this -> db -> where('password', $password);

           $query = $this -> db -> get();
           $result = $query -> first_row('array');

           return $result;
        }
        
        //View dean's Info
        public function deanInfo($data) {
          $this-> db -> select();
          $this-> db -> from('faculty');
          $this-> db -> where('faculty_id',$data['account_id']);
          $query = $this -> db -> get();
          $result = $query -> first_row('array');

          return $result;
        }

        
        //Get specfic college
        public function get_college($data) {
          $this-> db -> select();
          $this-> db -> from('college');
          $this-> db -> join('faculty', 'college.college_id = faculty.college_id');
          $this-> db -> where('faculty.college_id', $data['college_id']);

          $query = $this -> db -> get();
          $result = $query -> first_row('array');

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

        //View Study Load
        public function viewStudyLoad($data)  {
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

        public function viewStudents($data)
        {
            $this->db->select();
            $this->db->from('study_load');
            $this->db->join('students','students.student_number = study_load.student_number');
            $this->db->where('study_load.offer_code',$data['id_code']);
            $this->db->order_by('last_name');
            $query = $this->db->get();
            $result = $query -> result_array();
            return $result;
        }

        public function studentsStudyLoad()
        {
            $this->db->select();
            $this->db->from('study_load');
            $query = $this->db->get();
            $result = $query -> result_array();

            return $result;
        }

        public function viewClasses($data) {
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
    //Get subjects
    public function get_subject($data) 
    {
      $this->db->select()->from('subjects');
      $this->db->order_by('subject_description');
      $this->db->join('offering', 'subjects.subject_code = offering.subject_code');
      $this->db->where('faculty_id', $data['faculty_id']);

      $query = $this->db->get();

      return $query->result();
    }

    //Get offer codes based on subjects
    public function get_offer_code($data) 
    {
      $this->db->select();
      $this->db->from('subjects');
      $this->db->where(array('subject_code' => $data['subject']));

      $query = $this->db->get();
      $subject = $query->result_array();

      $id = array(0=>0);
      foreach ($subject as $value) 
      {
        $id[$value['subject_code']] = $value['subject_code'];
      }
  
      $this->db->select()->from('offering');
      $this->db->where('faculty_id', $data['faculty_id']);
      $this->db->where_in('subject_code',$id);

      $query = $this->db->get();

      return $query->result();
    }

        public function viewAttendance($data)
        { 
          $this->db->select();
          $this->db->from('attendance');
          $this->db->where('offer_code',$data['id_code']);

          $query = $this->db->get();
          $result = $query -> result_array();

          return $result;          

        }

        public function viewCampusLogin($data)
        {
          $this->db->select();
          $this->db->from('campus_login');                
          $this->db->order_by('log_id','asc');          
          $query = $this->db->get();
          $result = $query -> result_array('array');

          return $result;  
        }

        public function insertAttendance($data)
        {          
            date_default_timezone_set('Asia/Manila');                  
            
            $date = date('Y-m-d');    
                  for ($i=1; $i < 41 ; $i++) { 
                 
                      if($data['a'.$i] == 'L' || $data['a'.$i] == 'A'){
                      $insert = array (                            
                          
                          'offer_code' => $data['id_code'],
                          'attendance' => $data['a'.$i],
                          'date' => $date,
                          'student_number' => $data['student_number'.$i], 
                          
                       );   
                          $this->db->insert('attendance',$insert);        
                       }
                 }

        }

        public function updateSeat($data)
        {
            for ($i=1; $i <41 ; $i++) {                       
                $update = array (
                        'seat_number' => $i
                 );
                $this->db->where('offer_code',$data['id_code']);
                $this->db->where('student_number',$data['a'.$i]);
                $this->db->update('study_load',$update);          
            }            
        }

        public function viewDistinctLogs($data)
        {
          $this->db->distinct();
          $this->db->select ('date');
          $this->db->from('attendance');
          $this->db->join('offering','attendance.offer_code = offering.offer_code');
          $this->db->join('subject','subject.offer_code = offering.offer_code');
          $this->db->where('faculty_id',$data['faculty_id']);
          $this->db->order_by('attendance.date',desc);
          $query = $this->db->get();
          $result = $query -> result_array();
          return $result;

        }

        public function viewLogs($data)
        {          
          $this->db->select ();
          $this->db->from('attendance');
          $this->db->join('offering','attendance.offer_code = offering.offer_code');
          $this->db->join('subject','subject.offer_code = offering.offer_code');
          $this->db->join('students','attendance.student_number = students.student_number');          
          $this->db->where('attendance.date',$data['date']);          
          $this->db->where('faculty_id',$data['faculty_id']);

          $this->db->order_by('subject.subject_description');
          $query = $this->db->get();
          $result = $query -> result_array();
          return $result;
        }       

        public function viewSearchedLogs($data)
        {          
          $this->db->select ();
          $this->db->from('attendance');
          $this->db->join('offering','attendance.offer_code = offering.offer_code');
          $this->db->join('subject','subject.offer_code = offering.offer_code');
          $this->db->join('students','attendance.student_number = students.student_number');     
          $this->db->where('subject.subject_description',$data['subject'])     ;
          $this->db->where('attendance.date',$data['date']);          
          $this->db->where('faculty_id',$data['faculty_id']);          
          $this->db->order_by('subject.subject_description');
          $query = $this->db->get();
          $result = $query -> result_array();
          return $result;
        }

        public function updateAttendance($data)
        {
          $update = array (
                        'attendance' => 'X'
                    );
          $this->db->where('attendance_id',$data['attendance_id']);
          $this->db->update('attendance',$update);
        }

        public function viewAssignedStudents($data)
        {               
              $this->db->select();
              $this->db->from('study_load');
              $this->db->join('students','students.student_number = study_load.student_number');
              $this->db->where('offer_code',$data['id_code']);                      
              $query = $this->db->get();
              $result = $query -> result_array();

              return $result;
       }     

       public function viewViolation($data)
       {
            $this->db->select();
            $this->db->from('violation');
            $this->db->join('students','violation.student_number = students.student_number ');                                
            $query = $this->db->get();
            $result = $query -> result_array();

            return $result;
       }      

       public function viewSuspension($data)
       {

            $this->db->select();
            $this->db->from('suspend');
            $this->db->join('students','suspend.student_number = students.student_number ');                                
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
    $config['next_prev_url'] = base_url().'dean/calendar_dean';
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