<?php 
	class Ezscanner extends CI_Controller 
	{
		public function __construct() 
		{
			parent::__construct();
		}

		public function index() 
		{
			$this->load->view('pages/ezscanner');
		}

		public function log() 
		{
			$log = $this->input->post('status');

			if($log == 'login')
			{
				$this->ezscanner_model->add_login(); 
				redirect('ezscanner','refresh');
			}
			else
			{
				$this->ezscanner_model->add_logout();
				redirect('ezscanner','refresh');
			}
		}
	}
?>