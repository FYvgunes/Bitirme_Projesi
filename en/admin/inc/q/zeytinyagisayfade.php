<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.php") : null; ?>
<h2 class="heading"><i class="fa fa-file-text-o"></i>Zeytin yağı DE<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=zeytinyagisayfa-eklede"; ?>"><i class="fa fa-plus"></i>
            İçerik Ekle</a></small> </h2>

<?php


if ($_POST) {

    $sayfa_title = p('zeytinyag_title');
    $sayfa_text = p('zeytinyag_text');
    $posted = "resim1";

    if (empty($_FILES["resim1"]['name'])) {

        $insert = $db->exec("UPDATE  zeytinyagisayfade SET zeytinyag_text='{$sayfa_text}',zeytinyag_title='{$sayfa_title}' ");
        echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Bekleyiniz...</p>";

        header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=zeytinyagisayfade");
    } else if ($_FILES["resim1"]['name']) {
        $filename = $_FILES["$posted"]['name'];
        $efilename = explode('.', $filename);
        $uzanti = $efilename[count($efilename) - 1];
        $isim = md5(microtime());
        $yeniad = "KanolaYagi" . $isim . "." . $uzanti . "";
        $hedef1 = "resimler/" . $yeniad;
        if (move_uploaded_file($_FILES["$posted"]['tmp_name'], "resimler/" . $yeniad)) {
            $insert = $db->exec("UPDATE  zeytinyagisayfade SET  zeytinyag_url='{$hedef1}',zeytinyag_title='{$sayfa_title}',zeytinyag_text='{$sayfa_text}' ");
            //$insert->execute();
            echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Bekleyiniz...</p>";
            header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=zeytinyagisayfade");
        } else {
            echo "<p class='alert alert-danger'>Dosya ekleme işlemlerinde hata oluştu</p>";
        }
    }
}



$setting = $db->query("SELECT * FROM zeytinyagisayfade")->fetch(PDO::FETCH_ASSOC);
?>

<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-edit"></i> Sayfa Yapısı</h2>
        <div class="item row">
            <form action="" method="POST" enctype="multipart/form-data">
                <img src="<?php echo $setting['zeytinyag_url']; ?>" style="width: 250px;  height: 200px; object-fit: cover;  " alt=""> <br>
                <label>Sayfa Başlıgı: </label><input type="text" name="zeytinyag_title" class="form-control" placeholder="Sayfa Başlığı" value="<?php echo $setting['zeytinyag_title']; ?>" />
                <label>Resim </label><input type="file" name="resim1" class="form-control" placeholder="Resim" />

                <label>Sayfa İçerik: </label><textarea name="zeytinyag_text"><?php echo $setting['zeytinyag_text']; ?></textarea>
                <script>
                    CKEDITOR.replace('zeytinyag_text');
                </script>

                <input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
            </form>
        </div>
    </div>
</section>