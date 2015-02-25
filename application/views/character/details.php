<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Character Details/Edit</h1>
			</div>
		</div>
		<ul class="nav nav-tabs" id="myTabs">
			<li class="active"><a href="#details" data-toggle="tab">Basic Info</a></li>
			<li><a href="#items" data-toggle="tab">Items</a></li>
			<li><a href="#log" data-toggle="tab">History</a></li>
			<li><a href="#friends" data-toggle="tab">Friends</a></li>
			<li><a href="#pets" data-toggle="tab">Pet/Homun Info</a></li>
			<li><a href="#skills" data-toggle="tab">Skills</a></li>
		</ul>
		<?php if ($charinfo->online == 1) { ?>
			<div class="alert alert-danger">
				Character is online and cannot be edited!
			</div>
		<?php } ?>
		<?php if ($charinfo->delete_date > 0) { ?>
			<div class="alert alert-warning">
				User has initiated the deletion of this character! Initiation time: <?php echo date('Y-m-d H:i:s', $charinfo->delete_date); ?>
			</div>
		<?php } ?>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="details">
				<h4>Basic Character Info</h4><br />
				<?php echo validation_errors(); ?>
				<?php echo form_open('/character/verifyedit', array('class' => 'form-inline'), array('charid' => $charinfo->char_id)); ?>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user-md fa-fw"></i> General Character Info
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped" id="dataTables-example">
										<tr>
											<td><label>Character Name</label></td><td><input type="text" class="form-control" name="char_name" value="<?php echo $charinfo->name; ?>" <?php if ($check_perm['editcharname'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>Character ID</label></td><td><?php echo $charinfo->char_id; ?></td>
										</tr>
										<tr>
											<td><label>Create Date</label></td><td><?php echo $charinfo->create_time; ?></td>
											<td><label>Last Played</label></td><td><?php echo $charinfo->lastlogin_time; ?></td>
										</tr>
										<tr>
											<td><label>Slot #</label></td><td><input type="number" min="0" max="9" class="form-control" name="char_num" value="<?php echo $charinfo->char_num; ?>"  <?php if ($check_perm['editcharslot'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>Account ID</label></td><td><a href="/account/details/<?php echo $charinfo->account_id; ?>"><?php echo $charinfo->account_id; ?></a></td>
										</tr>
										<tr>
											<td><label>Guild</label></td><td><a href="/guild/details/<?php echo $charinfo->guild_id; ?>"><?php echo $charinfo->guild_name; ?></a></td>
											<td><label>Party</label></td><td><a href="/party/details/<?php echo $charinfo->party_id; ?>"><?php echo $charinfo->party_name; ?></a></td>
										</tr>
										<tr>
											<td><label>Zeny</label></td><td><input type="number" class="form-control" name="zeny" min="0" max="2100000000" value="<?php echo $charinfo->zeny; ?>"  <?php if ($check_perm['editcharzeny'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>Class</label></td><td><?php echo $class_list[$charinfo->class]; ?> </td>
										</tr>
										<tr>
											<td><label>HP / MaxHP</label></td><td><?php echo $charinfo->hp; ?>&nbsp;/&nbsp;<?php echo $charinfo->max_hp; ?></td>
											<td><label>SP / MaxSP</label></td><td><?php echo $charinfo->sp; ?>&nbsp;/&nbsp;<?php echo $charinfo->max_sp; ?></td>
										</tr>
										<tr>
											<td><label>Last Position</label></td><td><?php echo $charinfo->last_map; ?>&nbsp;<?php echo $charinfo->last_x; ?>,&nbsp;<?php echo $charinfo->last_y; ?></td>
											<td><label>Saved Position</label></td><td><?php echo $charinfo->save_map; ?>&nbsp;<?php echo $charinfo->save_x; ?>,&nbsp;<?php echo $charinfo->save_y; ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-9">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user-md fa-fw"></i> Character Level Info
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped" id="dataTables-example">
										<tr>
											<td><label>Base Level</label></td><td><input type="number" class="form-control" name="base_level" min="1" max="<?php echo $this->config->item('max_base_level'); ?>" value="<?php echo $charinfo->base_level; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>Job Level</label></td><td><input type="number" class="form-control" name="job_level" min="1" max="<?php echo $this->config->item('max_job_level'); ?>" value="<?php echo $charinfo->job_level; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
										<tr>
											<td><label>Base Exp</label></td><td><input type="number" class="form-control" name="base_exp" min="1" value="<?php echo $charinfo->base_exp; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>Job Exp</label></td><td><input type="number" class="form-control" name="job_exp" min="1" value="<?php echo $charinfo->job_exp; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
										<tr>
											<td><label>Status Points</label></td><td><input type="number" class="form-control" name="status_point" min="1" max="9999" value="<?php echo $charinfo->status_point; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>Skill Points</label></td><td><input type="number" class="form-control" name="skill_point" min="1" max="9999" value="<?php echo $charinfo->skill_point; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user-md fa-fw"></i> Options
							</div>
							<div class="panel-body">
								<a href="/character/kick/<?php echo $charinfo->char_id; ?>"><button type="button" class="btn btn-danger">Kick Offline</button></a>&nbsp;
								<a href="/character/resetpos/<?php echo $charinfo->char_id; ?>"><button type="button" class="btn btn-success">Reset Position</button></a>
							</div>
						</div>
					</div>	
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user-md fa-fw"></i> Character Stats
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped" id="dataTables-example">
										<tr>
											<td><label>STR</label></td><td><input type="number" class="form-control" name="str" min="1" max="999" value="<?php echo $charinfo->str; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>INT</label></td><td><input type="number" class="form-control" name="int" min="1" max="999" value="<?php echo $charinfo->INT; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
										<tr>
											<td><label>AGI</label></td><td><input type="number" class="form-control" name="agi" min="1" max="999" value="<?php echo $charinfo->agi; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>DEX</label></td><td><input type="number" class="form-control" name="dex" min="1" max="999" value="<?php echo $charinfo->dex; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
											<td><label>VIT</label></td><td><input type="number" class="form-control" name="vit" min="1" max="999" value="<?php echo $charinfo->vit; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>LUK</label></td><td><input type="number" class="form-control" name="luk" min="1" max="999" value="<?php echo $charinfo->luk; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
										<tr>
											<td><label>Manner</label></td><td><input type="number" class="form-control" name="manner" value="<?php echo $charinfo->manner; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>Karma</label></td><td><input type="number" class="form-control" name="karma" value="<?php echo $charinfo->karma; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user-md fa-fw"></i> Character Appearance
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped" id="dataTables-example">
										<tr>
											<td><label>Hair Style ID</label></td><td><input type="number" class="form-control" name="hair" min="0" max="999" value="<?php echo $charinfo->hair; ?>" <?php if ($check_perm['editcharlook'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
										<tr>
											<td><label>Hair Color ID</label></td><td><input type="number" class="form-control" name="hair_color" min="0" max="999" value="<?php echo $charinfo->hair_color; ?>" <?php if ($check_perm['editcharlook'] == 0) { echo "readonly"; } ?> /></td>	
										</tr>
										<tr>
											<td><label>Clothes Color ID</label></td><td><input type="number" class="form-control" size="40px" name="clothes_color" min="0" max="999" value="<?php echo $charinfo->clothes_color; ?>" <?php if ($check_perm['editcharlook'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br /><center><button type="submit" class="btn btn-primary">Submit changes</button>&nbsp;</center><br />
				<?php echo form_close(); ?>
			</div>
			<div class="tab-pane fade in" id="items">
				<h4>Character Item Information</h4><br />
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Equipped</strong>
							</div>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<th>Equipped to</th>
										<th>ItemID</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Unique ID</th>
										<th>Details</th>
										<th>Options</th>
									</thead>
									<tbody>
										<?php foreach ($char_items as $charItem) { ?>
											<tr>
												<?php if ($charItem['equip'] > 0) { ?>
													<td><?php echo $equipLocation[$charItem['equip']]; ?></td>
													<td><?php echo $charItem['nameid']; ?></td>
													<td><?php echo $charItem['name_japanese']; ?></td>
													<td><?php echo $charItem['amount']; ?></td>
													<td><?php echo $charItem['unique_id']; ?></td>
													<td><center><a data-toggle="collapse" data-parent="#accordion" href="#equipdetails<?php echo $charItem['id']; ?>"><button type="button" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-plus"></i></button></a></center></td>
													<td><button type="button" class="btn btn-success btn-sm">Edit</button>&nbsp;<button type="button" class="btn btn-warning btn-sm">Unequip</button>&nbsp;<button type="button" class="btn btn-danger btn-sm">Delete</button></td>
												<?php } ?>
											</tr>
											<tr>
												<td colspan="7" class="hiddenRow">
													<div id="equipdetails<?php echo $charItem['id']; ?>" class="panel-collapse collapse">
														<div class="panel-body">
															<strong>Refine level:</strong>&nbsp;<?php echo $charItem['refine']; ?>&nbsp;&nbsp;&nbsp;<strong>Attribute:</strong>&nbsp;<?php echo $charItem['attribute']; ?>&nbsp;&nbsp;&nbsp;<strong>Bound?:</strong>&nbsp;<?php if ($charItem['bound'] == 1) { echo "Yes"; } else { echo "No"; }?><br />
															<br />
															<strong>Card 1:</strong>&nbsp;<?php echo $charItem['card0']; ?></br>
															<strong>Card 2:</strong>&nbsp;<?php echo $charItem['card1']; ?></br>
															<strong>Card 3:</strong>&nbsp;<?php echo $charItem['card2']; ?></br>
															<strong>Card 4:</strong>&nbsp;<?php echo $charItem['card3']; ?></br>
														</div>
													</div>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>													
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>In inventory</strong>
							</div>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<th>ItemID</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Identified?</th>
										<th>Unique ID</th>
										<th>Details</th>
										<th>Options</th>
									</thead>
									<tbody>
										<?php foreach ($char_items as $charItem) { ?>
											<tr>
												<?php if ($charItem['equip'] < 1) { ?>
													<td><?php echo $charItem['nameid']; ?></td>
													<td><?php echo $charItem['name_japanese']; ?></td>
													<td><?php echo $charItem['amount']; ?></td>
													<td><?php echo $charItem['identify']; ?></td>
													<td><?php echo $charItem['unique_id']; ?></td>
													<td><center><a data-toggle="collapse" data-parent="#accordion" href="#packdetails<?php echo $charItem['id']; ?>"><button type="button" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-plus"></i></button></a></center></td>
													<td><button type="button" class="btn btn-success btn-sm">Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm">Delete</button></td>
												<?php } ?>
											</tr>
											<tr>
												<td colspan="7" class="hiddenRow">
													<div id="packdetails<?php echo $charItem['id']; ?>" class="panel-collapse collapse">
														<div class="panel-body">
															<strong>Refine level:</strong>&nbsp;<?php echo $charItem['refine']; ?>&nbsp;&nbsp;&nbsp;<strong>Attribute:</strong>&nbsp;<?php echo $charItem['attribute']; ?>&nbsp;&nbsp;&nbsp;<strong>Bound?:</strong>&nbsp;<?php if ($charItem['bound'] == 1) { echo "Yes"; } else { echo "No"; }?><br />
															<br />
															<strong>Card 1:</strong>&nbsp;<?php echo $charItem['card0']; ?></br>
															<strong>Card 2:</strong>&nbsp;<?php echo $charItem['card1']; ?></br>
															<strong>Card 3:</strong>&nbsp;<?php echo $charItem['card2']; ?></br>
															<strong>Card 4:</strong>&nbsp;<?php echo $charItem['card3']; ?></br>
														</div>
													</div>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>In cart</strong>
							</div>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<th>ItemID</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Identified?</th>
										<th>Unique ID</th>
										<th>Details</th>
										<th>Options</th>
									</thead>
									<tbody>
										<?php foreach ($char_cartItems as $cartItem) { ?>
											<tr>
												<?php if ($cartItem['equip'] < 1) { ?>
													<td><?php echo $cartItem['nameid']; ?></td>
													<td><?php echo $cartItem['name_japanese']; ?></td>
													<td><?php echo $cartItem['amount']; ?></td>
													<td><?php echo $cartItem['identify']; ?></td>
													<td><?php echo $cartItem['unique_id']; ?></td>
													<td><center><a data-toggle="collapse" data-parent="#accordion" href="#cartdetails<?php echo $charItem['id']; ?>"><button type="button" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-plus"></i></button></a></center></td>
													<td><button type="button" class="btn btn-success btn-sm">Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm">Delete</button></td>
												<?php } ?>
											</tr>
											<tr>
												<td colspan="7" class="hiddenRow">
													<div id="cartdetails<?php echo $charItem['id']; ?>" class="panel-collapse collapse">
														<div class="panel-body">
															<strong>Refine level:</strong>&nbsp;<?php echo $charItem['refine']; ?>&nbsp;&nbsp;&nbsp;<strong>Attribute:</strong>&nbsp;<?php echo $charItem['attribute']; ?>&nbsp;&nbsp;&nbsp;<strong>Bound?:</strong>&nbsp;<?php if ($charItem['bound'] == 1) { echo "Yes"; } else { echo "No"; }?><br />
															<br />
															<strong>Card 1:</strong>&nbsp;<?php echo $charItem['card0']; ?></br>
															<strong>Card 2:</strong>&nbsp;<?php echo $charItem['card1']; ?></br>
															<strong>Card 3:</strong>&nbsp;<?php echo $charItem['card2']; ?></br>
															<strong>Card 4:</strong>&nbsp;<?php echo $charItem['card3']; ?></br>
														</div>
													</div>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>											
			</div>
			<div class="tab-pane fade in" id="log">
				<h4>Character Log</h4><br />
				<div class="row">
					<h4>Character Log</h4>
					<div class="col-lg-6">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<th>Datetime</th>
									<th>Type</th>
									<th>Acct ID</th>
									<th>Char Name</th>
									<th>STR / AGI / VIT / INT / DEX / LUK</th>
									<th>Hair / Hair color</th>
								</thead>
								<tbody>
									<?php foreach ($charlog_data as $charLog) { ?>
										<tr>
											<td><?php echo $charLog['time']; ?></td>
											<td><?php echo $charLog['char_msg']; ?></td>
											<td><a href="/account/details/<?php echo $charLog['account_id']; ?>#characters"><?php echo $charLog['account_id']; ?></a></td>
											<td><?php echo $charLog['name']; ?></td>
											<td><?php echo "".$charLog['str']."&nbsp;/&nbsp;".$charLog['agi']."&nbsp;/&nbsp;".$charLog['vit']."&nbsp;/&nbsp;".$charLog['INT']."&nbsp;/&nbsp;".$charLog['dex']."&nbsp;/&nbsp;".$charLog['luk'].""; ?></td>
											<td><?php echo "".$charLog['hair']."&nbsp;/&nbsp;".$charLog['hair_color'].""; ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<h4>Character Edit History</h4>
					<div class="col-lg-6">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th style="width: 100px;">Datetime</th>
										<th style="width: 100px;">User</th>
										<th style="width: 70px;">Field Changed</th>
										<th style="width: 75px;">Old Value</th>
										<th style="width: 75px">New Value</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($char_edit_hist as $cEH_item): ?>
										<tr class="odd gradex">
											<td><?php echo $cEH_item['datetime']; ?></td>
											<td><?php echo $cEH_item['username']; ?></td>
											<td><?php echo $cEH_item['chg_attr']; ?></td>
											<td><?php echo $cEH_item['old_value']; ?></td>
											<td><?php echo $cEH_item['new_value']; ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade in" id="friends">
				<h4>Character Friends</h4><br />
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<th>Friend Char ID</th>
									<th>Character Name</th>
									<th>Account ID</th>
								</thead>
								<tbody>
									<?php foreach ($friends_list as $friend) { ?>
										<tr>
											<td><a href="/character/details/<?php echo $friend['char_id']; ?>"><?php echo $friend['char_id']; ?></a></td>
											<td><?php echo $friend['name']; ?></td>
											<td><a href="/account/details/<?php echo $friend['friend_account']; ?>"><?php echo $friend['friend_account']; ?></a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
										
		</div>
	</div>
</div>