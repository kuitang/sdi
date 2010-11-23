<?php include 'header.php'; ?>
<h1><?= $title ?></h1>
<?php if($errors): ?>
<div class="error">
<?= $errors ?>
</div>
<?php endif; ?>

<ul class="nolist">
<?php foreach($approvedunis as $ap): ?>
  <li><?= $ap->uni ?> (<?= anchor("users/removeapproval/$ap->id", 'x') ?>)</li>
<?php endforeach; ?>
</ul>

<?php $this->load->helper('form') ?>
<?= form_open('users/approve') ?>
<label for="unis">Enter the list of approved unis, one per line.</label><br />
<textarea name="unis"></textarea><br />
<input type="Submit" value="Submit" />
<?= form_close() ?>

<?php include 'footer.php'; ?>
