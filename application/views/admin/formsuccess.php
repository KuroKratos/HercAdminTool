!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Admin Account Processed</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="col-lg-6">
					<?php switch( $referpage ) {
						case "useredit":
							echo "Admin user edit processed successfully. Return to the <a href='/admin/users'>user management page</a>";
							break;
						case "groupadd":
							echo "Group Addition processed successfully. Return to the <a href='/admin/groups'>group management page</a>";
							break;
						case "useradd":
							echo "Admin user added successfully. Return to the <a href='/admin/users'>user management page</a>";
							break;
						default:
							echo "the <a href='/'>dashboard</a>";
							break;
					} ?>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->
			</div>
		<!-- /#wrapper -->