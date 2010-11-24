<?php
// Example
//     return "<input type=\"text\" id=\"$field\" name=\"$field\" value=\"$value\" onFocus=\"showCalendar(this);\" onBlur=\"hideCalendar(this);\" />";

function input_datepicker($object, $field, $value, $options) {
  $js = "<script>$(function() { $( \".datepicker\" ).datepicker(); });</script>";
  return "$js <input type=\"text\" id=\"$field\" name=\"$field\" value=\"$value\" class=\"datepicker\" onFocus=\"datepicker();\"/>";
}
function input_googlemap($object, $field, $value, $options) {
  $text = '<input type="text" id="googlemap-address" name="googlemap-address" />';
  $map  = '<div id="map-canvas" style="width:500px; height:300px"></div>';
  $js = <<<END
<script>
 $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
 $('#googlemap-address').keyup(function(e) {
  if(e.keyCode == 13) {
    alert('Enter key was pressed.');
  }
}); 
$('#googlemap-address').submit(function() {
  return false;
});
 });
</script>
END;
  return "$js $text $map";
}
function input_tagset($object, $field, $value, $options) {
  return "<p>TODO: Not implemented (_tagset())</p>";
}

class Project extends DataMapper {
  var $has_one = array('user');
  var $has_many = array('tags');
  // TODO: add comments

  var $validation = array(
    'title' => array(
      'label' => 'Project Title',
      'rules' => array('trim', 'required')
    ),
    'start_date' => array(
      'label' => 'Start Date (if applicable)',
      'type'  => 'datepicker'
    ),
    'end_date' => array(
      'label' => 'End Date (if applicable)',
      'type' => 'datepicker'
    ),
    'field' => array(
      'label' => 'Field/Discipline',
      'type' => 'tagset',
      'rules' => array('required')
    ),
    'type' => array(
      'label' => 'Type of Project',
      'type' => 'tagset',
      'rules' => array('required'),
    ),
    'location' => array(
      'label' => 'Location',
      'type' => 'tagset',
      'rules' => array('required')
    ),
    'location_lat' => array(
      'type' => 'hidden',
      'rules' => array('trim', 'required')
    ),
    'location_lon' => array(
      'type' => 'hidden',
      'rules' => array('trim', 'required')
    ),
    'map' => array(
      'label' => 'Map',
      'type' => 'googlemap'
    ),
    'text' => array(
      'label' => 'Description',
      'type' => 'textarea',
      'rules' => array('trim', 'required', 'min_length' => 500)
    )
  );

  function __construct() {
    parent::DataMapper();
  }

}

?>
