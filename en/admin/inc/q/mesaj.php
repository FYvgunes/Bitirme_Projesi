<?php 
echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; 
?>
<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-comments"></i> Mesajlar</h2>
		<div class="item row">
<?php
$sorgu = $db->query("SELECT message_id FROM messages", PDO::FETCH_ASSOC);
$ksayisi = $sorgu->rowCount();
$sayfa = g("s") ? g("s") : 1;
$limit = 12; // 12 Tane gösteriyoruz tek seferde
$ssayisi = ceil($ksayisi/$limit);
if($sayfa>$ssayisi){ $sayfa=1; } // Kullanıcı rastgele sayfa girebilir get ile, bunu önlemek için gereksiz sorgudan kurtulmak için
$baslangic = ($sayfa * $limit) - $limit;

$row = $db->query("SELECT * FROM messages ORDER BY message_id DESC LIMIT $baslangic, $limit", PDO::FETCH_ASSOC);
foreach($row as $content){
	?>
	<div class="list-group-item list-trend">
		<div class="clearfix content-heading">
			<img class="pull-left img-trend" src=""/>
			<h3 class="txt-trend"><?php echo kisaMetin($content['subject'], 48); ?><br/><small>
			<p><?php echo kisaMetin($content['message'], 300); ?></p>
			<hr/>
			<p><?php echo kisaMetin($content['name'], 100); ?> | <?php echo kisaMetin($content['email'], 100); ?></p>
			<a href="<?php echo URL."/en/admin/index.php?do=mesaj-yanit&id=".$content['message_id']; ?>"><i class="fa fa-reply"></i> Mesajı Göster veya Yanıtla</a> | <a  onclick="return confirm('Mesajı silmek istediğinizden emin misiniz?');" href="<?php echo URL."/en/admin/index.php?do=mesaj-sil&id=".$content['message_id']; ?>"><i class="fa fa-trash-o"></i> Mesajı Sil</a></small></h3>
		</div>
	</div>
	<?php
}
if($ksayisi>0){}else{
	echo "<p class='alert alert-danger'>Henüz hiç mesaj almadınız.</p>";
}
if($ksayisi>$limit){ ?>
<div class="text-center">
	<ul class="pagination">
		<?php
		echo "<a><li class='btn btn-default'>".$sayfa."/".$ssayisi."</li></a>";
		$forlimit = 1;
		if($sayfa>$forlimit) {
			echo "<a href='".URL."/en/admin/index.php?do=".$do."&s=1'><li class='btn btn-default'>İlk</li></a>";
		}
		for($i = $sayfa - $forlimit; $i <= $sayfa + $forlimit; $i++){
			if($i>0 && $i<=$ssayisi){
				if($i == $sayfa){
					echo "<a href=''><li class='btn btn-default active'>".$i."</li></a>";
				} else {
					echo "<a href='".URL."/en/admin/index.php?do=".$do."&s=".$i."'><li class='btn btn-default'>".$i."</li></a>";
				}
			}
		}
		echo "<a href='".URL."/en/admin/index.php?do=".$do."&s=".$ssayisi."'><li class='btn btn-default'>Son</li></a>";
		?>
	</ul>
</div>
<?php } ?>
</div>
</div>
</section>