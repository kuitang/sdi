<?php
class Projecttext extends DataMapper {
  var $has_one = array('project');

  function __construct() {
    parent::DataMapper();
  }
}

?>
