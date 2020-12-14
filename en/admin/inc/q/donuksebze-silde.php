<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.php") : null;

$id = g('id');
$sor = $db->query("SELECT * FROM donuksebzede WHERE donuksebze_id={$id} AND donuksebze_p=0");
$icerik = $sor->fetch(PDO::FETCH_ASSOC);
$icerik_varmi = $sor->rowCount();
if ($icerik_varmi > 0) {
    null;
} else {
    header("Location: " . URL . "/en/admin/index.php?do=donuksebzede");
    exit;
}
?>
<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-deash-o"></i> Donuk Sebze Sil DE</h2>
        <div class="item row">
            <?php
            $sil = $db->prepare("DELETE FROM donuksebzede WHERE kuruyemisid={$id}");
            $sil->execute();
            header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=donuksebzede");
            ?>
            <p class="alert alert-success">içerik başarıyla silindi.</p>
        </div>
    </div>
</section>