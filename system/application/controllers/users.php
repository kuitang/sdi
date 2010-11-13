<?php

class Users extends Controller {
  function __construct() {
    parent::Controller();
    $GLOBALS['login_check'] = 1;
    $GLOBALS['login_check_exclude'] = array('signup', 'profile', 'login', 'logout');
    $this->load->helper('datamapper');
  }

  function login() {
    render_form(array('title' => 'Login',
                      'model' => 'User',
                      'form_fields' => array('uni', 'password'),
                      'self'  => $this,
                      'on_success' => '_login_success')
               );
  }

  function _login_success() {
    $this->session->set_userdata('uni', $this->input->post('uni'));
    $redirect_url = $this->session->userdata('login_redirect');
    $this->session->unset_userdata('login_redirect');
    redirect($redirect_url);
  }
  
  function logout() {
    $this->session->sess_destroy();
    redirect();
  }

  function signup() {
    render_form(array('title' => 'Sign up',
                      'model' => 'User',
                      'form_fields' => array('full_name', 'major', 'year', 'uni', 'password', 'confirm'),
                      'self'  => $this,
                      'on_success' => '_signup_success')
               );
  }
  
  function _signup_success() {
    $this->session->set_flashdata("msg", "Your registration is now pending. You will receive an email when approved.");
    redirect();
  }

  function approve() {
  }

  function profile($user_id) {
  }
  
  function editprofile() {
  }
}

?>
