<?php
echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null;
?>
<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-newspaper-o"></i> Kariyer En<br/><small><a href="<?php echo URL."/en/admin/index.php?do=KariyerEN-Ekle"; ?>"><i class="fa fa-plus"></i> Pozisyon Ekle</a></small></h2>
		<div class="item row">
<?php
$sorgu = $db->query("SELECT Kariyer_id FROM kariyerEn", PDO::FETCH_ASSOC);
$ksayisi = $sorgu->rowCount();
$sayfa = g("s") ? g("s") : 1;
$limit = 12; // 12 Tane gösteriyoruz tek seferde
$ssayisi = ceil($ksayisi/$limit);
if($sayfa>$ssayisi){ $sayfa=1; } // Kullanıcı rastgele sayfa girebilir get ile, bunu önlemek için gereksiz sorgudan kurtulmak için
$baslangic = ($sayfa * $limit) - $limit;

$row = $db->query("SELECT * FROM  kariyerEn  ORDER BY Kariyer_id DESC LIMIT $baslangic, $limit", PDO::FETCH_ASSOC);
foreach($row as $Kariyer){
	?>
	<div class="list-group-item list-trend">
		<div class="clearfix content-heading">

        <h3 class="txt-trend"><?php echo kisaMetin($Kariyer['Kariyer_title'], 48); ?><br/></h3>
        <p class="txt-trend"><?php echo kisaMetin($Kariyer['Kariyer'], 200); ?><br/></p>
        <small>| <a href="<?php echo URL."/en/admin/index.php?do=KariyerEn-duzenle&id=".$Kariyer['Kariyer_id']; ?>"><i class="fa fa-edit"></i> Düzenle</a> | <a  onclick="return confirm('Pozisyonu silmek istediğinizden emin misiniz?');" href="<?php echo URL."/en/admin/index.php?do=KariyerEn-sil&id=".$Kariyer['Kariyer_id']; ?>"><i class="fa fa-trash-o"></i> Sil</a></small>

        </div>
	</div>

	<?php

}

if($ksayisi>0){}else{
	echo "<p class='alert alert-danger'>Henüz hiç İlan eklenmemiş.</p>";
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
