<?php
class Project extends DataMapper {
  var $has_one = array('user', 'projecttext');
  // TODO: add comments

  function __construct() {
    parent::DataMapper();
  }
}

?>
