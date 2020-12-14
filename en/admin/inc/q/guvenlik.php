<?php echo !defined("INDEX") ? header("Location: ".URL."/404.html") : null; ?>

<?php
$id = $_SESSION['admin_id'];

if($_POST['sifre_degistir']){
	$eski_sifre = p('eski_sifre');
	$yeni_sifre1 = p('yeni_sifre1');
	$yeni_sifre2 = p('yeni_sifre2');

	if(empty($eski_sifre) || empty($yeni_sifre1)) {
		$hata = "Şifre Boş Bırakılamaz.";
	}else{
		if($yeni_sifre1==$yeni_sifre2){
			$sifre = sifre($eski_sifre);
			$ysifre = sifre($yeni_sifre1);
			$sorgu = $db->prepare("SELECT COUNT(*) FROM admin WHERE admin_password='{$sifre}' AND admin_id={$id}");
			$sorgu->execute();
			$say = $sorgu->fetchColumn();
			if($say>0){
				$update = $db->prepare("UPDATE admin SET admin_password='{$ysifre}' WHERE admin_id={$id}");
				$update->execute();
				echo "<p class='alert alert-success'>Şifre başarıyla güncellendi. Lütfen sisteme tekrar giriş yapın...</p>";
				header("Refresh: 2; url=".URL."/en/admin/index.php?do=cikis");
			}else{
				$hata = "Girilen Eski Şifre Yenlış.";
			}
		}else{
			$hata = "Girilen Şifreler Uyuşmuyor.";
		}
	}
}

if($_POST['email_degistir']){
	$email = p('email');
	if(empty($email)){
		$hata = "E-Posta Adresiniz Boş Bırakamazsınız.";
	}else{
		$update_e = $db->prepare("UPDATE admin SET admin_eposta='{$email}' WHERE admin_id={$id}");
		$update_e->execute();
		echo "<p class='alert alert-success'>E-Posta başarıyla güncellendi.</p>";
		header("Refresh: 2; url=".URL."/en/admin/index.php?do=guvenlik");
	}
}

if($_POST['kullaniciadi_degistir']){
	$admin_username = p('admin_username');
	if(empty($admin_username)){
		$hata = "Kullanıcı Adını Boş Bırakamazsınız.";
	}else{
		$update_e = $db->prepare("UPDATE admin SET admin_username='{$admin_username}' WHERE admin_id={$id}");
		$update_e->execute();
		echo "<p class='alert alert-success'>Kullanıcı adı başarıyla güncellendi.</p>";
		header("Refresh: 2; url=".URL."/en/admin/index.php?do=guvenlik");
	}
}

if(!empty($hata)){
	echo "<p class='alert alert-danger'>".$hata."</p>";
}

$admin = $db->query("SELECT * FROM admin WHERE admin_id={$id}")->fetch(PDO::FETCH_ASSOC);
?>
<section class="section">
	<div class="section-inner">
		<h2 class="heading"><i class="fa fa-shield"></i> Güvenlik</h2>
		<div class="item row">
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="panel panel-success">
					<div class="panel-heading"><i class="fa fa-key"></i> Şifre Değiştir</div>
					<div class="panel-body">
						<form action="" method="POST">
							<input type="password" name="eski_sifre" class="form-control" placeholder="Eski Şifre" />
							<input type="password" name="yeni_sifre1" class="form-control" placeholder="Yeni Şifre" />
							<input type="password" name="yeni_sifre2" class="form-control" placeholder="Yeni Şifre Doğrula" />
							<input type="hidden" name="sifre_degistir" value="1" />
							<input type="submit" value="Güncelle" class="btn btn-cta-primary form-control" />
						</form>
					</div>
				</div>
			</div>
			
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="panel panel-success">
					<div class="panel-heading"><i class="fa fa-envelope"></i> E-Posta Güncelle</div>
					<div class="panel-body">
						<form action="" method="POST">
							<input type="email" name="email" class="form-control" placeholder="E-Posta Adresiniz" value="<?php echo $admin['admin_eposta']; ?>" />
							<input type="hidden" name="email_degistir" value="1" />
							<input type="submit" value="Güncelle" class="btn btn-cta-primary form-control" />
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="panel panel-info">
					<div class="panel-heading"><i class="fa fa-user"></i> Kullanıcı Adı Güncelle</div>
					<div class="panel-body">
						<form action="" method="POST">
							<input type="text" name="admin_username" class="form-control" placeholder="Yeni Kullanıcı Adı Gir" value="<?php echo $admin['admin_username']; ?>" />
							<input type="hidden" name="kullaniciadi_degistir" value="1" />
							<input type="submit" value="GÜNCELLE" class="btn btn-info form-control" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>