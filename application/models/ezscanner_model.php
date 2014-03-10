<?php
	class Ezscanner_model extends CI_Model 
	{
		public function add_login() 
	    {
	    	date_default_timezone_set('Asia/Manila');
	        $date = date('Y-m-d');
	        $datestring = "%h:%i:%s %A";
	        $time = time();

			$hala = mdate($datestring,$time);

	    	$time_in = array(
	    						'student_number' => $this->input->post('student_number'),
	    					 	'date' => $date,
	    					 	'time_in' => $hala
	    					);

		    $this->db->insert('campus_login',$time_in);
		}

		public function add_logout() 
	    {
	    	date_default_timezone_set('Asia/Manila');
	        $date = date('Y-m-d');
	        $datestring = "%h:%i %A";
	        $time = time();

	    	$hala = mdate($datestring,$time);


	    	$time_out = array(
	    						'student_number' => $this->input->post('student_number'),
	    					 	'date' => $date,
	    					 	'time_out' => $hala
	    					);	

		    $this->db->insert('campus_login',$time_out);
		}
	}
?>