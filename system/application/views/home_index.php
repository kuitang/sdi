<?php include 'header.php'; ?>

<!-- <h1><?= $title ?></h1>

<p id="purpose">{Purpose of the SID}</p> -->
<div id="home-form">
</div>

<section id="post-list">
<?php foreach($posts as &$project): ?>
<?php $project->user->get(); ?>
<div id="project">
  <h3><?= $project->title ?></h3>
  <?php include 'post_core.php';
    $pid = $project->id;
  ?>
  <!--TODO: filter. Either by word/character count or paragraph split. -->
  <ul class="horizontal">
    <li><?= anchor("home/view/$pid", 'View') ?></li>
    <li><?= anchor("home/view/$pid#comment", 'Comment')?></li>
    <?php if($project->show_contact): ?>
      <?php $uid = $project->user->id; ?>
      <li><?= anchor("users/profile/$uid", 'Contact')?></li>
    <?php endif; ?>
  </ul>
</div>
<?php endforeach; ?>
<?php include 'footer.php' ?>

