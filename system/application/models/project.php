<?php
class Project extends DataMapper {
  var $has_one = array('user', 'projecttext');
  // TODO: add comments

//  var $validation = array(
//    'title' => '

  

  function __construct() {
    parent::DataMapper();
  }
}

?>
