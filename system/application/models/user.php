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
      'rules' => array('trim', 'required', 'unique', 'alpha_numeric', 'max_length' => 7)
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
    )
  );



  function __construct() {
    parent::DataMapper();
  }
}

?>
