<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.html") : null; ?>

<?php
$id = g('id');

if ($_POST) {
	$category_title = p('category_title');
	$category_url = seo($category_title);
	$category_menu = p('category_menu');

	if (empty($category_title)) {
		echo "<p class='alert alert-danger'>Lütfen tüm alanları doldurup tekrar deneyin.</p>";
	} else {
		$sorgu = $db->prepare("SELECT COUNT(*) FROM categories WHERE category_url='{$category_url}' AND category_id != {$id}");
		$sorgu->execute();
		$say = $sorgu->fetchColumn();
		if ($say > 0) {
			echo "<p class='alert alert-danger'>Eklemeye çalıştığınız kategori zaten mevcut. Aynı başlıkta kategori kabul etmiyoruz başka bir başlıkla tekrar deneyebilirsin.</p>";
		} else {
			$insert = $db->prepare("UPDATE categoriesen SET category_title='{$category_title}', category_url='{$category_url}', category_menu='{$category_menu}', category_onoff=1 WHERE category_id={$id}");
			$insert->execute();
			echo "<p class='alert alert-success'>Kategori başarıyla düzenlendi. Lütfen Bekleyiniz...</p>";
			header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=kategori");
		}
	}
}
?>


<?php
if (empty($id) || !is_numeric($id)) {
	header("Location: " . URL . "/en/admin/index.php?do=kategori");
	exit;
} else {
	$sor = $db->query("SELECT * FROM categories WHERE category_id={$id} AND category_onoff=1");
	$icerik = $sor->fetch(PDO::FETCH_ASSOC);
	$icerik_varmi = $sor->rowCount();
	if ($icerik_varmi > 0) {
		null;
	} else {
		header("Location: " . URL . "/en/admin/index.php?do=kategori");
		exit;
	}
}
?>

<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-edit"></i> Kategori Düzenle EN<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=kategori"; ?>"><i class="fa fa-folder"></i> Kategorileri Göster</a></small></h2>
		<div class="item row">
			<form action="" method="POST">
				<label>Başlık: </label><input type="text" name="category_title" class="form-control" placeholder="Kategori Başlığı" value="<?php echo $icerik['category_title']; ?>" />
				<label>Menü Ayarları: </label><select name="category_menu" class="form-control">
					<?php

					?>
					<option value="1" <?php echo ($icerik['category_menu'] == 1) ? "selected" : null; ?>>Menüde Gösterilsin</option>
					<option value="0" <?php echo ($icerik['category_menu'] == 0) ? "selected" : null; ?>>Menüde Gösterilmesin</option>
				</select>
				<input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
			</form>
		</div>
	</div>
</section>