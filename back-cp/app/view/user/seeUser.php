<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">
    <?if(!empty($_SESSION['message'])){ ?>
        <div class="alert alert-success" role="alert"><? echo $_SESSION['message']; ?></div>
    <? $_SESSION['message'] = ''; } ?>
    
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>User </h2>
					</div>
					<div class="box-content">
					    <div class="row-fluid">
					        <div class="span6">
					            <div id="DataTables_Table_0_length" class="dataTables_length">
					                <label>
					                    <select size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0">
					                    <option value="10" selected="selected">10</option>
					                    <option value="25">25</option>
					                    <option value="50">50</option>
					                    <option value="100">100</option>
                                        </select> records per page
                                    </label>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="dataTables_filter" id="DataTables_Table_0_filter">
                                    <label>Search: <input type="text" aria-controls="DataTables_Table_0"></label>
                                </div>
                            </div>
                        </div>
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>User name</th>
								  <th>First name</th>
								  <th>Last name</th>
								  <th>D.O.B</th>
								  <th>Mail</th>
								  <th>Date regist.</th>
								  <th>Role</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						    <? foreach($data as $k => $AllUser){ ?>
                            <? // var_dump($AllUser); ?>
							<tr>
								<td><a class="btn btn-info" href="<? echo MODULE . 'user' . ACTION . 'seeoneuser' . '&id=' . $AllUser['user_id']; ?>"><? echo $AllUser['user_pseudo']; ?></a></td>
								<td><? echo $AllUser['user_firstname']; ?></td>
								<td><? echo $AllUser['user_lastname']; ?></td>
								<td><? echo $AllUser['user_birthday']; ?></td>
								<td><? echo $AllUser['user_mail']; ?></td>
								<td class="center"><? echo $AllUser['user_date']; ?></td>
								<td class="center">
								<? if($AllUser['user_type'] == "student"){ ?>
									<span class="label label-info"><? echo $AllUser['user_type']; ?></span>
								<? } elseif($AllUser['user_type'] == "organisme"){ ?>
								    <span class="label label-default"><? echo $AllUser['user_type']; ?></span>
								<? } ?>
								</td>
								<td class="center">
									<a class="btn btn-info" href="">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="<? echo MODULE . 'user' . ACTION . 'deluser' . '&id=' . $AllUser['user_id']; ?>">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<? } ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
</div>





<?php include(ROOT . "view/layout/footer.inc.php"); ?>