<?php echo !defined("INDEX") ? header("Location: " . URL . "/404.html") : null;

$id = g('id');

$sor = $db->query("SELECT * FROM alemiyumfolyotr WHERE alemiyumfolyo_id={$id} AND alemiyumfolyo_p=0");
$icerik = $sor->fetch(PDO::FETCH_ASSOC);
$icerik_varmi = $sor->rowCount();

if ($icerik_varmi > 0) {
    null;
} else {
    header("Location: " . URL . "/en/admin/index.php?do=alemiyumfolyotr");
    exit;
}


?>

<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-trash-o"></i> Alemiyoum Folyo Sil TR</h2>
        <div class="item row">
            <?php
            $var = 0;
            $Blog = $db->query("SELECT * FROM alemiyumfolyotr WHERE alemiyumfolyo_id={$id} AND alemiyumfolyo_p=0");
            $Blog = $sor->fetch(PDO::FETCH_ASSOC);
            if ($var == 0) {
                unlink($Blog['alemiyumfolyo_url']);
                $sil = $db->prepare("DELETE FROM alemiyumfolyotr WHERE alemiyumfolyo_id={$id}");
                $sil->execute();
                header("Refresh: 2; url=" . URL . "/en/admin/index.php?do=alemiyumfolyotr");
            }
            ?>
            <p class="alert alert-success">içerik başarıyla silindi.</p>



        </div>
    </div>
</section>