<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller 
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed. User redirected to login page
            $this->load->view('pages/signin');
        }

        else            
        {   
                $data['info'] = $this->session->userdata('logged_in');                    
                
                if($data['info']['account_type'] == 'tracker')
                    redirect('parents/profile', 'refresh');
                else if($data['info']['account_type'] == 'teacher')
                    redirect('teacher/profile', 'refresh');
                else if($data['info']['account_type'] == 'student')
                    redirect('sms/profile', 'refresh');
                else if($data['info']['account_type'] == 'chairperson')
                    redirect('chairperson/profile', 'refresh');
                else if($data['info']['account_type'] == 'dean')
                    redirect('dean/profile', 'refresh');
                else if($data['info']['account_type'] == 'sao')
                    redirect('sao/profile', 'refresh');
                else if($data['info']['account_type'] == 'sdpc')
                    redirect('sdpc/profile', 'refresh');
                else if($data['info']['account_type'] == 'admin')
                    redirect('admin/profile', 'refresh');
                else
                   //If no session, redirect to login page
                    redirect('sms/profile', 'refresh');
        }
    }

    function check_database($password)
    {
        //Field validation succeeded. Validate against database
        $username = $this->input->post('username');
    
        //query the database
        /*$student = $this->sms_model->loginStudent($username, $password);        
        $parent = $this->parent_model->loginParent($username, $password); */
        $teacher = $this->teacher_model->loginTeacher($username, $password);
<<<<<<< HEAD
      /*  $chairperson = $this->chairperson_model->loginChairperson($username, $password);
        $dean = $this->dean_model->loginDean($username, $password);
=======
        // $chairperson = $this->chairperson_model->loginChairperson($username, $password);
        // $dean = $this->dean_model->loginDean($username, $password);
>>>>>>> f462cf19253c920088117b16b9f861b5fe86d515
        $sao = $this->sao_model->loginSao($username, $password); 
        $sdpc = $this->sdpc_model->loginSdpc($username, $password);
        $admin = $this->admin_model->loginAdmin($username, $password);  */     
        
        if($student)
        {
            $this->session->set_userdata('logged_in', $student);
        }
        else if($parent)
        {
            $this->session->set_userdata('logged_in', $parent);
        }
        else if($teacher)
        {
            $this->session->set_userdata('logged_in', $teacher);
        }
        // else if($chairperson)
        // {
        //     $this->session->set_userdata('logged_in', $chairperson);
        // }
        // else if($dean)
        // {
        //     $this->session->set_userdata('logged_in', $dean);
        // }
        else if($sao)
        {
            $this->session->set_userdata('logged_in', $sao);
        }
        else if($sdpc)
        {
            $this->session->set_userdata('logged_in', $sdpc);
        }
        else if($admin)
        {
            $this->session->set_userdata('logged_in', $admin);
        }

        else
        {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }
}
?>
