<?php include 'header.php'; ?>
<h1><?= $title ?></h1>
<?php if(isset($errors)): ?>
<?= $errors ?>
<?php endif;?>
<?= $form ?>
<?php include 'footer.php'; ?>
