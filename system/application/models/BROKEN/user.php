<?php
class User extends DataMapper {
  // TODO: add project
  var $has_many = array('project');

  function __construct() {
    parent::DataMapper();
  }
}

?>
