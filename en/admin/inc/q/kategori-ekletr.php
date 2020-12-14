<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; ?>

<?php
	if($_POST){
		$category_title = p('category_title');
		$category_url = seo($category_title);
		$category_menu = p('category_menu');

		if(empty($category_title)){
			echo "<p class='alert alert-danger'>Lütfen tüm alanları doldurup tekrar deneyin.</p>";
		}else{
			$sorgu = $db->prepare("SELECT COUNT(*) FROM categoriestr WHERE category_url='{$category_url}'");
			$sorgu->execute();
			$say = $sorgu->fetchColumn();
			if($say>0){
				echo "<p class='alert alert-danger'>Eklemeye çalıştığınız kategori zaten mevcut. Aynı başlıkta kategori kabul etmiyoruz başka bir başlıkla tekrar deneyebilirsin.</p>";
			}else{
				$insert = $db->prepare("INSERT INTO categoriestr SET category_title='{$category_title}', category_url='{$category_url}', category_menu='{$category_menu}', category_onoff=1");
				$insert->execute();
				echo "<p class='alert alert-success'>Kategori başarıyla eklendi. Lütfen Bekleyiniz...</p>";
				header("Refresh: 2; url=".URL."/en/admin/index.php?do=kategoritr");
			}
			
		}
	}
?>

<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-plus"></i> Kategori Ekle TR<br/><small><a href="<?php echo URL."/en/admin/index.php?do=kategoritr"; ?>"><i class="fa fa-folder"></i> Kategorileri Göster</a></small></h2>
		<div class="item row">
			<form action="" method="POST">
				<label>Başlık: </label><input type="text" name="category_title" class="form-control" placeholder="Kategori Başlığı" />
				<label>Menü Ayarları: </label><select name="category_menu" class="form-control">
					<option value="1">Menüde Gösterilsin</option>
					<option value="0" selected>Menüde Gösterilmesin</option>
				</select>
				<input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
			</form>
		</div>
	</div>
</section>