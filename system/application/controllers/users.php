<?php

class Users extends Controller {
  function __construct() {
    parent::Controller();
    $GLOBALS['login_check'] = 1;
    $GLOBALS['login_check_exclude'] = array('signup', 'profile', 'login', 'logout');
    $this->load->helper('datamapper');
  }

  // Implements challenge-response authentication.
  // TODO: Abstract out.
  function login() {
    $u = new User();
    $data['title'] = 'Login';
    $error = FALSE;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $u->where('uni', $this->input->post('uni'))->get();
      if (!empty($u->id)) {
        $expected_response = hash_hmac('sha1',
                                       $u->password, 
                                       $this->session->userdata('challenge'));
        $this->session->unset_userdata('challenge');
        if ($this->input->post('pwhash') === $expected_response) {
          // success
          $this->_login_success($u->uni); 
        } else if (hash_hmac('sha1', $this->input->post('password'),
                    $this->config->item('server_salt'))  === $u->password) {
          // If the client had no javascript, we hash the cleartext password.
          $this->session->set_flashdata('msg', "Your password was sent in cleartext because you did not enable Javascript. Please enable Javascript for security.");
          $this->_login_success($u->uni);
        } else {
          $error = TRUE;
        }
      } else {
        $error = TRUE;
      }
    }
    if ($error) {
      $data['errors'] = '<div class="error">Invalid username or password.</div>';
    }
    $challenge = uniqid(rand());
    $this->session->set_userdata('challenge', $challenge); 
    // Remember: passwords are stored on server hashed with server_salt.
    // So hash order = hash(challenge + hash(server_salt + password))
    $data['form'] = $u->render_form(array(
      'uni',
      'password',
      'server_salt' => array ('value' => $this->config->item('server_salt')),
      'challenge'   => array ('value' => $challenge),
      'pwhash' 
    ));
    $this->load->view('form_password.php', $data); 
  }

  function _login_success($uni) {
    $this->session->set_userdata('uni', $uni);
    $redirect_url = $this->session->userdata('login_redirect');
    $this->session->unset_userdata('login_redirect');
    redirect($redirect_url);
  }
  
  function logout() {
    $this->session->sess_destroy();
    redirect();
  }
  
  function signup() {
    $u = new User();
    $fields_render = array('full_name', 'uni', 'year', 'major',
      'password', 'confirm', 'pwhash', 'server_salt' => array(
        'value' => $this->config->item('server_salt')));
    $data['title'] = 'Sign up';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $u->from_array($_POST, $fields_render);
      // Special case password handling.
      if ($this->input->post('pwhash')) {
        $u->password = $this->input->post('pwhash');
      } else if ($this->input->post('password')) {
        $u->password = User::hash($this->input->post('password'));
        // Also has the confirm field
        $u->confirm  = User::hash($this->input->post('confirm'));
        $this->session->set_flashdata('msg', "Your password was sent in cleartext because you did not enable Javascript. Please enable Javascript for security.");
      }
      
      if($u->save()) { //validation rules run
        $this->_signup_success();
      } else {
        $data['error'] = $u->error->string;
      }
    }
    // Otherwise, or if error, render a form
    $data['form'] = $u->render_form($fields_render);
    $this->load->view("form_password.php", $data);
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
