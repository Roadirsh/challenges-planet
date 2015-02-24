<?php if(!empty($data['user'])){ $user = $data['user'][0]; } 
 if(!empty($data['info'])){
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
	if(!empty($data['action'])){ $actions = $data['action']; } 
	

	 ?>
<?php if(!empty($data['phone'])){ $infoplusplus = $data['phone'][0]['phone_num']; } ?>



<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>


<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	   
        <h1>
            <?php echo strtoupper($user['user_lastname']); ?> <?php echo ($user['user_firstname']); ?> <small>- <em><?php echo $user['user_pseudo']; ?></em></small>
        </h1>
        
        <ol class="breadcrumb">
            <li><a href="<?php echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $user['user_pseudo']; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="content" class="span10">
            <?if(!empty($_SESSION['message'])){ ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['message']; ?></div>
            <?php $_SESSION['message'] = ''; } ?>
            <div class="row-fluid">		
	        	<form class="form-horizontal" enctype="multipart/form-data" action="<?php echo MODULE . 'user' . ACTION . 'uponeuser&id='.$data['user'][0]['user_id']; ?>" method="post">

                <div class="user user_profil">
                    <?php if(!empty($user['user_profil_pic'])){ ?>
				        <img class="avatar" alt="Dennis Ji" src="<?php echo AVATAR . $user['user_profil_pic']; ?>">
				        
				        <input  type="hidden" name="profpic" value="<?php echo $user['user_profil_pic']; ?>"/>
                    <?php } else { ?>
				        <img class="avatar" alt="Dennis Ji" src="images/avatar/default.png"> 
                    <?php } ?> 
                    
                    <input type="file" name="user_img" />
                </div>	
                <div class="user user_info">
                
                    
                        <h3>
                            <input type='text' name="user_lastname" value="<?php echo strtoupper($user['user_lastname']); ?>" /> 
                            <small>
                                <em>
                                    <input type='text' name="user_pseudo" value="<?php echo $user['user_pseudo']; ?>"/>
                                </em>
                            </small>
                            <input type='text' name="user_firstname" value="<?php echo $user['user_firstname']; ?> " /> 
                            <small>
                                <em>
                                    <input type='password' name="user_password" value="" placeholder="password"/>
                                </em>
                            </small>
                        </h3>
                        <p><small><em>sign up date : <?php echo $user['user_date']; ?> </em></small></p>
                        <ul class="admin_info">
                            <li>
                                <span><b>Type</b>: <?php echo $user['user_type']; ?></span>
                            </li>
                            <li>
                                <span><b>E-mail</b>: <br></span><input type='email' name="user_mail" value="<?php echo $user['user_mail']; ?>" />
                            </li>
                            
                            <li>
                                <span><b> Phone</b>: <br>
                                </span>
                                <?php if(!empty($infoplusplus)){ ?>
                                    <input class="input-large focused" name="phone_num" id="phone_num" type="text" title='The phone number must be between 6 and 14 numbers and begin with a "+".' pattern="^\+(?:[0-9]?){6,14}[0-9]$" value="<?php echo $infoplusplus; ?>">

                                <?php } else { ?>
        									<input class="input-large focused" name="phone_num" id="phone_num" type="text" title='The phone number must be between 6 and 14 numbers and begin with a "+".' pattern="^\+(?:[0-9]?){6,14}[0-9]$" placeholder="+33xxxxxxx">
                                <?php } ?> 
                            </li>
                            
                        </ul>
                </div>
                <div class="user user_info">
                        
                        <ul class="admin_info">
                           
                            <li>
                             Home adress:<br/>
                             	Num:
                                <?php if(!empty($adressHome['ad_num'])){ ?>
                                    <input type="text" name="ad_numHome" value="<?php echo $adressHome['ad_num']; ?>" />
                                <?php } else { ?> 
                                    <input type="text" name="ad_numHome" />
                                <?php } ?> 
                                Street:
                                <?php if(!empty($adressHome['ad_street'])){ ?>
                                    <input type="text" name="ad_streetHome" value="<?php echo $adressHome['ad_street']; ?>" />
                                <?php } else { ?>
                                    <input type="text" name="ad_streetHome" />
                                <?php } ?>
                            </li>
                            <li>
                            Zipcode
                                <?php if(!empty($adressHome['ad_zipcode'])){ ?>
                                    <input type="text" name="ad_zipcodeHome" value="<?php echo $adressHome['ad_zipcode']; ?>" />
                                <?php } else { ?>
                                    <input type="text" name="ad_zipcodeHome" />
                                <?php } ?>
                                City:
                                <?php if(!empty($adressHome['ad_city'])){ ?>
                                    <input type="text" name="ad_cityHome" value="<?php echo $adressHome['ad_city']; ?>" />
                                <?php } else { ?>
                                    <input type="text" name="ad_cityHome" />
                                <?php } ?>
                            </li>
                            <li>   
							Country:
                                <?php if(!empty($adressHome['ad_country'])){ ?>
                                    <input type="text" name="ad_countryHome" value="<?php echo strtoupper($adressHome['ad_country']); ?>" />
                                <?php } else { ?>
                                    <input type="text" name="ad_countryHome" />
                                <?php } ?>
                            </li>
                        </ul>
                        
                        <ul class="admin_info">
                           
                            <li>
                             Invoice adress:<br/>
                             	Num:
                                <?php if(!empty($adressInvoice['ad_num'])){ ?>
                                    <input type="text" name="ad_numInvoice" value="<?php echo $adressInvoice['ad_num']; ?>" />
                                <?php } else { ?> 
                                    <input type="text" name="ad_numInvoice" />
                                <?php } ?> 
                                Street:
                                <?php if(!empty($adressInvoice['ad_street'])){ ?>
                                    <input type="text" name="ad_streetInvoice" value="<?php echo $adressInvoice['ad_street']; ?>" />
                                <?php } else { ?>
                                    <input type="text" name="ad_streetInvoice" />
                                <?php } ?>
                            </li>
                            <li>
                            Zipcode
                                <?php if(!empty($adressInvoice['ad_zipcode'])){ ?>
                                    <input type="text" name="ad_zipcodeInvoice" value="<?php echo $adressInvoice['ad_zipcode']; ?>" />
                                <?php } else { ?>
                                    <input type="text" name="ad_zipcodeInvoice" />
                                <?php } ?>
                                City:
                                <?php if(!empty($adressInvoice['ad_city'])){ ?>
                                    <input type="text" name="ad_cityInvoice" value="<?php echo $adressInvoice['ad_city']; ?>" />
                                <?php } else { ?>
                                    <input type="text" name="ad_cityInvoice" />
                                <?php } ?>
                            </li>
                            <li>   
							Country:
                                <?php if(!empty($adressInvoice['ad_country'])){ ?>
                                    <input type="text" name="ad_countryInvoice" value="<?php echo strtoupper($adressInvoice['ad_country']); ?>" />
                                <?php } else { ?>
                                    <input type="text" name="ad_countryInvoice" />
                                <?php } ?>
                            </li>
                        </ul>
                        
        				<div style="clear:both"></div>
        				<input type="submit" class="btn btn-success">
                    
                </div>
                </form>

                <div style="clear:both"></div>
                <?php if(!empty($actions)){ 
	                
	                
                ?>
                <table class="table table-hover user_event">
                    <tr>
                        <th>Date</th>
                        <th>Event</th>
                        <th>Groups name</th>
                    </tr>
                    <?php foreach($actions as $tab){ ?>
                    <tr>
                        <td><?php if(!empty($tab['event_date'])){ echo $tab['event_date']; } ?></td>
                        <td><?php if(!empty($tab['event_name'])){ echo $tab['event_name']; } ?></td>
                        <td><?php if(!empty($tab['group_name'])){ echo $tab['group_name']; } ?></td>
                    </tr>
                    <?php }?>
                </table>
                <?php } else { ?>
                    <div class="alert alert-info user_event">
        				There is no event or groups linked
        			</div>
                <?php } ?>
            </div>
		</div><!--/row-->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<?php include(ROOT . "view/layout/footer.inc.php"); ?>