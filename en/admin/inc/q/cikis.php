<?php
echo !defined("INDEX") ? header("Location: kontrol.php") : null; 
session_destroy();
header("Refresh: 1; url=".URL."/en/admin/");
?>
<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-bell"></i> Çıkış</h2>
		<div class="item row">
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="fa fa-check"></i> Başarıyla <strong> Çıkış Yaptınız.</strong>
			</div>
		</div>
	</div>
</section>