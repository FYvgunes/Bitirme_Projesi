<?php echo !defined("INDEX") ? header("Location: " . URL . "/en/404.html") : null; ?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $site_url . "/en/admin"; ?>"><i class="fa fa-lock"></i> Yönetim Paneli</a>
        </div>
        <?php if (isset($_SESSION['login'])) { ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav ">



                </ul>
                <ul class="nav navbar-nav ">
                    <li><a target="_blank" href="<?php echo URL . "/en/index.php"; ?>"><i class="fa fa-eye"></i> Siteyi Göster</a></li>
                    <li><a href="<?php echo URL . "/en/admin/index.php?do=mesaj"; ?>"><i class="fa fa-comments"></i> Mesajlar</a></li>
                    <li><a href="<?php echo URL . "/en/admin/index.php?do=cikis"; ?>"><i class="fa fa-sign-out"></i> Çıkış Yap</a></li>
                    <li><a href="<?php echo URL . "/en/admin/index.php?do=ayar"; ?>"><i class="fa fa-cog"></i> Ayarlar</a></li>
                    <li><a href="<?php echo URL . "/en/admin/index.php?do=guvenlik"; ?>"><i class="fa fa-shield"></i> Güvenlik</a></li>

                </ul>

            </div><!-- /.navbar-collapse -->
        <?php } ?>
    </div><!-- /.container-fluid -->
</nav>