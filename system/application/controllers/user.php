<?php

class User extends Controller {
  function __construct() {
    parent::Controller();
    $GLOBALS['login_check'] = 1;
    $GLOBALS['login_check_exclude'] = array('signup', 'profile', 'login', 'logout');
    $this->load->library('form');
  }

  function login() {
    $this->form
      ->open('user/login')
      ->text('uni', 'UNI' ,'trim|required|alpha_numeric|max_length[7]')
      ->pass('password', 'Password', 'required')
      ->submit();
    $data['title']  = 'Login';
    $data['form']   = $this->form->get();
    $data['errors'] = $this->form->errors;
    if ($this->form->valid) {
      $this->session->set_userdata('uni', $this->input->post('uni'));
      $redirect_url = $this->session->userdata('login_redirect');
      $this->session->unset_userdata('login_redirect');
      redirect($redirect_url);
    } else {
      $this->load->view('form.php', $data);
    }
    //$this->load->view('home_login.php');
  }
  
  function logout() {
    $this->session->sess_destroy();
    redirect();
  }

  function signup() {

    $this->form
      ->open('user/signup')
      ->text('full_name', 'Full Name', 'trim|required')
      ->text('major', 'Major (no abbreviations)', 'trim|required')
      ->text('year', 'Graduation Year (20xx)', 'trim|required|integer|exact_length[4]')
      ->text('uni', 'UNI' ,'trim|required|alpha_numeric|max_length[7]')
      ->pass('password','Desired Password (NOT Columbia password!)', 'required')
      ->pass('confirm', 'Confirm Password', 'required')
      ->submit()
      ->onsuccess('_postsignup', '');

    $data['title'] = 'Sign up';
    $data['form'] = $this->form->get();
    $data['errors'] = $this->form->errors;
    $this->load->view('form.php', $data);
  }

  function _postsignup() {
    $this->session->flashdata_set('msg', 'Please check your email to activate your account once you have been confirmed as a Scholar.');
    redirect(base_url());
  }
  
  function approve() {
  }

  function profile($user_id) {
  }
  
  function editprofile() {
  }
}

?>
