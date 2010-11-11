<?php include 'header.php'; ?>

<h1>Welcome to the Scholars Information Database</h1>

<p id="purpose">{Purpose of the SID}</p>
<div id="home-form">
</div>

<section id="post-list">
<?php foreach($posts as &$post): ?>
<div id="post">
  <span class="smalltitle"><?= $post['title'] ?></span>
  <?php $pid = $post['id']; ?>
  <p><?= $post['short'] ?></p>
  <ul class="horizontal">
    <li><?= anchor("entry/view/$pid", 'View') ?></li>
    <li><?=anchor("entry/view/$pid#comment", 'Comment')?></li>
    <li><?=anchor("entry/view/$pid#contact", 'Contact')?></li>
  </ul>
</div>
<?php endforeach; ?>
<?php include 'footer.php' ?>

