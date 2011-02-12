<?php

class Home extends Controller {
  function __construct() {
    parent::Controller();
    $this->load->helper('datamapper');
    $GLOBALS['login_check'] = 1;
    $GLOBALS['login_check_exclude'] = array('index');
  }

  function _current_user() {
    if ($uid = $this->session->userdata('user_id')) {
      $u = new User();
      $u->where('id', $uid)->get();
      return $u;
    } else {
      redirect();
    }
  }

  function index() {
    $data['title'] = 'Scholars Information Database Home';
    $p = new Project();
    $p->order_by('updated', 'desc')->get(10);
    $data['posts'] = $p;
    $this->load->view('home_index', $data);
  }
    
  function _save_tags($project) {
    $tag = new Tag();
    foreach (array('field', 'type', 'location') as $category) {
      $q = $tag->where('category', $category)
            ->where('category', $_POST[$category]);
      if (empty($q->id)) {
        // Make a new tag
        $qq = new Tag();
        $qq->category = $category;
        # We use , to separate tags
        $qq->name = str_replace(',', '', $_POST[$category]);
        $qq->save($project);
      } else {
        // Use this tag
        $q->get();
        $project->save($q);
      }
    }
  }
  function submit() {
    $data['title'] = 'Submit a Project';
    $project = new Project();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Get the scalars.
      $project->from_array($_POST);
      // Convert properly to boolean
      if ($project->show_contact == 'yes') {
        $project->show_contact = TRUE;
      } else {
        $project->show_contact = FALSE;
      }
      // Handle the relations (tags)
      if ($project->save($this->_current_user())) { // validations run
        $this->_save_tags($project);
        $this->_submit_on_success();
      } else { // invalid
        $data['error'] = $project->error->string;
      }
    }

    // Otherwise, render a form.
    $tags = new Tag();
    foreach (array('field', 'type', 'location') as $category) {
      $tags->where('category', $category)->get();
      $data[$category . '_tags'] = array();
      foreach ($tags as $tag) {
        array_push($data[$category . '_tags'], $tag->name);
      }
    }

    $data['form'] = $project->render_form(
      array('title', 'start_date', 'end_date', 'field', 'type', 'location',
      'text', 'show_contact')
    );

    $this->load->view('form_project', $data);
  }

  function _submit_on_success() {
    $this->session->set_flashdata('msg', "Thank you! Your entry has been saved.");
    redirect();
  }

  function view($id) {
    $project = new Project();
    $project->get_by_id(intval($id));
    $data['title'] = $project->title;
    $data['project'] = $project;
    $data['author'] = $project->user->get();
    $this->load->view('home_view', $data);
  }

  # Expects tag1,tag2,tag2
  function browse($tags_str) {
    $projects = new Project();
    $tags_arr = explode(',', $tags_str);
    $projects = $projects->or_group_start();
    foreach ($tags_arr as $tag) {
      $projects = $projects->where_related_tag('name', $tag);
    }
    $projects->group_end()->get();

    $data = array();
    $data['title'] = "Browsing $tags_str";
    $data['posts'] = $projects;
    #$data['posts'] = $
    $this->load->view('home_index', $data);
  }

  function info() {
    echo phpinfo();
  }
  
  function cgi_info() {
    echo '<pre>';
    echo passthru("php --info");
    echo '</pre>';
  }

  function emp() {
    if($this->input->post('dne')) {
      echo 'bar';
    } else {
      echo 'baz';
    }
  }

  function models() {
    $t = new Tag();
    $t->get();
    foreach ($t->all as $myt) {
      echo $myt;
    }
  }

  function db2() {
    $q = $this->db->get('tags');
    var_dump($q);
  }

}
?>
