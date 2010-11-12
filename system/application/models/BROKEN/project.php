<?php
class Project extends DataMapper {
  var $has_one = array('user');
  // TODO: add comments

  function __construct() {
    parent::DataMapper();
  }
}

?>
