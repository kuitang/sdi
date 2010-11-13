<?php

class Home extends Controller {
  function __construct() {
    parent::Controller();
    $this->load->helper('form');
#    $GLOBALS['login_check'] = TRUE;
//    $this->load->database();
  }
/*
  function _remap($func) {
    if ($func != 'login') {


  function _check_login() {
    if ($this->session->userdata('uni') == FALSE) {
      $this->session->set_userdata('login_callback', 
*/
  function index() {
    $data['title'] = 'Home';
    $this->load->view('home_index', $data);
  }

  function info() {
    echo phpinfo();
  }
  
  function cgi_info() {
    echo '<pre>';
    echo passthru("php --info");
    echo '</pre>';
  }

  function db() {
    echo "Got here";
    $this->load->database();
    echo "Can't get here";
  }

  function models() {
    $t = new Tag();
    $t->get();
    foreach ($t->all as $myt) {
      echo $myt;
    }
  }

  function db2() {
    $q = $this->db->get('tags');
    var_dump($q);
  }

}
?>
