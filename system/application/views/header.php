<?php $sess = get_instance()->session;
$flashmsg = $sess->flashdata('msg');
$uni = $sess->userdata('uni');
$name = FALSE;
$admin = FALSE;
if ($uni) {
  $u = new User();
  $u->get_where(array('uni' => $uni));
  $name = $u->full_name;
  $admin = $u->is_admin;
}

/* SQL IN THE VIEW?! NOO!!! */
$tag_list = array( 'field' => '',
               'type' => '',
               'location' => ''
             );
$tag_names = array ( 'field' => 'Field/Discipline',
                     'type'  => 'Type of Project',
                     'location' => 'Location' );

foreach ($tag_list as $k => &$v) {
  $v = new Tag();
  $v->get_by_category($k);
}

isset($tag_name_base_url) || $tag_name_base_url = '/home/browse/';


?><!DOCTYPE html>
<html>
<head>
  <title><?php echo $title ?> | Scholars Information Database</title>
<!-- TODO: Optimize, esp. use Google's versions of some. Compile down rest. -->
  <script src="<?= site_url('js/custom.js') ?>" type="text/javascript"></script>
  <script src="<?= site_url('js/jquery-1.4.4.min.js') ?>" type="text/javascript"></script>
  <script src="<?= site_url('js/jquery-ui-1.8.9.custom.min.js') ?>" type="text/javascript"></script>
  <script src="<?= site_url('js/TextboxList.js') ?>" type="text/javascript"></script>
  <script src="<?= site_url('js/TextboxList.Autocomplete.js') ?>" type="text/javascript"></script>
  <link rel="stylesheet" href="<?= site_url('css/blueprint/screen.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/blueprint/print.css') ?>" type="text/css" media="print"/>
<!--  <link rel="stylesheet" href="<?= site_url('css/form.css') ?>" type="text/css" /> -->
  <!--[if lt IE 8]><link rel="stylesheet" href="<?= site_url('css/blueprint/print.css') ?>" type="text/css" media="screen, projection"><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link rel="stylesheet" href="<?= site_url('css/blueprint/screen.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/blueprint/plugins/fancy-type/screen.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/custom.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/cupertino/jquery-ui.css') ?>" type="text/css" />
</head>
<body>
<div class="metacontainer">
<div class="container">

<header id="header" class="span-24 last">
<nav class="navcol">
<ul id="user" class="col">
  <li class="leftnav">
  <form method="get" action="<?= site_url('/home/search/') ?>" method="GET" autocomplete="on">
  <input value placeholder="Search Projects" name="q" id="search-query" type="search" />
  </form>
  </li>
<?php if ($name): ?>
  <li>Welcome <?= $name ?>.</li>
  <?php if($admin): ?><li><?= anchor('users/approve', 'Approve Unis') ?></li><?php endif; ?>
  <li><?= anchor('users/editprofile', 'Edit Profile') ?></li>
  <li><?= anchor('users/logout', 'Logout') ?></li>
<?php else: ?>
  <li><?= anchor('users/signup', 'Sign up') ?></li>
  <li><?= anchor('users/login', 'Login') ?></li>
<?php endif; ?>
</ul>
</nav>
<?php if (isset($flashmsg) && !empty($flashmsg)): ?>
<div id="flash" class="col <?php if (isset($flasherr)) { echo 'error'; } ?>">
  <?= $flashmsg ?>
</div>
<?php endif; ?>

<br /><br /> <!-- QUICK FIX: this just lines up the boxes correctly vertically -->

<div class="col">
<table style="background-color: #ffffff;"><tr>
<td style="text-align: right;"><img src="images/cusp.png"></td>
<td style="text-align: center;"><div id="logo"><b>S</b>cholars <b>I</b>nformation <b>D</b>atabase</div><br />
<div id="subtitle">C. Prescott Davis | Egleston | John Jay | Kluge | Science Research Fellows</div></td>
</tr></table>
</div>

</header>
<div class="span-5">
<div class="col navcol" id="leftcol">
<nav id="leftbar">
  <ul>
  <li><?= anchor('/', 'Home') ?></li>
  <li><?= anchor('/home/advsearch', 'Advanced Search') ?></li>
  <li><?= anchor('/home/submit', 'Submit') ?></li>
  </ul>
</nav>
<hr />
<nav id="taglist">
<span class="center caps">Browse by tags</span><br /><br />
<ul>
<?php foreach($tag_list as $k => &$v): ?>
  <li><b><?= $tag_names[$k] ?>:</b></li>
    <ul>
      <?php foreach($v as &$tag): ?>
        <?php if(isset($tags_arr) && in_array($tag->name, $tags_arr)): ?>
          <!-- TODO: eventually permit unselecting a tag -->
          <li class="selected_tag"><b><?= $tag->name; ?></b></li>
        <?php else: ?>
          <li class="unselected_tag"><?= anchor($tag_name_base_url . $tag->name, $tag->name); ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </li>
<?php endforeach; ?>
</ul>
</nav>
</div>
</div>

<div class="span-19 last">
<div class="col" id="maincol">
