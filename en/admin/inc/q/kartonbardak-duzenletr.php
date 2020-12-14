<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.php") : null; ?>

<?php
$id = g('id');
if (empty($id)) {
    header("Location: " . URL . "/en/admin/index.php?do=kartonbardaktr");

    exit;
} else {
    $sor = $db->query("SELECT * FROM kartonbardaktr WHERE kartonbardak_id={$id} AND kartonbardak_p=0");
    $Blog = $sor->fetch(PDO::FETCH_ASSOC);
    $Blog_varmi = $sor->rowCount();
    if ($Blog_varmi > 0) {
        null;
    } else {
        header("Location: " . URL . "/en/admin/index.php?do=kartonbardaktr");
        exit;
    }
}

if ($_POST) {
    $Konala_text = p('kartonbardak_title');
    $posted = "resim1";
    if (empty($_FILES["resim1"]['name'])) {

        $insert = $db->exec("UPDATE  kartonbardaktr SET kartonbardak_p=0, kartonbardak_title='{$Konala_text}' WHERE kartonbardak_id={$id}");
        echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Bekleyiniz...</p>";
        header("Refresh: 0; url=" . URL . "/en/admin/index.php?do=kartonbardaktr");
    } else if ($_FILES["resim1"]['name']) {
        $filename = $_FILES["$posted"]['name'];
        $efilename = explode('.', $filename);
        $uzanti = $efilename[count($efilename) - 1];
        $isim = md5(microtime());
        $yeniad = "" . $isim . "." . $uzanti . "";
        $hedef1 = "resimler/" . $yeniad;

        if (move_uploaded_file($_FILES["$posted"]['tmp_name'], "resimler/" . $yeniad)) {
            $insert = $db->exec("UPDATE  kartonbardaktr SET  kartonbardak_url='{$hedef1}',kartonbardak_p=0, kartonbardak_title='{$Konala_text}' WHERE kartonbardak_id={$id}");
            //$insert->execute();
            echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Bekleyiniz...</p>";
            header("Refresh: 0; url=" . URL . "/en/admin/index.php?do=kartonbardaktr");
        } else {
            echo "<p class='alert alert-danger'>Dosya ekleme işlemlerinde hata oluştu</p>";
        }
    }
}

$sor = $db->query("SELECT * FROM kartonbardaktr WHERE kartonbardak_id={$id}");
$Blog = $sor->fetch(PDO::FETCH_ASSOC);
?>

<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-plus"></i> Karton Bardak Düzenle TR<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=kartonbardaktr"; ?>"><i class="fa fa-file-text-o"></i> içerikleri Göster </a></small></h2>

        <div class="item row">
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Mevcut Küçük Resim </label>
                <br>
                <img src="<?php echo $Blog['kartonbardak_url']; ?>" style="width: 250px;  height: 200px;
    object-fit: cover;  " alt="">
                <br>

                <label>Küçük Resim Güncelle: </label><input type="file" name="resim1" class="form-control" value="" placeholder="Blok Küçük Resim URL" />
                <label>Başlık</label>

                <input type="text" name="kartonbardak_title" class="form-control" value="<?php echo $Blog['kartonbardak_title']; ?>">

                <input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
            </form>
        </div>
    </div>
</section>