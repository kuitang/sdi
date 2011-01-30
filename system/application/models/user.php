<?php
class User extends DataMapper {
  // TODO: add project
  var $has_many = array('project');
  var $validation = array(
    /* Validators for forms have a 'type' key. This is implicity just text. */
    'full_name' => array(
      'label' => 'Full Name',
      'rules' => array('trim', 'required')
    ),
    'major' => array(
      'label' => 'Major',
      'rules' => array('trim', 'required')
    ),
    'year' => array(
      'label' => 'Graduation Year (20xx)',
      'rules' => array('trim', 'required', 'integer', 'exact_length' => 4)
    ),
    'uni' => array(
      'label' => 'UNI',
      'rules' => array('trim', 'required', 'unique', 'alpha_numeric', 'max_length' => 7, 'is_approved')
    ),
    'password' => array(
      'label' => 'Password (NOT Columbia)',
      'type'  => 'password',
      'rules' => array('required', 'min_length' => 8)
    ),
    'confirm' => array(
      'label' => 'Confirm Password',
      'type'  => 'password',
      'rules' => array('required', 'matches' => 'password')
    ), 
    /* These fields are for Challenge-Response authentication and would not
       be present for any other model. */
    'server_salt' => array( 'type'  => 'hidden',),
    'challenge' => array( 'type'  => 'hidden',),
    'pwhash'    => array( 'type' => 'hidden',),
  );
  
  public static function hash($pass) {
    return hash_hmac('sha1', $pass, get_instance()->config->item('server_salt'));
  }

  function _is_approved($field) {
    $approved_unis = new Approveduni();
    $approved_unis->where('uni', $this->{$field})->get();
    if (empty($approved_unis->id)) {
      $this->error_message('uni', "Your UNI was not approved on the Scholars' database.");
      return FALSE;
    } else {
      return TRUE;
    }
  }

  function __construct() {
    parent::DataMapper();
  }
}

?>
