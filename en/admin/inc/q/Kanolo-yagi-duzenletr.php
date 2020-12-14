<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.php") : null; ?>

<?php
$id = g('id');
if (empty($id) || !is_numeric($id)) {
    header("Location: " . URL . "/en/admin/index.php?do=Kanolo-yagitr");
    exit;
} else {
    $sor = $db->query("SELECT * FROM kanolayagitr WHERE kanolayagiid={$id} AND kanolayagi_p=0");
    $Blog = $sor->fetch(PDO::FETCH_ASSOC);
    $Blog_varmi = $sor->rowCount();
    if ($Blog_varmi > 0) {
        null;
    } else {
        header("Location: " . URL . "/en/admin/index.php?do=Kanola-yagitr");
        exit;
    }
}

if ($_POST) {
    $Konala_text = p('kanoloyagi_text');
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
            $insert = $db->exec("UPDATE  kanolayagitr SET  kanolayagi_url='{$hedef1}',kanolayagi_p=0, kanolayagi_text='{$Konala_text}'");
            //$insert->execute();
            echo "<p class='alert alert-success'>İçerik başarıyla eklendi. Lütfen Bekleyiniz...</p>";
            header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=Kanola-yagitr");
        } else {
            echo "<p class='alert alert-danger'>Dosya ekleme işlemlerinde hata oluştu</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>Ekleme İşlemi Gerçekleşmedi</p>";
    }
}

$sor = $db->query("SELECT * FROM kanolayagitr WHERE kanolayagiid={$id} AND kanolayagi_p=0");
$Blog = $sor->fetch(PDO::FETCH_ASSOC);
?>

<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-plus"></i> Kanola Yağı Düzenle TR<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=Blog"; ?>"><i class="fa fa-file-text-o"></i> Blokları Göster </a></small></h2>

        <div class="item row">
            <form action="" method="POST" enctype="multipart/form-data">

                <label>Küçük Resim: </label><input type="file" name="resim1" class="form-control" placeholder="Blok Küçük Resim URL" />

                <label>İçerik: </label><textarea name="kanoloyagi_text"></textarea>
                <script>
                    CKEDITOR.replace('kanoloyagi_text');
                </script>



                <input type="submit" value="Kaydet" class="btn btn-cta-primary form-control" />
            </form>
        </div>
    </div>
</section>