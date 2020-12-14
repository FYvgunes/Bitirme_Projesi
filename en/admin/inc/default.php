<?php echo !defined("INDEX") ? header("Location: ".URL."en/404.html") : null; ?>
<div class="container sections-wrapper">
        <div class="row">
            <div class="primary col-md-4 col-sm-12 col-xs-12">
            	<?php require_once('aside.php'); ?>
            </div><!--//primary-->
            <div class="secondary col-md-8 col-sm-12 col-xs-12">
                <?php
				$do = g("do");
				if(file_exists("inc/q/{$do}.php")){
				    require("q/{$do}.php");
				} else {
				    require("q/anasayfa.php");
				}
				?>
            </div><!--//secondary-->    
        </div><!--//row-->
</div><!--//masonry-->
