<?php

class Users extends Controller {
  function __construct() {
    parent::Controller();
    $GLOBALS['login_check'] = 1;
    $GLOBALS['login_check_exclude'] = array('signup', 'profile', 'login', 'logout');
    $this->load->library('form');
  }

  function login() {
    $this->form
      ->open('users/login')
      ->text('uni', 'UNI' ,'trim|required|alpha_numeric|max_length[7]')
      ->pass('password', 'Password', 'required')
      ->submit();
    $data['title']  = 'Login';
    $data['form']   = $this->form->get();
    $data['errors'] = $this->form->errors;
    
    /* If we are submitted a valid form, login us in */
    if ($this->form->valid) {
      $this->session->set_userdata('uni', $this->input->post('uni'));
      $redirect_url = $this->session->userdata('login_redirect');
      $this->session->unset_userdata('login_redirect');
      redirect($redirect_url);
    } else {
      /* If the form is invalid, or not shown, show this form */
      $this->load->view('form.php', $data);
    }
  }
  
  function logout() {
    $this->session->sess_destroy();
    redirect();
  }

  function signup() {
    // TODO: Implement proper logins.

    $this->form
      ->open('users/signup')
      ->text('full_name', 'Full Name', 'trim|required')
      ->text('major', 'Major (no abbreviations)', 'trim|required')
      ->text('year', 'Graduation Year (20xx)', 'trim|required|integer|exact_length[4]')
      ->text('uni', 'UNI' ,'trim|required|alpha_numeric|max_length[7]')
      ->pass('password','Desired Password (NOT Columbia password!)', 'required|min_length[8]')
      ->pass('confirm', 'Confirm Password', 'required|matches[password]')
      ->submit();

    $data['title'] = 'Sign up';
    $data['form'] = $this->form->get();
    $data['errors'] = $this->form->errors;
    if ($this->form->valid) {
      /* Make the new object */
      $u = new User();
      // TODO: Automatize this once you know this works.
      $u->uni       = $this->input->post('uni');
      $u->full_name = $this->input->post('full_name');
      $u->major     = $this->input->post('major');
      $u->year      = $this->input->post('year');
      $u->password  = $this->input->post('password');
      $u->verify_token = base_convert(rand(0, 10000), 10, 36);
      log_message('debug', 'Got to ' . __LINE__ . ' in ' . __FILE__);
      $u->save();

      /* Output */
      $this->session->set_flashdata('msg', 'Please check your email to activate your account once you have been confirmed as a Scholar.');
      redirect();
    } else {
      $this->load->view('form.php', $data);
    }
  }

  
  function approve() {
  }

  function profile($user_id) {
  }
  
  function editprofile() {
  }
}

?>
