<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.php") : null; ?>

<?php
$id = g('id');
if (empty($id)) {
    header("Location: " . URL . "/en/admin/index.php?do=alemiyumfolyoen");

    exit;
} else {
    $sor = $db->query("SELECT * FROM alemiyumfolyoen WHERE alemiyumfolyo_id={$id} AND alemiyumfolyo_p=0");
    $Blog = $sor->fetch(PDO::FETCH_ASSOC);
    $Blog_varmi = $sor->rowCount();
    if ($Blog_varmi > 0) {
        null;
    } else {
        header("Location: " . URL . "/en/admin/index.php?do=alemiyumfolyoen");
        exit;
    }
}

if ($_POST) {
    $Konala_text = p('alemiyumfolyo_title');
    $posted = "resim1";
    if (empty($_FILES["resim1"]['name'])) {

        $insert = $db->exec("UPDATE  alemiyumfolyoen SET alemiyumfolyo_p=0, alemiyumfolyo_title='{$Konala_text}' WHERE alemiyumfolyo_id={$id}");
        echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Bekleyiniz...</p>";
        header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=alemiyumfolyoen");
    } else if ($_FILES["resim1"]['name']) {
        $filename = $_FILES["$posted"]['name'];
        $efilename = explode('.', $filename);
        $uzanti = $efilename[count($efilename) - 1];
        $isim = md5(microtime());
        $yeniad = "" . $isim . "." . $uzanti . "";
        $hedef1 = "resimler/" . $yeniad;

        if (move_uploaded_file($_FILES["$posted"]['tmp_name'], "resimler/" . $yeniad)) {
            $insert = $db->exec("UPDATE  alemiyumfolyoen SET  alemiyumfolyo_url='{$hedef1}',alemiyumfolyo_p=0, alemiyumfolyo_title='{$Konala_text}' WHERE alemiyumfolyo_id={$id}");
            //$insert->execute();
            echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Bekleyiniz...</p>";
            header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=alemiyumfolyoen");
        } else {
            echo "<p class='alert alert-danger'>Dosya ekleme işlemlerinde hata oluştu</p>";
        }
    }
}

$sor = $db->query("SELECT * FROM alemiyumfolyoen WHERE alemiyumfolyo_id={$id}");
$Blog = $sor->fetch(PDO::FETCH_ASSOC);
?>

<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-plus"></i> Alwmiyum Folyo Düzenle EN<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=alemiyumfolyoen"; ?>"><i class="fa fa-file-text-o"></i> içerikleri Göster </a></small></h2>

        <div class="item row">
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Mevcut Küçük Resim </label>
                <br>
                <img src="<?php echo $Blog['alemiyumfolyo_url']; ?>" style="width: 250px;  height: 200px;
    object-fit: cover;  " alt="">
                <br>

                <label>Küçük Resim Güncelle: </label><input type="file" name="resim1" class="form-control" value="" placeholder="Blok Küçük Resim URL" />
                <label>Başlık</label>

                <input type="text" name="alemiyumfolyo_title" class="form-control" value="<?php echo $Blog['alemiyumfolyo_title']; ?>">

                <input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
            </form>
        </div>
    </div>
</section>