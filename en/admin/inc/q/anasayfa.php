<?php echo !defined("INDEX") ? header("Location: " . URL . "en/404.html") : null;

//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT kanolayagiid FROM kanolayagitr WHERE kanolayagi_p=0", PDO::FETCH_ASSOC);
$sayfa1 = $sorgu->rowCount();
//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT aycicegiyagid FROM aycicegiyagtr WHERE aycicegiyag_p=0", PDO::FETCH_ASSOC);
$sayfa2 = $sorgu->rowCount();
//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT zeytinyagid FROM zeytinyagtr WHERE zeytinyag_p=0", PDO::FETCH_ASSOC);
$sayfa3 = $sorgu->rowCount();
//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT salcalarid FROM salcalartr WHERE salcalar_p=0", PDO::FETCH_ASSOC);
$sayfa4 = $sorgu->rowCount();

//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT bakliyat_id FROM bakliyattr WHERE bakliyat_p=0", PDO::FETCH_ASSOC);
$sayfa5 = $sorgu->rowCount();
//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT kuruyemis_id FROM kuruyemistr WHERE kuruyemis_p=0", PDO::FETCH_ASSOC);
$sayfa6 = $sorgu->rowCount();
//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT donukdeniz_id FROM donukdeniztr WHERE donukdeniz_p=0", PDO::FETCH_ASSOC);
$sayfa7 = $sorgu->rowCount();
//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT donuksebze_id FROM donuksebzetr WHERE donuksebze_p=0", PDO::FETCH_ASSOC);
$sayfa8 = $sorgu->rowCount();
//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT peynir_id FROM peynirtr WHERE peynir_p=0", PDO::FETCH_ASSOC);
$sayfa9 = $sorgu->rowCount();

//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT peceteler_id FROM pecetelertr WHERE peceteler_p=0", PDO::FETCH_ASSOC);
$sayfa11 = $sorgu->rowCount();
//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT kopukbardak_id FROM kopukbardaktr WHERE kopukbardak_p=0", PDO::FETCH_ASSOC);
$sayfa10 = $sorgu->rowCount();
//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT kartonbardak_id FROM kartonbardaktr WHERE kartonbardak_p=0", PDO::FETCH_ASSOC);
$sayfa12 = $sorgu->rowCount();


//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT plastikkap_id FROM plastikkaptr WHERE plastikkap_p=0", PDO::FETCH_ASSOC);
$sayfa13 = $sorgu->rowCount();

//kayıt sayılarını öğrenme
$sorgu = $db->query("SELECT alemiyumfolyo_id FROM alemiyumfolyotr WHERE alemiyumfolyo_p=0", PDO::FETCH_ASSOC);
$sayfa14 = $sorgu->rowCount();


// $sorgu = $db->query("SELECT message_id FROM messages", PDO::FETCH_ASSOC);
// $mesaj = $sorgu->rowCount();






?>
<section class="section">
    <div class="section-inner">
        <h2 class="heading"><i class="fa fa-dashboard"></i> Yönetim Paneli</h2>
        <div class="item">
            <p class="alert alert-info"><i class="fa fa-user"></i> Hoşgeldin, <?php echo $_SESSION['admin_username']; ?>!</p>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-success">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Kanola Yağı</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa1; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=Kanola-yagien"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Ayçiçek Yağı</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa2; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=aycicek-yagitr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Zeytin Yağı</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa3; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=zeytinyagitr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Salçalar Ve Soslar</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa4; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=salcalartr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Bakliyatlar Yağı</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa5; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=abakliyattr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-success">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Kuruyemiş</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa6; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=kuruyemistr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Donuk Deniz Ürünleri</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa7; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=donukdeniztr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Donuk Sebze Ürünleri</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa8; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=donuksebzetr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Peynirler </div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa9; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=peynirtr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Köpük bardak ve tabaklar</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa10; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=kopukbardaktr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-success">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Peçeteler</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa11; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=pecetelertr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Karton Bardak ve Tabak</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa12; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=kartonbardaktr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Plastik Bardak ve Tabak</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa13; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=plastikkaptr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> Alemiyum Folyo</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $sayfa14; ?> İçerik var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=alemiyumfolyotr"; ?>">İçerikleri Göster</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="fa fa-comments"></i> Mesajlar</div>
                        <div class="panel-body text-center">
                            <p>Toplam <?php echo $mesaj; ?> Mesaj var.</p>
                            <a href="<?php echo URL . "/en/admin/index.php?do=mesaj"; ?>">Mesajları Göster</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />

    </div>
    </div>
</section>