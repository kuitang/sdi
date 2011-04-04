<?php

class Project extends DataMapper {
  var $has_one = array('user');
  var $has_many = array('tag');
  // TODO: add comments

  var $validation = array(
    'title' => array(
      'label' => 'Project Title',
      'rules' => array('trim', 'required')
    ),
    'start_date' => array(
      'label' => 'Start Date (if applicable)',
    ),
    'end_date' => array(
      'label' => 'End Date (if applicable)',
    ),
    'field' => array(
      'label' => 'Field/Discipline (type for suggestions)',
      #'rules' => array('required')
    ),
    'type' => array(
      'label' => 'Type of Project',
      #'rules' => array('required'),
    ),
    'location' => array(
      'label' => 'Location',
      #'rules' => array('required'),
    ),
#    'map' => array(
#      'label' => 'Map',
#      'type' => 'googlemap'
#    ),
    'show_contact' => array(
      'label' => 'Show Scholars Your Contact Info',
      # TODO: Investigate why this fails.
      #'rules' => array('required'),
      'type' => 'radio',
      'values' => array('yes', 'no'),
    ),
    'text' => array(
      'label' => 'Description',
      'type' => 'textarea',
      'rules' => array('trim', 'required', 'min_length' => 5)
    ),
    # Relations
  );

  function __construct() {
    parent::DataMapper();
  }

}

?>
