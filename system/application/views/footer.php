<footer>
<p>If you have any questions or comments, please feel free to
<?= mailto('scholarsprogram@columbia.edu', 'contact us'); ?>.
<p>&copy; Columbia University | Created by <a href="http://kui-tang.com">Kui Tang</a> and Deb Sen</p>
<pre class=debug>
<h3>Debug</h3>
<?= var_dump(get_instance()->session->userdata) ?>
</pre>
</footer>

</body>
</html>
