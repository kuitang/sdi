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
  <link rel="stylesheet" href="<?= site_url('css/default.css') ?>" type="text/css" />
  <link rel="stylesheet" href="<?= site_url('css/form.css') ?>" type="text/css" />
</head>
<body>

<header>
<div id="username">
<?php if ($name): ?>
  Welcome <?= $name ?>. <?= anchor('user/logout', 'Logout') ?>
<?php else: ?>
  <?= anchor('user/login', 'Login') ?>
<?php endif; ?>
</div>
<nav>
{Navigation goes here}
</nav>
<?php if (isset($flashmsg)): ?>
  <div id="flash">
  <?= $flashmsg ?>
  </div>
<?php endif; ?>
</header>

