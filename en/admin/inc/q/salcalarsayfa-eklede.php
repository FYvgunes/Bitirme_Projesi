<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.php") : null; ?>

<?php
if ($_POST) {


    $Konala_text = p('salcalar_text');
    $Konala_title = p('salcalar_title');
    $posted = "resim1";


    if ($_FILES["resim1"]['name']) {
        $filename = $_FILES["$posted"]['name'];
        $efilename = explode('.', $filename);
        $uzanti = $efilename[count($efilename) - 1];
        $isim = md5(microtime());
        $yeniad = "KanolaYagi" . $isim . "." . $uzanti . "";
        if (!file_exists("resimler")) {
            mkdir("resimler");
        }
        $hedef1 = "resimler/" . $yeniad;
        if (move_uploaded_file($_FILES["$posted"]['tmp_name'], "resimler/" . $yeniad)) {
            $insert = $db->exec("INSERT INTO salcalarsayfade SET  salcalar_url='{$hedef1}', salcalar_title='{$Konala_title}', salcalar_text='{$Konala_text}'");
            //$insert->execute();
            echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Bekleyiniz...</p>";
            header("Refresh: 0; url=" . URL . "/en/admin/index.php?do=salcalarsayfade");
        } else {
            echo "<p class='alert alert-danger'>Dosya ekleme işlemlerinde hata oluştu</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>Eklemeye çalıştığınız kategori zaten mevcut. Aynı başlıkta kategori kabul etmiyoruz başka bir başlıkla tekrar deneyebilirsin.</p>";
    }
}
?>

<section class="section">
    <div class="section-inner">

        <h2 class="heading"><i class="fa fa-plus"></i> Salcalar Ve Soslar Sayfa DE<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=salcalarsayfade"; ?>"><i class="fa fa-file-text-o"></i> İçerikleri Göster </a></small></h2>

        <div class="item row">
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Sayfa başlığı: </label><input type="text" name="salcalar_title" class="form-control" placeholder="Sayfa Başlığı" />

                <label>Resim: </label><input type="file" name="resim1" class="form-control" placeholder=" Küçük Resim URL" />

                <label>Sayfa İçerik: </label><textarea name="salcalar_text"></textarea>
                <script>
                    CKEDITOR.replace('salcalar_text');
                </script>



                <input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
            </form>
        </div>
    </div>
</section>