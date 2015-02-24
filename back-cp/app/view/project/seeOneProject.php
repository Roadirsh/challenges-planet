<?php if(!empty($data)){ $group = $data['group'][0]; } ?>
<?php if(!empty($data)){ $member = $data['group_user']; } ?>


<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $group['group_name']; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?php echo MODULE . 'project' . ACTION . 'seeproject'?>">See Projects</a></li>
            <li class="active"><?php echo $group['group_name']; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
        <div id="content" class="span10">
            <div class="row-fluid">	
	            <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo MODULE . 'project' . ACTION . 'Uponeproject&id='.$group['group_id']; ?>" method="post">	
	                <div class="user user_profil">
	                    
	                    
	                    <?php if(!empty($group['group_img'])){ ?>
					        <img class="avatar" alt="" src="<?php echo PROJECT . $group['group_img']; ?>">
					        
					        <input  type="hidden" name="grouppic" value="<?php echo $group['group_img']; ?>"/>
	                    <?php } else { ?>
					        <img class="avatar" alt="Dennis Ji" src="images/avatar/default.png"> 
	                    <?php } ?> 
	                    
	                    <input type="file" name="group_img" />
	                </div>
	                <div class="user user_info">
		                <input type="hidden" name="update" value="true" />
	                    
	        			    <select name="valid"  style="width:20%;" required>
								
								
								<option value="1" <?php if($group['group_valid'] == 1){ echo 'selected'; }?>> Online </option>
								<option value="0" <?php if($group['group_valid'] != 1){ echo 'selected'; }?>> Offline </option>
								
							
							</select>	<br>                    <strong>Event:</strong> <?php echo $group['event_name']; ?><br><br>
	                    <input type="hidden" value="<?php echo $group['event_id']; ?>" name="event_id" >
	                    <strong>Group members:</strong><br>
	                    
	                    <select class="members" name="members[]" multiple="multiple" style="width:100%;" required>
							<?php foreach($data['listeuser'] as $student) {
										if(in_array($student, $member)){
											$selected = 'selected';
										}
										else{
											$selected = '';
										}
										echo '<option value="'.$student["user_id"].'" '. $selected.'>'.$student["user_pseudo"]. " - ".$student["user_mail"].'</option>';
									}
							?>
						</select>
	                    
	                </div>
	                <div style="clear:both"></div>
	                <div class="user user_info">
	                    <h2><input type="text" name='group_name' value="<?php echo $group['group_name']; ?>"></h2>
	                    <input type="number" name="group_money" value="<?php echo $group['group_money']; ?>" />
	                    <p><small><em>sign up date : <?php echo $group['group_date']; ?> </em></small></p>
	                    <div class="editable" name="group_description"><?php echo $group['group_descr']; ?></div>
	                </div>
	                <div style="clear:both"></div>
					<input type="submit" class="btn btn-success">
                </form>
        
        	</div><!--/row-->
        </div>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
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
			$('.members').select2();
 </script>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>