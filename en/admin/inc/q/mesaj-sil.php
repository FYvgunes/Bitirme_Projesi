<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; 

$id = g('id');
$sor = $db->query("SELECT * FROM messages WHERE message_id={$id}");
$icerik = $sor->fetch(PDO::FETCH_ASSOC);
$icerik_varmi = $sor->rowCount();
if($icerik_varmi>0){ null; }else{
	header("Location: ".URL."/en/admin/index.php?do=mesaj"); exit;
}
?>
<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-trash-o"></i> Mesaj Sil</h2>
		<div class="item row">
			<?php
			$sil = $db->prepare("DELETE FROM messages WHERE message_id={$id}");
			$sil->execute();
			header("Refresh: 2; url=".URL."/en/admin/index.php?do=mesaj");
			?>
			<p class="alert alert-success">Mesaj başarıyla silindi.</p>
		</div>
	</div>
</section>