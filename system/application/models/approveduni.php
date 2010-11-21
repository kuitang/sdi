<?php
class Approveduni extends DataMapper {
  var $validation = array(
    'uni' => array('label' => 'UNI', 
                   'rules' => array('required', 'unique', 'alpha_numeric', 'max_length' => 7)));

  function __construct() {
    parent::DataMapper();
  }
}

?>
  
