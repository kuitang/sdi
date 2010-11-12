<?php $sess = get_instance()->session;
if (isset($sess->flashdata)) {
  $flashmsg = $sess->flashdata('msg');
}
$name = $sess->userdata('uni');
?><!DOCTYPE html>
<html>
<head>
  <title><?php echo $title ?> | Scholars Information Database</title>
  <script src="<?= site_url('js/custom.js') ?>" type="text/javascript"></script>
  <link rel="stylesheet" href="<?= site_url('css/blueprint/screen.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/blueprint/print.css') ?>" type="text/css" media="print"/>
  <link rel="stylesheet" href="<?= site_url('css/form.css') ?>" type="text/css" />
  <!--[if lt IE 8]><link rel="stylesheet" href="<?= site_url('css/blueprint/print.css') ?>" type="text/css" media="screen, projection"><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link rel="stylesheet" href="<?= site_url('css/blueprint/screen.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/blueprint/plugins/fancy-type/screen.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/custom.css') ?>" type="text/css" media="screen, projection" />
</head>
<body>
<div class="metacontainer">
<div class="container">

<header id="header" class="span-24 last">
<div id="logo" class="alt">
<b>S</b>cholars <b>I</b>nformation <b>D</b>atabase
</div>
<nav class="navcol">
<ul id="user" class="col">
  <li class="leftnav">
  <form method="get" action="<?= site_url('/home/search/') ?>" method="GET" autocomplete="on">
  <input value placeholder="Search Projects" name="q" id="search-query" type="search" />
  </form>
  </li>
<?php if ($name): ?>
  <li>Welcome <?= $name ?>.</li>
  <li><?= anchor('user/editprofile', 'Edit Profile') ?></li>
  <li><?= anchor('user/logout', 'Logout') ?></li>
<?php else: ?>
  <li><?= anchor('user/signup', 'Sign up') ?></li>
  <li><?= anchor('user/login', 'Login') ?></li>
<?php endif; ?>
</ul>
</nav>
<?php if (isset($flashmsg)): ?>
<div id="flash">
<?= $flashmsg ?>
  </div>
<?php endif; ?>
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
<span class="center caps">Browse by tags</span>
<ul>
  <li><span class="caps">Field/Discipline:</span>
    <ul>
      <li>Forthcoming</li>
    </ul>
  </li>
  <li><span class="caps">Type of Project:</span>
    <ul>
      <li>Forthcoming</li>
    </ul>
  </li>
  <span class="caps">Location:</span>
    <ul>
      <li>Forthcoming</li>
    </ul>
  </li>
</ul>
</nav>
</div>
</div>

<div class="span-19 last">
<div class="col" id="maincol">
