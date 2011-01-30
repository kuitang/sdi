<?php include 'header.php'; ?>

<h1><?= $project->title ?></h1>

<p id="byline">By <?= $author->full_name ?></p>
<p id="start_date"><?= $project->start_date ?></p>
<p id="end_date"><?= $project->end_date ?></p>
<p id="text"><?= $project->text ?></p>

<?php include 'footer.php'; ?>
