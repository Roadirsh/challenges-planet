<? if(!empty($data['user'])){ $user = $data['user'][0]; } ?>
<? if(!empty($data['info'])){ $infoplus = $data['info'][0]; } ?>

<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">
    <?if(!empty($_SESSION['message'])){ ?>
        <div class="alert alert-success" role="alert"><? echo $_SESSION['message']; ?></div>
    <? $_SESSION['message'] = ''; } ?>
    <div class="row-fluid">		
        <div class="user user_profil">
            <? if(!empty($user['user_profil_pic'])){ ?>
                <img src="img/avatar/<? echo $user['user_profil_pic']; ?>" alt="..." class="img-thumbnail">
            <? } ?>
            <center><input type="file" name="user_img" /></center>
        </div>	
        <div class="user user_info">
        
            <form class="form-horizontal" enctype="multipart/form-data" action="<? echo MODULE . 'user' . ACTION . 'uponeadmin'; ?>" method="post">
            
                <h2><input type='text' name="user_lastname" value="<? echo strtoupper($user['user_lastname']); ?>" /> 
                    <input type='text' name="user_firstname" value="<? echo $user['user_firstname']; ?> " /> 
                    <small><em><input type='text' name="user_pseudo" value="<? echo $user['user_pseudo']; ?>"/></em></small>
                    <small><em><input type='password' name="user_password" value="" placeholder="password"/></em></small>
                </h2>
                <p><small><em>sign up date : <? echo $user['user_date']; ?> </em></small></p>
                <ul class="admin_info">
                    <li>
                        <span><b>Type</b>: <? echo $user['user_type']; ?>
                    </li>
                    <li>
                        <span><b>E-mail</b>: <br></span><input type='email' name="user_mail" value="<? echo $user['user_mail']; ?>" />
                    </li>
                    
                    <li>
                        <span><b><? if(!empty($infoplus['phone_type'])){ 
                                        echo $infoplus['phone_type']; 
                                    } ?> Phone</b>: 
                        </span>
                        <? if(!empty($infoplus['phone_num'])){ ?>
                            <input type="text" name="phone_indi" value="<? echo $infoplus['phone_indi']; ?>"/>
                            <input type="text" name="phone_num" value="<? echo $infoplus['phone_num']; ?>" />
                        <? } else { ?>
                            <input type="text" name="phone_indi" placeholder="+31"/>
                            <input type="text" name="phone_num" />
                        <? } ?> 
                    </li>
                    
                </ul>
                
                <ul class="admin_info">
                    <b>Adress</b>:
                    <li>
                        <? if(!empty($infoplus['ad_num'])){ ?>
                            <input type="text" name="ad_num" value="<? echo $infoplus['ad_num']; ?>" />
                        <? } else { ?> 
                            <input type="text" name="ad_num" />
                        <? } ?> 
                        <? if(!empty($infoplus['ad_street'])){ ?>
                            <input type="text" name="ad_street" value="<? echo $infoplus['ad_street']; ?>" />
                        <? } else { ?>
                            <input type="text" name="ad_street" />
                        <? } ?>
                    </li>
                    <li>
                        <? if(!empty($infoplus['ad_zipcode'])){ ?>
                            <input type="text" name="ad_zipcode" value="<? echo $infoplus['ad_zipcode']; ?>" />
                        <? } else { ?>
                            <input type="text" name="ad_zipcode" />
                        <? } ?>
                        <? if(!empty($infoplus['ad_city'])){ ?>
                            <input type="text" name="ad_city" value="<? echo $infoplus['ad_city']; ?>" />
                        <? } else { ?>
                            <input type="text" name="ad_city" />
                        <? } ?>
                    </li>
                    <li>   
                        <? if(!empty($infoplus['ad_country'])){ ?>
                            <input type="text" name="ad_country" value="<? echo strtoupper($infoplus['ad_country']); ?>" />
                        <? } else { ?>
                            <input type="text" name="ad_country" />
                        <? } ?>
                    </li>
                </ul>
                
				
				<input type="submit" class="btn btn-success">
            </form>
            
        </div>
        <div style="clear:both"></div>
	</div><!--/row-->
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>