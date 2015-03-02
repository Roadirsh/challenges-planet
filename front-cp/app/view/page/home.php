<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['slider']) && !empty($data['slider']) ){ $slider = $data['slider']; }?>
<?php if(isset($data['group']) && !empty($data['group']) ){ $team = $data['group']; } ?>
<?php if(isset($data['done']) && !empty($data['done']) ){ $done = $data['done']; } ?>
<?php if(isset($data['sponsor']) && !empty($data['sponsor']) ){ $sponsor = $data['sponsor']; }?>

    <div class="slider">
        <?php $i = 0; ?>
        <?php if(isset($data['slider']) && !empty($data['slider']) ){ ?>
            <?php foreach($slider as $k => $s){ ?>
            <a href="<?php echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . $s['event_id']; ?>">
            	<div class="img-slider" index='<?php echo $i; ?>'>
            		<img src="<?php echo EVENT . 'slider/' . $s['event_img']; ?>" alt="">
            		<div class="show-for-small-only caption clearfix">
            			<span><?php echo $s['event_name']; ?></span>
            		</div>
            		<div class="show-for-medium-up slogan-title-event">
            			<h1 class="slogan"><?php echo JOIN ?></h1>
            			<h3><?php echo $s['event_name']; ?></h3>
            			<p><?php echo mb_strimwidth($s['event_decr'], 0, 150, "..."); ?></p>
            			<a href="<?php echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . $s['event_id']; ?>">
            			    <span class="see-event">Let's see the event !</span>
            		</div>
            	</div>
        	<?php $i ++; ?>
            </a>
        	<?php } ?> 
        <?php } else { ?> 
                <div class="img-slider " index='<?php echo $i; ?>'>
                    <img src="https://paulinevetuna.files.wordpress.com/2013/08/keep-calm-go-with-the-flow-desktop.jpg" alt="">
                    <div class="show-for-small-only caption clearfix">
                        <span>SORRY</span>
                    </div>
                    <div class="show-for-medium-up slogan-title-event">
                        <h1 class="slogan"><?php echo JOIN ?></h1>
                        <h3>SORRY</h3>
                        <p>We don't have any events for the moment. The admin team is going to manage it ASAP </p>
                        
                    </div>
                </div>
        <?php } ?>
    </div>



