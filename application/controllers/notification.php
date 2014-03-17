<?php
	
	class Notification extends CI_Controller {
	
		public function __construct() {
			error_reporting(0);
			parent::__construct();
		}

		public function notify() {
			header("Content-Type: text/event-stream");
			header("Cache-Control: no-cache");
			header("Access-Control-Allow-Origin: *");

			$lastEventId = floatval(isset($_SERVER["HTTP_LAST_EVENT_ID"]) ? $_SERVER["HTTP_LAST_EVENT_ID"] : 0);
				if ($lastEventId == 0) {
					$lastEventId = floatval(isset($_GET["lastEventId"]) ? $_GET["lastEventId"] : 0);
				}

			echo ":" . str_repeat(" ", 2048) . "\n"; // 2 kB padding for IE
			echo "retry: 2000\n";
		}

/* PARENT NOTIFICATION */
		public function notification_to_parent() {
				
			$this->notify();

			$data['parentInfo'] = $this->session->userdata['logged_in'];
			$data['parent_id'] = $data['parentInfo']['parent_id'];

			$data['notify'] = $this->notification_model->notification_parent($data);

			echo "data: ".json_encode($data['notify'])."\n\n";
			ob_flush();
	    	flush();
	    	sleep(1);
		}

/* UPDATE NOTIFICATION OF PARENT */
		public function notification_update_parent() {
			
			$data['parentInfo'] = $this->session->userdata['logged_in'];
			$data['parent_id'] = $data['parentInfo']['parent_id'];
			
			$data['id_for_update'] = $_POST['id'];
			//$data['new_notification'] = $this->notification_model->notification_update_parent($data);

			echo json_encode($data['id_for_update']);
		}

/* STUDENT NOTIFICATION */
		public function notification_to_student() {

			$this->notify();

			$data['studentInfo'] = $this->session->userdata['logged_in'];
			$data['account_id'] = $data['studentInfo']['account_id'];

			$data['notify'] = $this->notification_model->notification_student($data);

			echo "data: ".json_encode($data['notify'])."\n\n";
			ob_flush();
		    flush();
		    sleep(1);
		}

/* UPDATE NOTIFICATION OF STUDENT */
		public function notfication_update_student() {

			$data['studentInfo'] = $this->session->userdata['logged_in'];
			$data['account_id'] = $data['studentInfo']['account_id'];

			$data['id_for_update'] = $_POST['id'];

			$data['new_notification'] = $this->sdpc_model->notification_update_student($data);

			echo json_encode($data['new_notification']);
		}

/* TEACHER NOTIFICATION */
		public function notification_to_teacher() {
			
			$this->notify();

			$data['teacherInfo'] = $this->session->userdata['logged_in'];
			$data['faculty_id'] = $data['teacherInfo']['faculty_id'];

			$data['notify'] = $this->notification_model->notification_teacher($data);

			echo "data: ".json_encode($data['notify'])."\n\n";
			ob_flush();
	    flush();
	    sleep(1);
		}

/* UPDATE NOTIFICATION OF TEACHER */
		public function notification_update_teacher() {
			
			$data['teacherInfo'] = $this->session->userdata['logged_in'];
			$data['faculty_id'] = $data['teacherInfo']['faculty_id'];

			$data['id_for_update'] = $_POST['id'];
			$data['new_notification'] = $this->notification_model->notification_update_teacher($data);

			echo json_encode($data['new_notification']);
		}

		public function viewCandidates() {	

				$data['viewSubjects'] = $this->notification_model->viewSubjects();
				$data['viewStudentAttendance'] = $this->notification_model->viewCandidates();
		}

		public function notifyCandidate() {

			$data['id'] = $_GET['id'];

			$data['studentInfo'] = $this->notification_model->studentInfo($data); // Gets student data
			 
			$data['parentInfo'] = $this->notification_model->parentOfStudent($data); // Gets parent data
			$data['teacherInfo'] = $this->notification_model->teacherOfStudent($data); // Gets teacher data

			foreach($data['studentInfo'] as $student) {
				$data['student_number'] = $student['student_number'];
				$data['name'] = $student['first_name']." ".$student['last_name'];
			}

			$data['countAbsences'] = $this->notification_model->countAbsences($data); // Counts the number of absences of the specified student number in attendanace table

			foreach($data['teacherInfo'] as $teacher) {
				$data['faculty_id'] = $teacher['faculty_id'];
				$data['subject_description'] = $teacher['subject_description'];
			}

			foreach($data['parentInfo'] as $parent) {
				$data['parent_id'] = $parent['parent_id'];
			}
			
			// echo "<pre>";
			// print_r($data['countAbsences']);
			// echo "</pre>";
			
			$data['notify'] = $this->notification_model->notifyCandidate($data);

			$this->load->view('sdpc/viewsdpc');

		}

	}

?>