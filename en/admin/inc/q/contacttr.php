<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.php") : null; ?>

<?php

if ($_POST) {
    $site_adres = p('contact_adres');
    $site_tel = p('contact_tel');
    $site_fax = p('contact_fax');
    $site_email = p('contact_email');


    if (empty($site_adres)) {
        echo "<p class='alert alert-danger'>Lütfen gerekli alanları doldurup tekrar deneyin.</p>";
    } else {
        $update = $db->prepare("UPDATE contacttr SET contact_adres='{$site_adres}', contact_tel='{$site_tel}',contact_fax='{$site_fax}',   contact_email='{$site_email}'");
        $update->execute();
        echo "<p class='alert alert-success'>Ayarlar başarıyla düzenlendi.</p>";
        header("Refresh: 1; url=" . URL . "/en/admin/index.php?do=contacttr");
    }
}

$setting = $db->query("SELECT * FROM contacttr")->fetch(PDO::FETCH_ASSOC);
?>

<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-edit"></i> İletişim Kısmını Düzenle Düzenle</h2>
        <div class="item row">
            <form action="" method="POST">
                <label>Adres: </label><input type="text" name="contact_adres" class="form-control" placeholder="Adres" value="<?php echo $setting['contact_adres']; ?>" />
                <label>Telefon Numarası: </label><input type="text" name="contact_tel" class="form-control" placeholder="Telefon Numarası" value="<?php echo $setting['contact_tel']; ?>" />
                <label>Fax Numarası: </label><input type="text" name="contact_fax" class="form-control" placeholder="Fax Numarası" value="<?php echo $setting['contact_fax']; ?>" />
                <label>E-mail Adresi: </label><input type="text" name="contact_email" class="form-control" placeholder="E-mail Adresi" value="<?php echo $setting['contact_email']; ?>" />

                <input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
            </form>
        </div>
    </div>
</section>