<h1 class="show-for-small-only slogan"><span>Join </span>the best caritives student challenges</h1>

    <div class="global-content clearfix">
    
		<!-- <a href="<?php //echo MODULE . 'project' . ACTION . 'seeproject'; ?>" onClick="ga('send', 'event', 'link','clic', 'teamv3');">  -->
        <div class="teams clearfix">
		    <h2>Our teams</h2>
    		<section class="first clearfix">
                <?php if(isset($team) && !empty($team) ){ ?>
        		    <?php foreach($team as $k => $t){ ?>
                        <?php if(isset($t['group_name']) && !empty($t['group_name'])){ ?>
                        <div class="columns large-3 medium-4 team-wrapper">
                            <div class="wrapper">
                                <a href="<?php echo MODULE . 'project' . ACTION . 'seeoneproject' . ID . $t['group_id']; ?>" alt="" title="">
                                    <div class="img" style="background:url('<?php echo PROJECT . $t['group_img']; ?>'); background-position: top left;background-size: cover;">
                                        <div class="hover"><span>They need you<br>help them</span></div>
                                    </div>
                                </a>
                                <div class="title-team"><a href="<?php echo MODULE . 'event' . ACTION . 'seeoneproject' . ID . $t['group_id']; ?>" alt="" title=""><?php echo $t['group_name']; ?></a></div>
                                <div class="name"><?php echo $t['event_name']; ?></div>
                                <div class="date"><?php echo formDate($t['event_begin'], 0); ?> - <?php echo formDate($t['event_end'], 0); ?></div>
                                <div class="progressteam">
                                    <div class="clearfix">
                                        <div class="columns medium-4 small-4 numbers">
                                            <span><?php echo $t['group_money']; ?> €</span>
                                            <br>goals
                                        </div>
                                        <div class="columns medium-4 small-4 funded">
                                            <span><?php  echo number_format(($t['group_needed'] / $t['group_money']) *100, 0); ?>  %</span>
                                            </br>funded
                                        </div>
                                        <div class="columns medium-4 small-4 daysleft">
                                            <span>
                                                <?php $diff = (new DateTime('now'))->diff(new DateTime($t['event_end'])); ?>
                                                <?php echo $diff->format('%a'); //%a take the lot Y-m-d ?>
                                            </span>
                                            <br>
                                                DAYS LEFT
                                        </div>
                                    </div>
                                    <?php $percent = number_format(($t['group_needed'] / $t['group_money']) *100, 0);?>
                                    <div class="progress-team notyet" data-percent="<?php echo $percent; ?>"></div>
                                </div>
                            </div>
                        </div>
            			<?php } ?>
                    <?php $i ++; ?>
                    <?php } ?>
                <?php } else { ?>
                    <div class="columns large-3 medium-4 team-wrapper">
                            <div class="wrapper">
                                <div class="img">
                                    <img src="http://sd.keepcalm-o-matic.co.uk/i/keep-calm-and-love-sports-40.png"
                                </div>
                                <div class="title-team"><p>We have no teams yet</p></div>
                                <div class="progressteam">
                                    The admins are doing their own ASAP ! 
                                    <br>Let's challenge 
                                </div>
                            </div>
                        </div>
                <?php } ?>
                <?php if(isset($done) && !empty($done) ){ ?>
    			<div class="columns large-3 medium-4 team-wrapper">
    				<div class="wrapper done">
    					<div class="img" style="background:url('<?php echo PROJECT . $done['group_img']; ?>'); background-position: left;background-size: cover;">
    						<a href="<?php echo MODULE . 'project' . ACTION . 'seeoneproject' . ID . $done['group_id']; ?>" alt="" title="">
                                <div class="hover done"><span>It's done thank you !</span></div>
                            </a>
    					</div>
    					<div class="title-team"><?php echo $done['group_name']; ?></div>
    					<div class="name"><?php echo $done['event_name']; ?></div>
                        <div class="date"><?php echo formDate($done['event_begin'], 0); ?> - <?php echo formDate($done['event_end'], 0); ?></div>
    					<div class="progressteam">
    						<span class="validate"></span>
    						<div class="number"><span>100 %</span><br>goal reached !</div>
    						<div class="progress-team-done good"></div>
    					</div>
    				</div>
    			</div>
    			<?php } ?>
            </section>

        </div>
    <!-- </a> -->

	<a href="<?php echo MODULE . 'sponsor' . ACTION . 'seesponsor'; ?>" onClick="ga('send', 'event', 'link','clic', 'sponsorsv3');">
		<div class="sponsors clearfix">
		<h2>Our sponsors</h2>
		<section class="first clearfix">
		    <?php if(isset($data['sponsor']) && !empty($data['sponsor']) ){ ?>
    		    
    		    <?php foreach($sponsor as $k => $s){ ?>
    			<a href="<?php echo MODULE . 'sponsor' . ACTION . 'seeonesponsor' . ID . $s['user_id']; ?>">
                    <div class="medium-4 large-3 columns sponsor-wrapper">
        				<div class="wrapper">
                            <div class="img" style="background:url('img/avatar/<?php echo $s['user_profil_pic']; ?>'); background-position: left;background-size: cover;">
                                <div class="hover">
                                    <span>They helped them !</span>
                                </div>
                            </div>
        					<!-- <a class="website" href="<?php echo $s['user_site']; ?>" target="blank">Go their website</a>
        					<a class="help sponsored" href="<?php echo MODULE . 'sponsor' . ACTION . 'seeonesponsor' . ID . $s['user_id']; ?>">View events sponsored</a> -->
        				</div>
    			    </div>
    			<?php } ?>
            <?php } else { ?>
                    <a href="">
                    <div class="medium-4 large-3 columns sponsor-wrapper">
                        <div class="wrapper">
                            <div class="img">
                                <img src="http://www.keepcalmandposters.com/posters/1522053.png" alt="">
                                <div class="hover">
                                    <span>Help us</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
		</section>
		</div>
	</a>		
</div>

<!--  /* * * * * * * * * * * * * * * * * * * * * * * *
* FOR DEVELOPERS ONLY, TYPE up up down down left right left right b a => PRIVATE JOKE 
*/ -->
<audio src="../../front-cp/public/img/user.mp3" style="" id="hoverSound">
		Your browser does not support the audio element.
</audio><script type="text/javascript">
	jQuery(function(){
    var kKeys = [];
    function Kpress(e){
        kKeys.push(e.keyCode);
        if (kKeys.toString().indexOf("38,38,40,40,37,39,37,39,66,65") >= 0) {
            jQuery(this).unbind('keydown', Kpress);
            kExec();
        }
    }
    jQuery(document).keydown(Kpress);
});
function kExec(){
   document.getElementById('hoverSound').play(); 
}
</script>
<!-- /* * * * * * * * * * * * * * * * * * * * * * * * */ -->

<?php include(ROOT . "view/layout/footer.inc.php"); ?>
