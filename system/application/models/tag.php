<?php
class Tag extends DataMapper {
  //var $has_many = array('projects');
  // TODO: add comments
  var $has_many = array('user', 'project');

  function __construct() {
    parent::DataMapper();
  }
}

?>
