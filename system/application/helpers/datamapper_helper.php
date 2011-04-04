<?php

function render_write_form($p, $data = array()) {
  $data['title'] = $p['title'];
  $model = new $p['model']();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->from_array($_POST, $p['form_fields']);
    $model->id;
    if($model->save()) { // validation rules run
      call_user_func(array($p['self'], $p['on_success']));
    } else { // invalid
      $data['error'] = $model->error->string;
    }
  }
  // Otherwise just render a form.
  $data['form'] = $model->render_form($p['form_fields']);
  $p['self']->load->view($p['view'], $data);
}

?>
