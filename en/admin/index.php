<?php
define("INDEX", true);
require_once('../config.php');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="tr">
<!--<![endif]-->

<head>
    <!-- Page Info -->
    <title><?php echo $setting['site_title']; ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <?php include('../inc/head.php'); ?>
    <script src="https://cdn.ckeditor.com/4.7.0/full-all/ckeditor.js"></script>




</head>

<body>
    <?php include('inc/header.php'); // Menu & Header 
    ?>

    <?php if (!isset($_SESSION['login'])) { ?>
        <div class="container sections-wrapper">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="primary col-md-4 col-sm-12 col-xs-12">
                    <?php
                    if ($_POST) {
                        $kadi = p("admin_username");
                        $sifre = p("admin_password");
                        if (empty($kadi) || empty($sifre)) {
                            $mesaj = "Kullanıcı Adı ve Şifre boş bırakılamaz...";
                        } else {
                            $sifre = sifre($sifre);
                            $giris = $db->query("SELECT * FROM admin WHERE admin_username='{$kadi}' AND admin_password='{$sifre}'");
                            if ($giris->rowCount()) {
                                $girdi = $giris->fetch(PDO::FETCH_ASSOC);
                                $_SESSION['admin_id'] = $girdi['admin_id'];
                                $_SESSION['admin_username'] = $girdi['admin_username'];
                                $_SESSION['admin_eposta'] = $girdi['admin_eposta'];
                                $_SESSION['login']  = true;
                                header("Location: " . URL . "/en/admin");
                            } else {
                                $mesaj = "Girilen Bilgiler Uyuşmuyor...";
                            }
                        }
                    }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-sign-in"></i> Giriş Yap</div>
                        <div class="panel-body">
                            <?php if ($_POST) {
                                echo '<p class="alert alert-danger">' . $mesaj . '</p>';
                            } ?>
                            <form action="" method="POST">
                                <input type="text" name="admin_username" class="form-control" placeholder="Kullanıcı Adı" />
                                <input type="password" name="admin_password" class="form-control" placeholder="Şifre" />
                                <input type="submit" value="Giriş Yap" class="btn btn-cta-primary form-control" />
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <!--//row-->
        </div>
        <!--//masonry-->
    <?php } else {
        include('inc/default.php');
    } ?>

    <?php include('../inc/footer.php'); ?>
</body>




</html>