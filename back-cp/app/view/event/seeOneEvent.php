<?php  if(!empty($data)){ $event = $data['event'][0]; } ?>
<?php  if(!empty($data)){ $group = $data['event_group']; } ?>
<?php  include(ROOT . "view/layout/header.inc.php"); ?>
<?php  include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php  include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php  echo $event['event_name']; ?> <small>- <em><?php  echo $event['event_location']; ?></em></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php  echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php  echo MODULE . 'event' . ACTION . 'seeevent'; ?>">See Event</a></li>
            <li class="active"><?php  echo $event['event_name']; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="content" class="span10">
	        <?php if(!empty($_SESSION['message'])){ ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['message']; ?></div>
            <?php $_SESSION['message'] = ''; } ?>
            <div class="row-fluid">		
	        	<form class="form-horizontal" enctype="multipart/form-data" action="<?php  echo MODULE . 'event' . ACTION . 'Uponeevent&id='.$event['event_id']; ?>" method="post">	
					<input type="hidden" name="update" value="true" />
	                <div class="user user_profil">
	                    <?php  if(!empty($event['event_img'])){ ?>
	                     <img class="avatar" alt="" src="<?php  echo EVENT.'slider/'.$event['event_img']; ?>">
					        
					        <input  type="hidden" name="event_img" value="<?php  echo $event['event_img']; ?>"/>
	                    <?php  } ?>
	                    <input type="file" name="event_img" />
	                </div>
	                <div class="user user_info">
	                   <select name="valid"  style="width:20%;" required>								
								
								<option value="1" <?php if($event['event_valid'] == 1){ echo 'selected'; }?>> Online </option>
								<option value="0" <?php if($event['event_valid'] != 1){ echo 'selected'; }?>> Offline </option>
								
							
							</select>
	                    
	                    <div class="controls">
							<select name="event_type" required>
								<option value="earth" <?php  if ($event['event_type'] == "earth") { echo "selected" ; } ?> >Land</option>
								<option value="sea" <?php  if ($event['event_type'] == "sea") { echo "selected" ; } ?>>Sea</option>
								<option value="air" <?php  if ($event['event_type'] == "air") { echo "selected" ; } ?>>Air</option>
								<option value="car" <?php  if ($event['event_type'] == "car") { echo "selected" ; } ?>>Car</option>
								<option value="boat" <?php  if ($event['event_type'] == "boat") { echo "selected" ; } ?>>Boat</option>
								<option value="surf" <?php  if ($event['event_type'] == "surf") { echo "selected" ; } ?>>Surf</option>
								<option value="bike" <?php  if ($event['event_type'] == "bike") { echo "selected" ; } ?>>Bike</option>
							</select>
						</div>
	                    <strong>Begin:</strong> <input type="date" name="event_begin" value="<?php  echo $event['event_begin']; ?>"  /><br>
	                    <strong>End:</strong> <input type="date" name="event_end" value="<?php  echo $event['event_end']; ?>"  /><br><br>
	                    <strong>Groups:</strong><br>
	                    <ul>
	                        <?php  foreach($group as $k => $g){ ?>
	                            <li><em><a href="<?php  echo MODULE . 'project' . ACTION . 'seeoneproject' . ID . $g['group_id']; ?>"><?php  echo $g['group_name']; ?></a></em></li>
	                        <?php  } ?>
	                        
	                    </ul>
	                </div>
	                <div style="clear:both"></div>
	                <div class="user user_info">
	                    <h2><input type="text" value="<?php  echo $event['event_name']; ?>" name="event_name" /> <small>- <em><input type="text" value="<?php  echo $event['event_location']; ?>" name="event_location" /></em></small></h2>
	                    <p><small><em>sign up date : <?php  echo $event['event_date']; ?> </em></small></p>
	                    <div class="editable" name="group_description"><?php  echo $event['event_decr']; ?></div>
	                </div>	                
	                <div style="clear:both"></div>
					<input type="submit" class="btn btn-success">
                </form>
        	</div><!--/row-->
        </div>
        <script type="text/javascript">
	    tinymce.init({
				selector: "div.editable",
				inline: true,
				plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
       			"insertdatetime media table contextmenu paste"
	   			],
	   			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
			});
 </script>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
<?php include(ROOT . "view/layout/footer.inc.php"); ?>