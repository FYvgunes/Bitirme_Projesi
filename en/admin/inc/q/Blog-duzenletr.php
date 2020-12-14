<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; ?>

<?php
	$id = g('id');
	if(empty($id) || !is_numeric($id)){ header("Location: ".URL."/en/admin/index.php?do=Blog"); exit; }else{
		$sor = $db->query("SELECT * FROM blogtr WHERE Blog_id={$id} AND Blog_p=0");
		$Blog = $sor->fetch(PDO::FETCH_ASSOC);
		$Blog_varmi = $sor->rowCount();
		if($Blog_varmi>0){ null; }else{
			header("Location: ".URL."/en/admin/index.php?do=Blogtr"); exit;
		}
	}

	if($_POST){
		$blog_title = p('Blog_title');
		$blog_url = seo($blog_title);
		$blog_img = p('Blog_img');
		$blog_comments = p('Blog_comments');
		$category_id = p('category_id');
		$blog = p('Blog');
		

		if(empty($blog_title) || empty($blog) || empty($blog_img)){
			echo "<p class='alert alert-danger'>Lütfen tüm alanları doldurup tekrar deneyin.</p>";
		}else{
			$sorgu = $db->prepare("SELECT COUNT(*) FROM blogtr WHERE Blog_url='{$blog_url}' AND Blog_id != {$id}");
			$sorgu->execute();
			$say = $sorgu->fetchColumn();
			if($say>0){
				echo "<p class='alert alert-danger'>Eklemeye çalıştığınız içerik zaten mevcut. Aynı başlıkta içerik kabul etmiyoruz başka bir başlıkla tekrar deneyebilirsin.</p>";
			}else{
				$insert = $db->prepare("UPDATE blogtr SET Blog_title='{$blog_title}', Blog_img='{$blog_img}', Blog_comments='{$blog_comments}', category_id='{$category_id}', Blog='{$blog}', Blog_p=0, Blog_url='{$blog_url}' WHERE Blog_id={$id}");
				$insert->execute();
				echo "<p class='alert alert-success'>Blog başarıyla düzenlendi. Lütfen Bekleyiniz...</p>";
				header("Refresh: 2; url=".URL."/en/admin/index.php?do=Blogtr");
			}
			
		}
	}

$sor = $db->query("SELECT * FROM blogtr WHERE Blog_id={$id} AND Blog_p=0");
		$Blog = $sor->fetch(PDO::FETCH_ASSOC);
?>

<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-edit"></i> Blog Düzenle TR<br/><small><a href="<?php echo URL."/en/admin/index.php?do=Blog"; ?>"><i class="fa fa-file-text-o"></i> Blog Göster</a></small></h2>
		<div class="item row">
			<form action="" method="POST">
				<label>Başlık: </label><input type="text" name="Blog_title" class="form-control" placeholder="İçerik Başlığı" value="<?php echo $Blog['Blog_title']; ?>" />
				<label>Küçük Resim: </label><input type="text" name="Blog_img" class="form-control" placeholder="İçerik Küçük Resim URL" value="<?php echo $Blog['Blog_img']; ?>" />
				<h6> RESİM BOYUTU 19200X1080 OLMALIDIR</H6>
				<label>Yorum Ayarları: </label><select name="Blog_comments" class="form-control">
					<option value="1" <?php echo ($Blog['Blog_comments'] == 1) ? "selected" : null; ?>>Yorumlar Açık</option>
					<option value="0" <?php echo ($Blog['Blog_comments'] == 0) ? "selected" : null; ?>>Yorumlar Kapalı</option>
				</select>
				<label>Kategori Seçin: </label><select name="category_id" class="form-control">
					<?php
						$row = $db->query("SELECT * FROM categories WHERE category_onoff=1 ORDER BY category_title ASC", PDO::FETCH_ASSOC);
						foreach($row as $categories){
							if($Blog['category_id'] == $categories['category_id']){
								echo "<option value='".$categories['category_id']."' selected>".$categories['category_title']."</option>";
							}else{
								echo "<option value='".$categories['category_id']."'>".$categories['category_title']."</option>";
							}
						}
					?>
				</select>
				<label>İçerik: </label><textarea name="Blog"><?php echo $Blog['Blog']; ?></textarea>
				<script>
				CKEDITOR.replace( 'Blog' );
				</script>
				<input type="submit" value="Düzenle" class="btn btn-cta-primary form-control" />
			</form>
		</div>
	</div>
</section>