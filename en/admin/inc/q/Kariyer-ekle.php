<?php echo !defined("INDEX") ? header("Location: " . URL . "/en/404.html") : null; ?>

<?php
if ($_POST) {
	$Kariyer_title = p('Kariyer_title');
	$Kariyer_url = seo($Kariyer_title);
	$Kariyer = p('Kariyer');
	$Kariyer_nit1 = p("Kariyer_nit1");
	$Kariyer_nit2 = p("Kariyer_nit2");
	$Kariyer_nit3 = p("Kariyer_nit3");
	$Kariyer_nit4 = p("Kariyer_nit4");
	$Kariyer_nit5 = p("Kariyer_nit5");
	if (empty($Kariyer_title) || empty($Kariyer)) {
		echo "<p class='alert alert-danger'>Lütfen tüm alanları doldurup tekrar deneyin.</p>";
	} else {
		$sorgu = $db->prepare("SELECT COUNT(*) FROM kariyer WHERE Kariyer_url='{$Kariyer_url}'");
		$sorgu->execute();
		$say = $sorgu->fetchColumn();
		if ($say > 0) {
			echo "<p class='alert alert-danger'>Eklemeye çalıştığınız içerik zaten mevcut. Aynı başlıkta içerik kabul etmiyoruz başka bir başlıkla tekrar deneyebilirsin.</p>";
		} else {
			$insert = $db->exec("INSERT INTO kariyer SET  Kariyer_url='{$Kariyer_url}', Kariyer_title='{$Kariyer_title}', Kariyer='{$Kariyer}',Kariyer_nit1='{$Kariyer_nit1}',Kariyer_nit2='{$Kariyer_nit2}',Kariyer_nit3='{$Kariyer_nit3}',Kariyer_nit4='{$Kariyer_nit4}',Kariyer_nit5='{$Kariyer_nit5}' ");
			//$insert->execute();
			echo "<p class='alert alert-success'>Blog başarıyla eklendi. Lütfen Bekleyiniz...</p>";
			header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=Kariyer");
		}
	}
}
?>

<section class="section">
	<div class="section-inner">

		<h2 class="heading"><i class="fa fa-plus"></i> Pozisyon Ekle<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=Kariyer"; ?>"><i class="fa fa-file-text-o"></i> Pozisyonları Göster</a></small></h2>

		<div class="item row">
			<?php
			$sorgu = $db->prepare("SELECT COUNT(*) FROM categoriestr");
			$sorgu->execute();
			$say = $sorgu->fetchColumn();
			if ($say > 0) {
			?>
				<form action="" method="POST">
					<label>Pozisyon </label><input type="text" name="Kariyer_title" class="form-control" placeholder="Pozisyonun İsmi" />
					<label>Nitelik 1 </label><input type="text" name="Kariyer_nit1" class="form-control" placeholder="Nitelikler" />
					<label>Nitelik 2 </label><input type="text" name="Kariyer_nit2" class="form-control" placeholder="Nitelikler" />
					<label>Nitelik 3 </label><input type="text" name="Kariyer_nit3" class="form-control" placeholder="Nitelikler" />
					<label>Nitelik 4 </label><input type="text" name="Kariyer_nit4" class="form-control" placeholder="Nitelikler" />
					<label>Nitelik 5 </label><input type="text" name="Kariyer_nit5" class="form-control" placeholder="Nitelikler" />



					<label>Pozisyon Detay: </label><textarea name="Kariyer"></textarea>
					<script>
						CKEDITOR.replace('Kariyer');
					</script>
					<input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
				</form>
			<?php } else { ?>
			<?php } ?>
		</div>
	</div>
</section>