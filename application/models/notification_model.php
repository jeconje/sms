<?php

  class Notification_model extends CI_Model {

    public function studentInfo() {
      $this->db->select();
      $this->db->from('students');
      $this->db->join('account','students.account_id = account.account_id');
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }

    public function parentInfo() {
      $this->db->select();
      $this->db->from('parent');
      $this->db->join('account','parent.account_id = account.account_id');
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }

    public function teacherInfo() {
      $this->db->select();
      $this->db->from('faculty');
      $this->db->join('account','faculty.account_id = account.account_id');
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }

    public function subjectInfo() {
      $this->db->select();
      $this->db->from('subject');
      $this->db->join('offering','subject.offer_code = offering.offer_code');
      $this->db->join('faculty','offering.faculty_id = faculty.faculty_id');
      $this->db->join('account','faculty.account_id = account.account_id');
      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }

    public function notification_parent($data) {
      $this->db->select();
      $this->db->from('notifications');
      $this->db->where(array(
                              'parent_id' => $data['parent_id'],
                              'seen' => 'no'
                            ));

      $query = $this->db->get();

      return $query->result_array();
    }

    public function notification_update_parent($data) {
      for($x=0; $x < count($data['id_for_update']); $x++) {
        $noti_update = array('seen' => 'yes');
        $this->db->where(array(
                                'parent_id' => $data['parent_id'], 
                                'notification_id' => $data['id_for_update'][$x]
                              ));

        $this->db->update('notifications',$noti_update);
      }

      $this->db->select()->from('notifications')->where(array('parent_id' => $data['parent_id']));
      $query = $this->db->get();

      return $query->result_array();  
    }

    public function notification_student($data) {
      $this->db->select();
      $this->db->from('notifications');
      $this->db->where(array(
                              'account_id' => $data['account_id'],
                              'seen' => 'no'
                            ));

        $query = $this->db->get();

        return $query->result_array();
    }

    public function notification_update_student($data) {
      for($x=0; $x < count($data['notification_id']); $x++) {
        $noti_update = array('seen'=>'yes');
        $this->db->where(array(
                                'account_id' => $data['account_id'], 
                                'notification_id' => $data['id_for_update'][$x]
                              ));
        $this->db->update('notifications',$noti_update);
      }

      $this->db->select()->from('notifications')->where(array('account_id' => $data['account_id']));
      $query = $this->db->get();

      return $query->result_array();
    }

    public function student_parent($data)
    {
        $this->db->select();
        $this->db->from('attendance');
        $this->db->join('students','students.student_number = attendance.student_number');
        $this->db->join('tracker','tracker.account_id = students.account_id');
        //$this->db->join('parent','parent.parent_id = tracker.parent_id');
        $this->db->where('account_id',$data['account_id']);  
        $this->db->where('parent_id',$data['parent_id']);  

        $query = $this->db->get();
        $result = $query -> result_array();
    
        return $result;
    }

    public function student_teacher($data)
    {
      $this->db->select();
      $this->db->from('attendance');
      $this->db->join('offering', 'offering.offer_code = attendance.offer_code');
      $this->db->join('faculty', 'faculty.faculty_id =  offering.faculty_id');
      $this->db->join('account', 'account.account_id = faculty.account_id');

      $this->db->join('students','students.student_number = attendance.student_number');
      $this->db->join('account', 'account.account_id = students.account_id');
      
      $this->db->where('account_id',$data['account_id']);  
      // $this->db->where('parent_id',$data['parent_id']);  

      $query = $this->db->get();
      $result = $query -> result_array();
    
      return $result;      
    }

  }

?>