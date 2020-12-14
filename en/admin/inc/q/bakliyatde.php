<?php
echo !defined("INDEX") ? header("Location: " . URL . "/404.php") : null;
?>
<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-file-text-o"></i> Bakliyat DE<br /><small><a href="<?php echo URL . "/en/admin/index.php?do=bakliyat-eklede"; ?>"><i class="fa fa-plus"></i> İçerik Ekle</a></small><br> <small><a href="<?php echo URL . "/en/admin/index.php?do=bakliyatsayfade"; ?>"><i class="fa fa-plus"></i> Sayfa Yapısını Değiştir</a></small></h2>
        <div class="item row">
            <?php
            $sorgu = $db->query("SELECT bakliyat_id FROM bakliyatde WHERE bakliyat_p=0 ", PDO::FETCH_ASSOC);
            $ksayisi = $sorgu->rowCount();
            $sayfa = g("s") ? g("s") : 1;
            $limit = 12; // 12 Tane gösteriyoruz tek seferde
            $ssayisi = ceil($ksayisi / $limit);
            if ($sayfa > $ssayisi) {
                $sayfa = 1;
            } // Kullanıcı rastgele sayfa girebilir get ile, bunu önlemek için gereksiz sorgudan kurtulmak için
            $baslangic = ($sayfa * $limit) - $limit;

            $row = $db->query("SELECT * FROM bakliyatde WHERE bakliyat_p=0  ORDER BY bakliyat_id DESC  LIMIT $baslangic, $limit", PDO::FETCH_ASSOC);
            foreach ($row as $content) {
            ?>
                <div class="list-group-item list-trend">
                    <div class="clearfix content-heading">
                        <img class="pull-left img-trend" src="<?php echo $content['bakliyat_url']; ?>" />
                        <h3 class="txt-trend">Bakliyat <?php echo $content['bakliyat_id']; ?> <br /><small><a target="_blank" href="<?php echo URL . "/en/" . $content['bakliyat_url']; ?>"><i class="fa fa-eye"></i> Sayfayı Göster</a> | <a href="<?php echo URL . "/en/admin/index.php?do=bakliyat-duzenlede&id=" . $content['bakliyat_id']; ?>"><i class="fa fa-edit"></i> Düzenle</a> | <a onclick="return confirm('İçeriği silmek istediğinizden emin misiniz?');" href="<?php echo URL . "/en/admin/index.php?do=bakliyat-silde&id=" . $content['bakliyat_id']; ?>"><i class="fa fa-trash-o"></i> Sil</a></small></h3>
                    </div>
                </div>
            <?php
            }

            if ($ksayisi > 0) {
            } else {
                echo "<p class='alert alert-danger'>Henüz hiç içerik eklenmemiş.</p>";
            }

            if ($ksayisi > $limit) { ?>
                <div class="text-center">
                    <ul class="pagination">
                        <?php
                        echo "<a><li class='btn btn-default'>" . $sayfa . "/" . $ssayisi . "</li></a>";
                        $forlimit = 1;
                        if ($sayfa > $forlimit) {
                            echo "<a href='" . URL . "/en/admin/index.php?do=" . $do . "&s=1'><li class='btn btn-default'>İlk</li></a>";
                        }
                        for ($i = $sayfa - $forlimit; $i <= $sayfa + $forlimit; $i++) {
                            if ($i > 0 && $i <= $ssayisi) {
                                if ($i == $sayfa) {
                                    echo "<a href=''><li class='btn btn-default active'>" . $i . "</li></a>";
                                } else {
                                    echo "<a href='" . URL . "/en/admin/index.php?do=" . $do . "&s=" . $i . "'><li class='btn btn-default'>" . $i . "</li></a>";
                                }
                            }
                        }
                        echo "<a href='" . URL . "/en/admin/index.php?do=" . $do . "&s=" . $ssayisi . "'><li class='btn btn-default'>Son</li></a>";
                        ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</section>