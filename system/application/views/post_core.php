<div class="byline">By <?= $project->user->full_name ?> <?php if(isset($project->start_date)): ?> from <?= $project->start_date ?> <?php endif; ?><?php if(isset($project->end_date)): ?> to <?= $project->end_date ?> <?php endif; ?></div><br />
<p class="project-text"><?= $project->text ?></p>
<div>
<ul class="horizontal">
<?php 
$project->tags->get();
foreach ($project->tags as $tag):
  $t = $tag->name
?>
  <?= anchor("home/browse/$t", $t) ?>
<?php endforeach; ?>
</ul>
</div>
