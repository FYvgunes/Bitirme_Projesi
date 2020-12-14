<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; ?>

<?php

if($_POST){
		$site_title = p('site_title');
		$site_desc = p('site_desc');
		$site_name1 = p('site_name1');
		$site_name2 = p('site_name2');
		$facebook = p('facebook');
		$twitter = p('twitter');
		$instagram = p('instagram');
		$youtube = p('youtube');
		$profile_img = p('profile_img');
		$site_footer = p('site_footer');
		$site_reklam1 = p('site_reklam1');
		
		if(empty($site_title)){
			echo "<p class='alert alert-danger'>Lütfen gerekli alanları doldurup tekrar deneyin.</p>";
		}else{
			$update = $db->prepare("UPDATE setting SET site_title='{$site_title}', site_desc='{$site_desc}', site_name1='{$site_name1}', site_name2='{$site_name2}', facebook='{$facebook}', twitter='{$twitter}', instagram='{$instagram}', youtube='{$youtube}', profile_img='{$profile_img}', site_footer='{$site_footer}', site_reklam1='{$site_reklam1}'");
			$update->execute();
			echo "<p class='alert alert-success'>Ayarlar başarıyla düzenlendi.</p>";
		}
	}

	$setting = $db->query("SELECT * FROM setting")->fetch(PDO::FETCH_ASSOC);
?>

<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-edit"></i> Ayarları Düzenle</h2>
		<div class="item row">
			<form action="" method="POST">
				<label>Site Başlığı: </label><input type="text" name="site_title" class="form-control" placeholder="Site Başlığı" value="<?php echo $setting['site_title']; ?>" />
				
				<label>Footer (En Alt Açıklama): </label><input type="text" name="site_footer" class="form-control" placeholder="Footer" value="<?php echo $setting['site_footer']; ?>" />
				
				<input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
			</form>
		</div>
	</div>
</section>