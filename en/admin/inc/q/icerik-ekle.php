<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; ?>

<?php
	if($_POST){
		$content_title = p('content_title');
		$content_url = seo($content_title);
		$content_img = p('content_img');
		$content_comments = p('content_comments');
		$category_id = p('category_id');
		$content = p('content');

		if(empty($content_title) || empty($content) || empty($content_img)){
			echo "<p class='alert alert-danger'>Lütfen tüm alanları doldurup tekrar deneyin.</p>";
		}else{
			$sorgu = $db->prepare("SELECT COUNT(*) FROM contents WHERE content_url='{$content_url}'");
			$sorgu->execute();
			$say = $sorgu->fetchColumn();
			if($say>0){
				echo "<p class='alert alert-danger'>Eklemeye çalıştığınız içerik zaten mevcut. Aynı başlıkta içerik kabul etmiyoruz başka bir başlıkla tekrar deneyebilirsin.</p>";
			}else{
				$insert = $db->prepare("INSERT INTO contents SET content_title='{$content_title}', content_img='{$content_img}', content_comments='{$content_comments}', category_id='{$category_id}', content='{$content}', content_p=0, content_url='{$content_url}'");
				$insert->execute();
				echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Ekleyiniz...</p>";
				header("Refresh: 2; url=".URL."/en/admin/index.php?do=icerik");
			}
			
		}
	}
?>

<section class="section">
	<div class="section-inner">
	
	<h2 class="heading"><i class="fa fa-plus"></i> İçerik Ekle EN<br/><small><a href="<?php echo URL."/en/admin/index.php?do=icerik"; ?>"><i class="fa fa-file-text-o"></i> İçerikleri Göster</a></small></h2>
	
	<div class="item row">
			<?php
			$sorgu = $db->prepare("SELECT COUNT(*) FROM categories");
			$sorgu->execute();
			$say = $sorgu->fetchColumn();
			if($say>0){
			?>
			<form action="" method="POST">
				<label>Başlık: </label><input type="text" name="content_title" class="form-control" placeholder="İçerik Başlığı" />
				<label>Küçük Resim: </label><input type="text" name="content_img" class="form-control" placeholder="İçerik Küçük Resim URL" />
				<h6> RESİM BOYUTU 1920X1080 OLMALIDIR</H6>
				<label>Yorum Ayarları: </label><select name="content_comments" class="form-control">
					<option value="1">Yorumlar Açık</option>
					<option value="0">Yorumlar Kapalı</option>
				</select>
				<label>Kategori Seçin: </label><select name="category_id" class="form-control">
					<?php
						$row = $db->query("SELECT * FROM categories WHERE category_onoff=1 ORDER BY category_title ASC", PDO::FETCH_ASSOC);
						foreach($row as $categories){
							echo "<option value='".$categories['category_id']."'>".$categories['category_title']."</option>";
							}
					?>
				</select>
				<label>İçerik: </label><textarea name="content"></textarea>
				<script>
				CKEDITOR.replace( 'content' );
				</script>
				<input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
			</form>
			<?php }else { ?>
				<p class="alert alert-danger">Hiç kategori eklemediğiniz için içerik ekleyemiyorsunuz. Hemen şimdi <a href="<?php echo URL."/en/admin/index.php?do=kategori-ekle"; ?>">Kategori Ekle</a></p>
			<?php } ?>
		</div>
	</div>
</section>