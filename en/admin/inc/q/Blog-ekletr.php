<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; ?>

<?php
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
			$sorgu = $db->prepare("SELECT COUNT(*) FROM blogtr WHERE Blog_url='{$blog_url}'");
			$sorgu->execute();
			$say = $sorgu->fetchColumn();
			if($say>0){
				echo "<p class='alert alert-danger'>Eklemeye çalıştığınız içerik zaten mevcut. Aynı başlıkta içerik kabul etmiyoruz başka bir başlıkla tekrar deneyebilirsin.</p>";
			}else{
				$insert = $db->exec("INSERT INTO blogtr SET  Blog_url='{$blog_url}', Blog_title='{$blog_title}', Blog_img='{$blog_img}', Blog='{$blog}', Blog_p=0,Blog_hit=2, Blog_comments='{$blog_comments}', category_id='{$category_id}' ");
				//$insert->execute();
				echo "<p class='alert alert-success'>Blog başarıyla eklendi. Lütfen Bekleyiniz...</p>";
				header("Refresh: 2; url=".URL."/en/admin/index.php?do=Blogtr");
                    


                 
			  }
           
		}
	}
?>

<section class="section">
	<div class="section-inner">
	
	<h2 class="heading"><i class="fa fa-plus"></i> Blok Ekle TR<br/><small><a href="<?php echo URL."/en/admin/index.php?do=Blog"; ?>"><i class="fa fa-file-text-o"></i> Blokları Göster </a></small></h2>
	
	<div class="item row">
			<?php
			$sorgu = $db->prepare("SELECT COUNT(*) FROM categories");
			$sorgu->execute();
			$say = $sorgu->fetchColumn();
			if($say>0){
			?>
			<form action="" method="POST">
				<label>Başlık: </label><input type="text" name="Blog_title" class="form-control" placeholder="Blok Başlığı" />
				<label>Küçük Resim: </label><input type="text" name="Blog_img" class="form-control" placeholder="Blok Küçük Resim URL" />
				<h6> RESİM BOYUTU 1920X1080 OLMALIDIR</H6>
				<label>Yorum Ayarları: </label><select name="Blog_comments" class="form-control">
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
				<label>İçerik: </label><textarea name="Blog"></textarea>
				<script>
				CKEDITOR.replace( 'Blog' );
				</script>
				<input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
			</form>
			<?php }else { ?>
				<p class="alert alert-danger">Hiç kategori eklemediğiniz için Blok ekleyemiyorsunuz. Hemen şimdi <a href="<?php echo URL."/en/admin/index.php?do=kategori-ekle"; ?>">Kategori Ekle</a></p>
			<?php } ?>
		</div>
	</div>
</section>