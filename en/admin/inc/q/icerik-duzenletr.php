<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; ?>

<?php
	$id = g('id');
	if(empty($id) || !is_numeric($id)){ header("Location: ".URL."/en/admin/index.php?do=iceriktr"); exit; }else{
		$sor = $db->query("SELECT * FROM contentstr WHERE content_id={$id} AND content_p=0");
		$icerik = $sor->fetch(PDO::FETCH_ASSOC);
		$icerik_varmi = $sor->rowCount();
		if($icerik_varmi>0){ null; }else{
			header("Location: ".URL."/en/admin/index.php?do=iceriktr"); exit;
		}
	}

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
			$sorgu = $db->prepare("SELECT COUNT(*) FROM contentstr WHERE content_url='{$content_url}' AND content_id != {$id}");
			$sorgu->execute();
			$say = $sorgu->fetchColumn();
			if($say>0){
				echo "<p class='alert alert-danger'>Eklemeye çalıştığınız içerik zaten mevcut. Aynı başlıkta içerik kabul etmiyoruz başka bir başlıkla tekrar deneyebilirsin.</p>";
			}else{
				$insert = $db->prepare("UPDATE contentstr SET content_title='{$content_title}', content_img='{$content_img}', content_comments='{$content_comments}', category_id='{$category_id}', content='{$content}', content_p=0, content_url='{$content_url}' WHERE content_id={$id}");
				$insert->execute();
				echo "<p class='alert alert-success'>İçerik başarıyla düzenlendi. Lütfen Bekleyiniz...</p>";
				header("Refresh: 2; url=".URL."/en/admin/index.php?do=iceriktr");
			}
			
		}
	}

$sor = $db->query("SELECT * FROM contentstr WHERE content_id={$id} AND content_p=0");
		$icerik = $sor->fetch(PDO::FETCH_ASSOC);
?>

<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-edit"></i> İçerik Düzenle TR<br/><small><a href="<?php echo URL."/en/admin/index.php?do=iceriktr"; ?>"><i class="fa fa-file-text-o"></i> İçerikleri Göster</a></small></h2>
		<div class="item row">
			<form action="" method="POST">
				<label>Başlık: </label><input type="text" name="content_title" class="form-control" placeholder="İçerik Başlığı" value="<?php echo $icerik['content_title']; ?>" />
				<label>Küçük Resim: </label><input type="text" name="content_img" class="form-control" placeholder="İçerik Küçük Resim URL" value="<?php echo $icerik['content_img']; ?>" />
				<h6> RESİM BOYUTU 19200X1080 OLMALIDIR</H6>
				<label>Yorum Ayarları: </label><select name="content_comments" class="form-control">
					<option value="1" <?php echo ($icerik['content_comments'] == 1) ? "selected" : null; ?>>Yorumlar Açık</option>
					<option value="0" <?php echo ($icerik['content_comments'] == 0) ? "selected" : null; ?>>Yorumlar Kapalı</option>
				</select>
				<label>Kategori Seçin: </label><select name="category_id" class="form-control">
					<?php
						$row = $db->query("SELECT * FROM categoriestr WHERE category_onoff=1 ORDER BY category_title ASC", PDO::FETCH_ASSOC);
						foreach($row as $categories){
							if($icerik['category_id'] == $categories['category_id']){
								echo "<option value='".$categories['category_id']."' selected>".$categories['category_title']."</option>";
							}else{
								echo "<option value='".$categories['category_id']."'>".$categories['category_title']."</option>";
							}
						}
					?>
				</select>
				<label>İçerik: </label><textarea name="content"><?php echo $icerik['content']; ?></textarea>
				<script>
				CKEDITOR.replace( 'content' );
				</script>
				<input type="submit" value="Düzenle" class="btn btn-cta-primary form-control" />
			</form>
		</div>
	</div>
</section>