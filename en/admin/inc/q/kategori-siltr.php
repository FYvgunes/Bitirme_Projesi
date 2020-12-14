<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.html") : null;

$id = g('id');
$sor = $db->query("SELECT * FROM categoriestr WHERE category_id={$id} AND category_onoff=1");
$icerik = $sor->fetch(PDO::FETCH_ASSOC);
$icerik_varmi = $sor->rowCount();
if ($icerik_varmi > 0) {
    null;
} else {
    header("Location: " . URL . "/en/admin/index.php?do=kategoritr");
    exit;
}
?>
<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-trash-o"></i> Kategori Sil TR</h2>
        <div class="item row">
            <?php
            $sil = $db->prepare("UPDATE categoriestr SET category_onoff=0 WHERE category_id={$id}");
            $sil->execute();
            header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=kategoritr");
            ?>
            <p class="alert alert-success">Kategori başarıyla silindi.</p>
        </div>
    </div>
</section>