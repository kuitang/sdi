<?php include 'header.php'; ?>
<script type="text/javascript" src="<?= site_url('js/sha1-min.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("form").submit(function(){
    var h1 = hex_hmac_sha1($('#server_salt').val(), $('#password').val());
    var h2 = hex_hmac_sha1($('#challenge').val(), h1);
    $('#pwhash').val(h2);
    $('#password').val('');
  });
 });
</script>
<?php include 'form_core.php'; ?>
<?php include 'footer.php'; ?>
