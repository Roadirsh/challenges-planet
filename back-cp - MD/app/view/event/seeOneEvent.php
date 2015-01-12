<? if(!empty($data)){ $event = $data['event'][0]; } ?>
<? if(!empty($data)){ $group = $data['event_group']; } ?>
<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">
    <div class="row-fluid">		
        <div class="user user_profil">
            <? if(!empty($event['event_img'])){ ?>
                <img src="img/event/<? echo $event['event_img']; ?>" alt="..." class="img-thumbnail">
            <? } ?>
        </div>
        <div class="user user_info">
            <?php if($event['event_valid'] == 1){ ?>
			    <strong>Status:</strong> <span class="label label-success">Approved</span><br>   
		    <? } else { ?>
		        <strong>Status:</strong> <span class="label label-warning">Waiting</span><br>  
            <? } ?>
            <br><br>
            <strong>Begin:</strong> <? echo $event['event_begin']; ?><br>
            <strong>End:</strong> <? echo $event['event_end']; ?><br><br>
            <strong>Groups:</strong>
            <ul>
                <? foreach($group as $k => $g){ ?>
                    <li><em><a href="<? echo MODULE . 'project' . ACTION . 'seeoneproject' . ID . $g['group_id']; ?>"><? echo $g['group_name']; ?></a></em></li>
                <? } ?>
                
            </ul>
        </div>
        <div style="clear:both"></div>
        <div class="user user_info">
            <h2><? echo $event['event_name']; ?> <small>- <em><? echo $event['event_location']; ?></em></small></h2>
            <p><small><em>sign up date : <? echo $event['event_date']; ?> </em></small></p>
            <p><? echo ($event['event_decr']); ?></p>
        </div>
	</div><!--/row-->
</div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>