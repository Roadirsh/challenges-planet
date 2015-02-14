<? if(!empty($data['user'])){ $user = $data['user'][0]; } ?>
<? if(!empty($data['info'])){
	if($data['info'][0]['ad_type'] == "Home" || $data['info'][1]['ad_type'] == "Home")
	{
		if($data['info'][0]['ad_type'] == "Home")
		{
			$adressHome = $data['info'][0]; 
		}
		else
		{
			$adressHome = $data['info'][1];
		}
	}
	if($data['info'][0]['ad_type'] == "Invoice" || $data['info'][1]['ad_type'] == "Invoice"){
		if($data['info'][0]['ad_type'] == "Invoice")
		{
			$adressInvoice = $data['info'][0]; 
		}
		else
		{
			$adressInvoice = $data['info'][1];
		}
	}
	
	}
	
	/*
var_dump($adressInvoice);
	exit(0);
*/ ?>
<? if(!empty($data['phone'])){ $infoplusplus = $data['phone'][0]['phone_num']; } ?>



<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>


<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	   
        <h1>
            <? echo strtoupper($user['user_lastname']); ?> <? echo ($user['user_firstname']); ?> <small>- <em><? echo $user['user_pseudo']; ?></em></small>
        </h1>
        
        <ol class="breadcrumb">
            <li><a href="<? echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><? echo $user['user_pseudo']; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="content" class="span10">
            <?if(!empty($_SESSION['message'])){ ?>
                <div class="alert alert-success" role="alert"><? echo $_SESSION['message']; ?></div>
            <? $_SESSION['message'] = ''; } ?>
            <div class="row-fluid">		
	        	<form class="form-horizontal" enctype="multipart/form-data" action="<? echo MODULE . 'user' . ACTION . 'uponeuser&id='.$data['user'][0]['user_id']; ?>" method="post">

                <div class="user user_profil">
                    <?php if(!empty($user['user_profil_pic'])){ ?>
				        <img class="avatar" alt="Dennis Ji" src="<? echo AVATAR . $user['user_profil_pic']; ?>">
				        
				        <input  type="hidden" name="profpic" value="<? echo $user['user_profil_pic']; ?>"/>
                    <? } else { ?>
				        <img class="avatar" alt="Dennis Ji" src="images/avatar/default.png"> 
                    <? } ?> 
                    
                    <input type="file" name="user_img" />
                </div>	
                <div class="user user_info">
                
                    
                        <h3>
                            <input type='text' name="user_lastname" value="<? echo strtoupper($user['user_lastname']); ?>" /> 
                            <small>
                                <em>
                                    <input type='text' name="user_pseudo" value="<? echo $user['user_pseudo']; ?>"/>
                                </em>
                            </small>
                            <input type='text' name="user_firstname" value="<? echo $user['user_firstname']; ?> " /> 
                            <small>
                                <em>
                                    <input type='password' name="user_password" value="" placeholder="password"/>
                                </em>
                            </small>
                        </h3>
                        <p><small><em>sign up date : <? echo $user['user_date']; ?> </em></small></p>
                        <ul class="admin_info">
                            <li>
                                <span><b>Type</b>: <? echo $user['user_type']; ?></span>
                            </li>
                            <li>
                                <span><b>E-mail</b>: <br></span><input type='email' name="user_mail" value="<? echo $user['user_mail']; ?>" />
                            </li>
                            
                            <li>
                                <span><b> Phone</b>: <br>
                                </span>
                                <? if(!empty($infoplusplus)){ ?>
                                    <input class="input-large focused" name="phone_num" id="phone_num" type="text" title='The phone number must be between 6 and 14 numbers and begin with a "+".' pattern="^\+(?:[0-9]?){6,14}[0-9]$" value="<? echo $infoplusplus; ?>">

                                <? } else { ?>
        									<input class="input-large focused" name="phone_num" id="phone_num" type="text" title='The phone number must be between 6 and 14 numbers and begin with a "+".' pattern="^\+(?:[0-9]?){6,14}[0-9]$" placeholder="+33xxxxxxx">
                                <? } ?> 
                            </li>
                            
                        </ul>
                </div>
                <div class="user user_info">
                        
                        <ul class="admin_info">
                           
                            <li>
                             Home adress:<br/>
                             	Num:
                                <? if(!empty($adressHome['ad_num'])){ ?>
                                    <input type="text" name="ad_numHome" value="<? echo $adressHome['ad_num']; ?>" />
                                <? } else { ?> 
                                    <input type="text" name="ad_numHome" />
                                <? } ?> 
                                Street:
                                <? if(!empty($adressHome['ad_street'])){ ?>
                                    <input type="text" name="ad_streetHome" value="<? echo $adressHome['ad_street']; ?>" />
                                <? } else { ?>
                                    <input type="text" name="ad_streetHome" />
                                <? } ?>
                            </li>
                            <li>
                            Zipcode
                                <? if(!empty($adressHome['ad_zipcode'])){ ?>
                                    <input type="text" name="ad_zipcodeHome" value="<? echo $adressHome['ad_zipcode']; ?>" />
                                <? } else { ?>
                                    <input type="text" name="ad_zipcodeHome" />
                                <? } ?>
                                City:
                                <? if(!empty($adressHome['ad_city'])){ ?>
                                    <input type="text" name="ad_cityHome" value="<? echo $adressHome['ad_city']; ?>" />
                                <? } else { ?>
                                    <input type="text" name="ad_cityHome" />
                                <? } ?>
                            </li>
                            <li>   
							Country:
                                <? if(!empty($adressHome['ad_country'])){ ?>
                                    <input type="text" name="ad_countryHome" value="<? echo strtoupper($adressHome['ad_country']); ?>" />
                                <? } else { ?>
                                    <input type="text" name="ad_countryHome" />
                                <? } ?>
                            </li>
                        </ul>
                        
                        <ul class="admin_info">
                           
                            <li>
                             Invoice adress:<br/>
                             	Num:
                                <? if(!empty($adressInvoice['ad_num'])){ ?>
                                    <input type="text" name="ad_numInvoice" value="<? echo $adressInvoice['ad_num']; ?>" />
                                <? } else { ?> 
                                    <input type="text" name="ad_numInvoice" />
                                <? } ?> 
                                Street:
                                <? if(!empty($adressInvoice['ad_street'])){ ?>
                                    <input type="text" name="ad_streetInvoice" value="<? echo $adressInvoice['ad_street']; ?>" />
                                <? } else { ?>
                                    <input type="text" name="ad_streetInvoice" />
                                <? } ?>
                            </li>
                            <li>
                            Zipcode
                                <? if(!empty($adressInvoice['ad_zipcode'])){ ?>
                                    <input type="text" name="ad_zipcodeInvoice" value="<? echo $adressInvoice['ad_zipcode']; ?>" />
                                <? } else { ?>
                                    <input type="text" name="ad_zipcodeInvoice" />
                                <? } ?>
                                City:
                                <? if(!empty($adressInvoice['ad_city'])){ ?>
                                    <input type="text" name="ad_cityInvoice" value="<? echo $adressInvoice['ad_city']; ?>" />
                                <? } else { ?>
                                    <input type="text" name="ad_cityInvoice" />
                                <? } ?>
                            </li>
                            <li>   
							Country:
                                <? if(!empty($adressInvoice['ad_country'])){ ?>
                                    <input type="text" name="ad_countryInvoice" value="<? echo strtoupper($adressInvoice['ad_country']); ?>" />
                                <? } else { ?>
                                    <input type="text" name="ad_countryInvoice" />
                                <? } ?>
                            </li>
                        </ul>
                        
        				<div style="clear:both"></div>
        				<input type="submit" class="btn btn-success">
                    
                </div>
                </form>

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
        				There is no event or groups linked
        			</div>
                <? } ?>
            </div>
		</div><!--/row-->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<?php include(ROOT . "view/layout/footer.inc.php"); ?>