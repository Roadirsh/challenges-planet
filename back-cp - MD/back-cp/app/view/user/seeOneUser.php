<? if(!empty($data['user'])){ $user = $data['user'][0]; } ?>
<? if(!empty($data['plususer'])){ $infoplus = $data['plususer']; } ?>
<? if(!empty($data['action'])){ $actions = $data['action']; } ?>

<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">



    <div class="row-fluid">		
        <div class="user user_profil">
            <? if(!empty($user['user_profil_pic'])){ ?>
                <img src="img/avatar/<? echo $user['user_profil_pic']; ?>" alt="..." class="img-thumbnail">
            <? } ?>
        </div>	
        <div class="user user_info">
            <h2><? echo strtoupper($user['user_lastname']); ?> <? echo $user['user_firstname']; ?> <small>- <em><? echo $user['user_pseudo']; ?></em></small></h2>
            <p><small><em>sign up date : <? echo $user['user_date']; ?> </em></small></p>
            <ul>
                <li>
                    <span><b>E-mail</b>: </span><? echo $user['user_mail']; ?>
                </li>
                <li>
                    <span><b>Type</b>: </span><? echo $user['user_type']; ?>
                </li>
                <li>
                    <span><b>Donut</b>: </span><? echo $user['user_donut']; ?>
                </li>
                <li>
                    <span><b><? if(!empty($infoplus['phone_type'])){ 
                                    echo $infoplus['phone_type']; 
                                } ?> Phone</b>: 
                    </span>
                    <? if(!empty($infoplus['phone_num'])){ 
                        echo $infoplus['phone_indi'] . ' ' . $infoplus['phone_num'];
                    } else { echo 'Ø'; } ?> 
                </li>
            </ul>
            <div style="clear:both"></div>
            <div class="user_adress">
            <? if(!empty($infoplus[0]['ad_country'])){ ?>
                <? $i = 0; ?>
                <? while(count($infoplus) > $i){ ?>
                
                <ul>
                    <b><? if(!empty($infoplus[$i]['ad_type'])){ echo $infoplus[$i]['ad_type']; } ?> address </b>:
                    <li>
                        <? if(!empty($infoplus[$i]['ad_num'])){ echo $infoplus[$i]['ad_num']; } ?>
                        <? if(!empty($infoplus[$i]['ad_street'])){ echo $infoplus[$i]['ad_street']; } ?>
                    </li>
                    <li>
                        <? if(!empty($infoplus[$i]['ad_zipcode'])){ echo $infoplus[$i]['ad_zipcode']; } ?>
                        <? if(!empty($infoplus[$i]['ad_city'])){ echo $infoplus[$i]['ad_city']; } ?>
                    </li>
                    <li>  
                        <? if(!empty($infoplus[$i]['ad_country'])){ echo strtoupper($infoplus[$i]['ad_country']); } ?>
                    </li>
                </ul>
                <? $i ++; ?>
                <? } ?>
            <? } ?>
            </div>
        </div>
        <div style="clear:both"></div>
        
        <? if(!empty($actions)){ ?>
        <table class="table table-hover user_event">
            <tr>
                <th>Date</th>
                <th>Event</th>
                <th>Groups name</th>
            </tr>
            <? foreach($actions as $k => $tab){ ?>
            <tr>
                <td><? if(!empty($tab['event_date'])){ echo $tab['event_date']; } ?></td>
                <td><? if(!empty($tab['event_name'])){ echo $tab['event_name']; } ?></td>
                <td><? if(!empty($tab['group_name'])){ echo $tab['group_name']; } ?></td>
            </tr>
            <? }?>
        </table>
        <? } else { ?>
            <div class="alert alert-info user_event">
				<center>There is no event or groups linked</center>
			</div>
        <? } ?>
	</div><!--/row-->
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>