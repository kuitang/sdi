<?php
$sess = get_instance()->session;
if (isset($sess->flashdata)) {
  $flashmsg = $sess->flashdata('msg');
}
$name = $sess->userdata('uni');
?><!DOCTYPE html>
<html>
<head>
  <title><?php echo $title ?> | Scholars Information Database</title>
  <link rel="stylesheet" href="<?= site_url('css/blueprint/screen.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/blueprint/print.css') ?>" type="text/css" media="print"/>
  <link rel="stylesheet" href="<?= site_url('css/form.css') ?>" type="text/css" />
  <!--[if lt IE 8]><link rel="stylesheet" href="<?= site_url('css/blueprint/print.css') ?>" type="text/css" media="screen, projection"><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <link rel="stylesheet" href="<?= site_url('css/blueprint/screen.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/blueprint/plugins/fancy-type/screen.css') ?>" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="<?= site_url('css/custom.css') ?>" type="text/css" media="screen,projection" />
</head>
<body>
<div class="container">
<header class="span-24 last">
<nav>
<ul id="user">
  <?php if ($name): ?>
    <li>Welcome <?= $name ?>.</li>
    <li><?= anchor('user/editprofile', 'Edit Profile') ?></li>
    <li><?= anchor('user/logout', 'Logout') ?></li>
  <?php else: ?>
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
<div class="span-4">
  <ul>
  <li>Tag list forthcoming</li>
  </ul>
</div>

<div class="span-20 last">
