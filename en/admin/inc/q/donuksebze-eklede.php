<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.php") : null; ?>

<?php
if ($_POST) {


    $Konala_text = p('donuksebze_text');
    $posted = "resim1";

    if ($_FILES["resim1"]['name']) {
        $filename = $_FILES["$posted"]['name'];
        $efilename = explode('.', $filename);
        $uzanti = $efilename[count($efilename) - 1];
        $isim = md5(microtime());
        $yeniad = "" . $isim . "." . $uzanti . "";
        if (!file_exists("resimler")) {
            mkdir("resimler");
        }
        $hedef1 = "resimler/" . $yeniad;
        if (move_uploaded_file($_FILES["$posted"]['tmp_name'], "resimler/" . $yeniad)) {
            $insert = $db->exec("INSERT INTO donuksebzede SET  donuksebze_url='{$hedef1}',donuksebze_p=0, donuksebze_text='{$Konala_text}'");
            //$insert->execute();
            echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Bekleyiniz...</p>";
            header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=donuksebzede");
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

        <h2 class="heading"><i class="fa fa-plus"></i> Donuk Sebze Ürünleri DE<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=donuksebzede"; ?>"><i class="fa fa-file-text-o"></i> İçerikleri Göster </a></small></h2>

        <div class="item row">
            <form action="" method="POST" enctype="multipart/form-data">

                <label>Küçük Resim: </label><input type="file" name="resim1" class="form-control" placeholder="Blok Küçük Resim URL" />

                <label>İçerik: </label><textarea name="donuksebze_text"></textarea>
                <script>
                    CKEDITOR.replace('donuksebze_text');
                </script>



                <input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
            </form>
        </div>
    </div>
</section>