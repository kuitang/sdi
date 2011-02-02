<div class="byline">By <?= $project->user->full_name ?> <?php if(isset($project->start_date)): ?> from <?= $project->start_date ?> <?php endif; ?><?php if(isset($project->end_date)): ?> to <?= $project->end_date ?> <?php endif; ?></div>
<p class="project-text"><?= $project->text ?></p>
