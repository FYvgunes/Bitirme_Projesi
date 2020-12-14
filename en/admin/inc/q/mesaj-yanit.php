<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; 

$id = g('id');
$sor = $db->query("SELECT * FROM messages WHERE message_id={$id}");
$icerik = $sor->fetch(PDO::FETCH_ASSOC);
$icerik_varmi = $sor->rowCount();
if($icerik_varmi>0){ null; }else{
	header("Location: ".URL."/en/admin/index.php?do=mesaj"); exit;
}

if($_POST){
	$yanit = p('yanit', true);
	$headers = 'From: '.$_SESSION['admin_eposta'].'' . "rn";
	$gonderilecek = $icerik['email'];
	$konu = $setting['site_title'].' Sitesinden Geri Yanıt';
	$mesaj = $yanit;
	$gonder = mail($gonderilecek, $konu, $mesaj, $headers);

	if($gonder){
		$mesaj = "Yanıt başarıyla gönderildi.";
	}else{
		$mesaj = "Üzgünüm. Yanıt gönderilemedi sebebi sunucunuz mail göndermeyi desteklemiyor olabilir.";
	}

	header("Refresh: 2; url=".URL."/en/admin/index.php?do=mesaj");
}
?>
<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-comments"></i> Mesaj Sayfası</h2>
		<?php echo !$mesaj ? null : "<p class='alert alert-warning'>".$mesaj."</p>"; ?>
		<div class="item row">
			<p>Gönderen : <b><?php echo $icerik['name']; ?></b></p>
			<p>Gönderen E-Posta : <b><?php echo $icerik['email']; ?></b></p>
			<p>Gönderen IP Adresi : <b><?php echo $icerik['ip']; ?></b></p>
			<p>Gönderildiği Tarih : <b><?php echo tarih($icerik['message_date']); ?> Saat <?php echo saat($icerik['message_date']); ?></b></p>
			<p>Konu : <b><?php echo $icerik['subject']; ?></b></p>
			<p>Mesaj : <b><?php echo $icerik['message']; ?></b></p>
			<hr/>
			<form action="" method="POST">
				<p>Yanıtınızı Girin : </p>
				<textarea style="max-width: 100% !important; min-height:200px; resize: none;" class="form-control" name="yanit"></textarea>
				<input type="submit" class="btn btn-success form-control" name="button" value="YANITLA">
			</form>
		</div>
	</div>
</section>