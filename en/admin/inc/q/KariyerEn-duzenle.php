<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.html") : null; ?>

<?php
$id = g('id');
if (empty($id) || !is_numeric($id)) {
	header("Location: " . URL . "/en/admin/index.php?do=Kariyer");
	exit;
} else {
	$sor = $db->query("SELECT * FROM kariyerEN WHERE Kariyer_id={$id}");
	$Kariyer = $sor->fetch(PDO::FETCH_ASSOC);
	$Kariyer_varmi = $sor->rowCount();
	if ($Kariyer_varmi > 0) {
		null;
	} else {
		header("Location: " . URL . "/en/admin/index.php?do=kariyerEN");
		exit;
	}
}

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
		$sorgu = $db->prepare("SELECT COUNT(*) FROM kariyerEN WHERE Kariyer_url='{$Kariyer_url}' AND Kariyer_id != {$id}");
		$sorgu->execute();
		$say = $sorgu->fetchColumn();
		if ($say > 0) {
			echo "<p class='alert alert-danger'>Eklemeye çalıştığınız Pozisyon zaten mevcut. Aynı başlıkta pozisyon kabul etmiyoruz başka bir başlıkla tekrar deneyebilirsin.</p>";
		} else {
			$Kariyer_nit1 = p("Kariyer_nit1");
			$Kariyer_nit1 = p("Kariyer_nit1");
			$insert = $db->prepare("UPDATE kariyerEN SET Kariyer_title='{$Kariyer_title}',  Kariyer='{$Kariyer}',  Kariyer_url='{$Kariyer_url}',Kariyer_nit1='{$Kariyer_nit1}',Kariyer_nit2='{$Kariyer_nit2}',Kariyer_nit3='{$Kariyer_nit3}',Kariyer_nit4='{$Kariyer_nit4}',Kariyer_nit5='{$Kariyer_nit5}' WHERE Kariyer_id={$id}");
			$insert->execute();
			echo "<p class='alert alert-success'>Pozisyon başarıyla düzenlendi. Lütfen Bekleyiniz...</p>";
			header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=Kariyer");
		}
	}
}

$sor = $db->query("SELECT * FROM kariyer WHERE Kariyer_id={$id}");
$Kariyer = $sor->fetch(PDO::FETCH_ASSOC);
?>

<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-edit"></i> Kariyer Düzenle<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=Kariyer"; ?>"><i class="fa fa-file-text-o"></i> Açık Pozisyonları Göster</a></small></h2>
		<div class="item row">
			<form action="" method="POST">
        <p></p>
				<label>Pozisyon: </label><input type="text" name="Kariyer_title" class="form-control" placeholder="Açık Pozisyon..." value="<?php echo $Kariyer['Kariyer_title']; ?>" />
				<label>Nitelik 1 </label><input type="text" name="Kariyer_nit1" class="form-control" placeholder="Nitelikler" value="<?php echo $Kariyer['Kariyer_nit1']; ?>" />
				<label>Nitelik 2 </label><input type="text" name="Kariyer_nit2" class="form-control" placeholder="Nitelikler" value="<?php echo $Kariyer['Kariyer_nit2']; ?>" />
				<label>Nitelik 3 </label><input type="text" name="Kariyer_nit3" class="form-control" placeholder="Nitelikler" value="<?php echo $Kariyer['Kariyer_nit3']; ?>" />
				<label>Nitelik 4 </label><input type="text" name="Kariyer_nit4" class="form-control" placeholder="Nitelikler" value="<?php echo $Kariyer['Kariyer_nit4']; ?>" />
				<label>Nitelik 5 </label><input type="text" name="Kariyer_nit5" class="form-control" placeholder="Nitelikler" value="<?php echo $Kariyer['Kariyer_nit5']; ?>" />
				<label>İçerik: </label><textarea name="Kariyer"><?php echo $Kariyer['Kariyer']; ?></textarea>
				<script>
					CKEDITOR.replace('Kariyer');
				</script>
				<input type="submit" value="Düzenle" class="btn btn-cta-primary form-control" />
			</form>
		</div>
	</div>
</section>
