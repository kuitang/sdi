<?php include 'header.php'; ?>
<script type="text/javascript">
$(document).ready(function() {
  $("#start_date").datepicker();
  $("#end_date").datepicker();
  $("#field").autocomplete({source: <?= json_encode($field_tags) ?> });
  $("#type").autocomplete({source: <?= json_encode($type_tags) ?> });
  $("#location").autocomplete({source: <?= json_encode($location_tags) ?> });
});
</script>
<?php include 'form_core.php'; ?>
<?php include 'footer.php'; ?>
