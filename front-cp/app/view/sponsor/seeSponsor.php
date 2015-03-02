<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['sponsors']) && !empty($data['sponsors']) ){ $sponsors = $data['sponsors']; }?>
        
    <div class="list-sponsors">
    	<div class="medium-10 clearfix">
    		<h1>They helped them</h1>
            <div class="clearfix wrapper-list">
                <?php foreach ($sponsors as $key => $sponsor) { ?>
                    <a href="<?php echo MODULE . 'sponsor' . ACTION . 'seeonesponsor' . ID . $sponsor["user_id"]; ?>">
                        <div class="medium-4 columns" >
                            <div class="wrapper">
                                <div class="img" style="background:url('<?php echo AVATAR . $sponsor['user_profil_pic']; ?>'); background-position: center;background-size: cover;">
                                    <div class="hover">
                                        <span>See this sponsor</span>
                                    </div>
                                </div>
                                <span class="name-user"><?php echo $sponsor['user_lastname'] . ' ' . $sponsor['user_firstname']; ?></span>
                                
                                <?php /** Pural management **/ ?>
                                <?php if($sponsor['helped'] < 2){ $team = "team" ; } else { $team = "teams"; } ?>
                                <span class="number-team">They helped <span><?php echo $sponsor['helped']; ?></span> <?php echo $team; ?></span>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
    	</div>
    </div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>