<?php $title = 'Home' ?>
<?php include 'header.php' ?>

<?= form_open('home/postlogin') ?>
<label for="uni">uni</label>
<input type="text" name="uni" maxlength="7" />
<input type="Submit" value="Submit" />

<?= form_close() ?>
<p>Redirect: <?= get_instance()->session->userdata('login_redirect'); ?></p>
<?php include 'footer.php' ?>
