<?php
class Projecttext extends DataMapper {
  var $has_one = array('project');

  var $validation = array(
    'text' => array(
      'label' => 'Describe your project in detail.',
      'type'  => 'textarea',
      'rules' => array('trim', 'required', 'min_length' => 500)
    ));
  
  function __construct() {
    parent::DataMapper();
  }
}

?>
