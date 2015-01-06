<? var_dump($data); ?>
<? if(!empty($data)){ $group = $data[0]; } ?>
<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">



    <div class="row-fluid">		
        <div class="user user_profil">
            <? if(!empty($user['user_profil_pic'])){ ?>
                <img src="img/group/<? echo $group['group_img']; ?>" alt="..." class="img-thumbnail">
            <? } ?>
        </div>	
        <div class="user user_info">
            <h2><? echo $group['group_name']; ?></h2>
            <p><small><em>sign up date : <? echo $group['group_date']; ?> </em></small></p>

        </div>
        <div style="clear:both"></div>

	</div><!--/row-->
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>