<?php include 'header.php'; ?>
<h1><?= $user->full_name ?></h1>
<h3>Bio</h3>
<p id="bio">Not implemented.</p>
<h3>Basic Profile</h3>
<ul id="contact">
<?php $email = $user->uni . "@columbia.edu"; ?>
  <li>Email: <?= safe_mailto($email, $email) ?></li>
  <li>Class of <?= $user->year ?></li>
  <li><?= $user->major ?></li>
  <li><?= $user->scholar ?> Scholar</li>
</ul>
<h3>Additional Contact</h3>
<p id="additional-contact">Not implemented.</p>


<?php include 'footer.php'; ?>
