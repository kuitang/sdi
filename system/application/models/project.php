<?php
// Example
//     return "<input type=\"text\" id=\"$field\" name=\"$field\" value=\"$value\" onFocus=\"showCalendar(this);\" onBlur=\"hideCalendar(this);\" />";

function input_datepicker($object, $field, $value, $options) {
  return "<input type=\"text\" id=\"$field\" name=\"$field\" value=\"$value\" class=\"datepicker\"/>";
}
#function input_googlemap($object, $field, $value, $options) {
#  $text = '<input type="text" id="googlemap-address" name="googlemap-address" />';
#  $map  = '<div id="map-canvas" style="width:500px; height:300px"></div>';
#  $js = <<<END
#<script>
# $(document).ready(function() {
#  $(window).keydown(function(event){
#    if(event.keyCode == 13) {
#      event.preventDefault();
#      return false;
#    }
#  });
# $('#googlemap-address').keyup(function(e) {
#  if(e.keyCode == 13) {
#    alert('Enter key was pressed.');
#  }
#}); 
#$('#googlemap-address').submit(function() {
#  return false;
#});
# });
#</script>
#END;
#  return "$js $text $map";
#}

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
      'label' => 'Field/Discipline',
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
