<? if(!empty($data)){ $group = $data['group'][0]; } ?>
<? if(!empty($data)){ $member = $data['group_user']; } ?>
<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <? echo $group['group_name']; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<? echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<? echo MODULE . 'project' . ACTION . 'seeproject'?>">See Projects</a></li>
            <li class="active"><? echo $group['group_name']; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
        <div id="content" class="span10">
            <div class="row-fluid">		
                <div class="user user_profil">
                    <? if(!empty($group['group_img'])){ ?>
                        <img src="images/group/<? echo $group['group_img']; ?>" alt="..." class="img-thumbnail">
                    <? } ?>
                </div>
                <div class="user user_info">
                    <?php if($group['group_valid'] == 1){ ?>
        			    <strong>Status:</strong> <span class="label label-success">Approved</span><br>   
        		    <? } else { ?>
        		        <strong>Status:</strong> <span class="label label-warning">Waiting</span><br>  
                    <? } ?>
                    <strong>Event:</strong> <? echo $group['event_name']; ?><br><br>
                    <strong>Group members:</strong><br>
                    <ul>
                        <? foreach($member as $k => $m){ ?>
                            <li><em><a href="<? echo MODULE . 'user' . ACTION . 'seeoneuser' . ID . $m['user_id']; ?>"><? echo $m['user_pseudo']; ?></a></em></li>
                        <? } ?>
                    </ul>
                </div>
                <div style="clear:both"></div>
                <div class="user user_info">
                    <h2><? echo $group['group_name']; ?></h2>
                    <p><small><em>sign up date : <? echo $group['group_date']; ?> </em></small></p>
                    <p><? echo $group['group_descr']; ?></p>
                </div>
                
        
        	</div><!--/row-->
        </div>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>