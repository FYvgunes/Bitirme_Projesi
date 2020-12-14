<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null;

$id = g('id');
$sor = $db->query("SELECT * FROM kariyerEn WHERE Kariyer_id={$id}");
$icerik = $sor->fetch(PDO::FETCH_ASSOC);
$icerik_varmi = $sor->rowCount();
if($icerik_varmi>0){ null; }else{
	header("Location: ".URL."/en/admin/index.php?do=KariyerEn"); exit;
}
?>
<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-trash-o"></i> Pozisyon Sil</h2>
		<div class="item row">
			<?php
			$sil = $db->prepare("DELETE FROM kariyerEn WHERE Kariyer_id={$id}");
			$sil->execute();
			header("Refresh: 2; url=".URL."/en/admin/index.php?do=KariyerEn");
			?>
			<p class="alert alert-success">Pozisyon başarıyla silindi.</p>
		</div>
	</div>
</section>
