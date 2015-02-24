<?php if(!empty($data['user'])){ $user = $data['user'][0]; } ?>
<?php if(!empty($data['plususer'])){ $infoplus = $data['plususer']; } ?>
<?php if(!empty($data['action'])){ $actions = $data['action']; } ?>
<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo strtoupper($user['user_lastname']); ?> <?php echo $user['user_firstname']; ?> <small>- <em><?php echo $user['user_pseudo']; ?></em></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo MODULE . 'user' . ACTION . 'seeuser'?>">See Users</a></li>
            <li class="active"><?php echo strtoupper($user['user_lastname']); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="content" class="span10">
            <div class="row-fluid">		
                <div class="user user_profil">
                    <?php if(!empty($user['user_profil_pic'])){ ?>
				        <img class="avatar" alt="Dennis Ji" src="images/avatar/<?php echo $user['user_profil_pic']; ?>">
                    <?php } else { ?>
				        <img class="avatar" alt="Dennis Ji" src="images/avatar/default.png"> 
                    <?php } ?> 
                </div>
                <div class="user user_info">
                    <p><small><em>sign up date : <?php echo $user['user_date']; ?> </em></small></p>
                    <ul>
                        <li>
                            <span><b>E-mail</b>: </span><?php echo $user['user_mail']; ?>
                        </li>
                        <li>
                            <span><b>Type</b>: </span><?php echo $user['user_type']; ?>
                        </li>
                        <li>
                            <span><b>Donut</b>: </span><?php echo $user['user_donut']; ?>
                        </li>
                        <li>
                            <span><b><?php if(!empty($infoplus['phone_type'])){ 
                                            echo $infoplus['phone_type']; 
                                        } ?> Phone</b>: 
                            </span>
                            <?php if(!empty($infoplus['phone_num'])){ 
                                echo $infoplus['phone_indi'] . ' ' . $infoplus['phone_num'];
                            } else { echo 'Ø'; } ?> 
                        </li>
                    </ul>
                    <div style="clear:both"></div>
                    <div class="user_adress">
                    <?php if(!empty($infoplus[0]['ad_country'])){ ?>
                        <?php $i = 0; ?>
                        <?php while(count($infoplus) > $i){ ?>
                        
                        <ul>
                            <b><?php if(!empty($infoplus[$i]['ad_type'])){ echo $infoplus[$i]['ad_type']; } ?> address </b>:
                            <li>
                                <?php if(!empty($infoplus[$i]['ad_num'])){ echo $infoplus[$i]['ad_num']; } ?>
                                <?php if(!empty($infoplus[$i]['ad_street'])){ echo $infoplus[$i]['ad_street']; } ?>
                            </li>
                            <li>
                                <?php if(!empty($infoplus[$i]['ad_zipcode'])){ echo $infoplus[$i]['ad_zipcode']; } ?>
                                <?php if(!empty($infoplus[$i]['ad_city'])){ echo $infoplus[$i]['ad_city']; } ?>
                            </li>
                            <li>  
                                <?php if(!empty($infoplus[$i]['ad_country'])){ echo strtoupper($infoplus[$i]['ad_country']); } ?>
                            </li>
                        </ul>
                        <?php $i ++; ?>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </div>
                <div style="clear:both"></div>
                <?php if(!empty($actions)){ ?>
                <table class="table table-hover user_event">
                    <tr>
                        <th>Date</th>
                        <th>Event</th>
                        <th>Groups name</th>
                    </tr>
                    <?php foreach($actions as $k => $tab){ ?>
                    <tr>
                        <td><?php if(!empty($tab['event_date'])){ echo $tab['event_date']; } ?></td>
                        <td><?php if(!empty($tab['event_name'])){ echo $tab['event_name']; } ?></td>
                        <td><?php if(!empty($tab['group_name'])){ echo $tab['group_name']; } ?></td>
                    </tr>
                    <?php }?>
                </table>
                <?php } else { ?>
                    <div class="alert alert-info user_event">
        				<center>There is no event or groups linked</center>
        			</div>
                <?php } ?>
                
			</div><!--/row-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>