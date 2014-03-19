<?php

  class Notification_model extends CI_Model {

    public function studentInfo($data) {
      $this->db->select();
      $this->db->from('students');
      // $this->db->join('account','students.account_id = account.account_id');
      $this->db->where('students.account_id', $data['id']);
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

    public function teacherOfStudent($data) {
      $this->db->select();
      // $this->db->from('study_load');
      // //$this->db->join('attendance','study_load.student_number = attendance.student_number');
      // $this->db->join('offering','study_load.offer_code = offering.offer_code');
      // $this->db->join('students','study_load.student_number = students.student_number');
      // $this->db->join('account','students.account_id = account.account_id');
      // $this->db->where('account.account_id',$data['id']);

      // $this->db->from('attendance');
      // $this->db->join('study_load','attendance.offer_code = study_load.offer_code');
      // $this->db->join('offering','study_load.offer_code = offering.offer_code');
      // $this->db->join('students', 'attendance.student_number = students.student_number');
      // $this->db->join('account','students.account_id = account.account_id');
      // $this->db->where('account.account_id',$data['id']);

      $this->db->from('attendance');
        $this->db->join('offering','attendance.offer_code = offering.offer_code');
        $this->db->join('subject','subject.offer_code = offering.offer_code');
        $this->db->join('students','attendance.student_number = students.student_number');

      $query = $this->db->get();
      $result = $query->result_array();

      return $result;
    }

    public function parentOfStudent($data) {
      $this->db->select();
      $this->db->from('tracker');
      $this->db->join('parent','tracker.parent_id = parent.parent_id');
      $this->db->join('account','parent.account_id = account.account_id');
      $this->db->where('tracker.account_id',$data['id']);

      $query = $this->db->get();
      return $query->result_array();
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

    public function notification_teacher($data) {
      $this->db->select();
      $this->db->from('notifications');
      $this->db->where(array(
                              'faculty_id' => $data['faculty_id'],
                              'seen' => 'no'
                            ));

        $query = $this->db->get();

        return $query->result_array();
    }

    public function notification_update_teacher($data) {
      for($x=0; $x < count($data['notification_id']); $x++) {
        $noti_update = array('seen'=>'yes');
        $this->db->where(array(
                                'faculty_id' => $data['faculty_id'], 
                                'notification_id' => $data['id_for_update'][$x]
                              ));
        $this->db->update('notifications',$noti_update);
      }

      $this->db->select()->from('notifications')->where(array('faculty_id' => $data['faculty_id']));
      $query = $this->db->get();

      return $query->result_array();
    }

    public function viewSubjects() {
      $this->db->select();
      $this->db->from('offering');
      $this->db->join('study_load','offering.offer_code = study_load.offer_code');
      $this->db->join('students','study_load.student_number = students.student_number');
      $this->db->join('tracker','students.account_id = tracker.account_id');
      $this->db->join('parent','tracker.parent_id = parent.parent_id');
      $this->db->join('subject','offering.offer_code = subject.offer_code');                          
      
      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;
    }

    public function viewClasses() {
      $this->db->select();
      $this->db->from('offering');
      $this->db->join('subject','offering.offer_code = subject.offer_code');
      
      $query = $this->db->get();
      $result = $query -> result_array();

      return $result;
    }

    public function countAbsences($data) {
      $this->db->select();
      $this->db->from('attendance');
      $this->db->join('students','attendance.student_number = students.student_number');
      $this->db->join('account','students.account_id = account.account_id');
      $this->db->where(array('attendance.student_number' => $data['student_number'], 'attendance' => 'A'));

      $query = $this->db->get();
      $result = $query->num_rows($query);

      return $result;
    }

    public function notifyCandidate($data) {

      date_default_timezone_set('Asia/Manila');
      $date = date('Y-m-d');

      $data['student'] = array(
                              'account_id' => $data['id'],
                              'parent_id' => '0',
                              'faculty_id' => '0',
                              'date' => $date,
                              'message' => "You already have ".$data['countAbsences']." in ".$data['subject_description'],
                              'seen' => 'no'
                              );

      $data['teacher'] = array(
                              'account_id' => '0',
                              'parent_id' => '0',
                              'faculty_id' => $data['faculty_id'],
                              'date' => $date,
                              'message' => "Your student ".$data['name']." has already ".$data['countAbsences']." absences in your subject ".$data['subject_description'],
                              'seen' => 'no'
                              );
      
      foreach($data['parentInfo'] as $parent) {
        $data['parent'] = array(
                                'account_id' => '0',
                                'parent_id' => $data['parent_id'],
                                'faculty_id' => '0',
                                'date' => $date,
                                'message' => "Your child ".$data['name']." has already ".$data['countAbsences']." in ".$data['subject_description'],
                                'seen' => 'no'                              
                                );
        $this->db->where('parent_id', $parent['parent_id']);
        $this->db->insert('notifications', $data['parent']);
      }

      $this->db->where('account_id',$data['id']);
      $this->db->insert('notifications',$data['student']);
      $this->db->insert('notifications', $data['teacher']);
      
    }
}
?>