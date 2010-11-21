<?php include 'header.php'; ?>

<h1>Welcome to the Scholars Information Database</h1>

<p id="purpose">{Purpose of the SID}</p>
<div id="home-form">
</div>

<section id="post-list">
<?php foreach($posts as &$post): ?>
<div id="post">
  <h3><?= $post->title ?></h3>
  <div class="byline"><?= $post->user->full_name ?> <?php if(isset($post->start_date)): ?> from <?= $post->start_date ?> <?php endif; ?><?php if(isset($post->end_date)): ?> to <?= $post->end_date ?> <?php endif; ?></div>
  <?php $pid = $post->id ?>
  <!--TODO: filter. Either by word/character count or paragraph split. -->
  <p class="project-text"><?= $post->projecttext->text ?></p>
  <ul class="horizontal">
    <li><?= anchor("project/view/$pid", 'View') ?></li>
    <li><?=anchor("project/view/$pid#comment", 'Comment')?></li>
    <li><?=anchor("project/view/$pid#contact", 'Contact')?></li>
  </ul>
</div>
<?php endforeach; ?>
<?php include 'footer.php' ?>

