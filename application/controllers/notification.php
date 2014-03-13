<?php
	
	class Notification extends CI_Controller {
	
		public function __construct() {
			//error_reporting(0);
			parent::__construct();
		}

		/*public function getStudentInfo() {
			$data['studentInfo'] = $this->notification_model->studentInfo();
			$data['parentInfo'] = $this->notification_model->parentInfo();
			$data['teacherInfo'] = $this->notification_model->teacherInfo();
			$data['subjectInfo'] = $this->notification_model->subjectInfo();
			
			$data['account_id'] = $data['studentInfo']['account_id'];
			$data['parent_id'] = $data['parentInfo']['parent_id'];
			$data['faculty_id'] = $data['teacherInfo']['faculty_id'];
			$data['offer_code'] = $data['subjectInfo']['offer_code'];
		}*/

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
			$data['new_notification'] = $this->notification_model->notification_update_parent($data);

			echo json_encode($data['new_notification']);
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
	}

?>