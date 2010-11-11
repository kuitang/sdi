<?php
class Hooks {
  private $_CI; 
  function __construct() {
    $this->_CI =& get_instance();
    $this->_CI->load->library('session');
    $this->_CI->load->helper('url');
  }
  
  function login_check() {
    if (isset($GLOBALS['login_check']) && !$this->_CI->session->userdata('uni')) {
        if (!isset($GLOBALS['login_check_exclude'])) {
          $GLOBALS['login_check_exclude'] = array();
        }
        $m = get_instance()->router->method;
        if (!in_array($m, $GLOBALS['login_check_exclude'])) {
          $this->_CI->session->set_userdata('login_redirect', current_url());
          redirect('user/login');
      }
    }
  }
}
?>
