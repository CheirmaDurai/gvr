<?php
require_once('./config/config.php');
check_user_login();
try {
	require_once(BASE_PATH . 'resources/classes/event.php');
	$evt_obj = new event();
	$events = $evt_obj->event_list(10);
	
	require_once(BASE_PATH . 'resources/classes/registration.php');
	$reg_obj = new registration();
	$registrations = $reg_obj->registration_list(10);
	
	$title = 'Dashboard';
	$menu = 'dashboard';

require_once(BASE_PATH . 'page/templates/header.php');?>
<aside class="right-side">
    <section class="content-header">
        <h1>Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo BASE_URL;?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">   
					    <h3 class="box-title">Events</h3>
                    </div>
                    
                    <div class="box-body">
						<div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1" data-toggle="tab"><b>Upcoming Events</b></a></li>
                                        <li><a href="#tab_2" data-toggle="tab"><b>Past Events</b></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
						                    <div class="row">
													<table width="100%" class="table table-bordered table-striped data_table">
														<thead>
															<tr>
																<th>S.No</th>
																<th>Event Name</th>
																<th>Event Type</th>
																<th>Event Date</th>
																<th>Duration</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach($events['upcoming_events'] as $key => $event) {?>
																<tr>
																	<td><?php echo $key + 1;?></td>
																	<td><?php echo $event->event_name;?></td>
																	<td><?php echo $event->event_type;?></td>
																	<td><?php echo $event->event_date;?></td>
																	<td><?php echo $event->duration;?></td>
																	<td class="td_action">
																		<a href="<?php echo BASE_URL . 'page/event/view.php?id=' . $event->event_id;?>">View</a>
																	</td>
																</tr>
															<?php }?>
														</tbody>
													</table>
									        </div>
								        </div>
								        <div class="tab-pane" id="tab_2">
								            <div class="row">
													<table width="100%" class="table table-bordered table-striped data_table">
														<thead>
															<tr>
																<th>S.No</th>
																<th>Event Name</th>
																<th>Event Type</th>
																<th>Event Date</th>
																<th>Duration</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach($events['past_events'] as $key => $event) {?>
																<tr>
																	<td><?php echo $key + 1;?></td>
																	<td><?php echo $event->event_name;?></td>
																	<td><?php echo $event->event_type;?></td>
																	<td><?php echo $event->event_date;?></td>
																	<td><?php echo $event->duration;?></td>
																	<td class="td_action">
																		<a href="<?php echo BASE_URL . 'page/event/view.php?id=' . $event->event_id;?>">View</a>
																	</td>
																</tr>
															<?php }?>
														</tbody>
													</table>
											</div>
						                </div>
						            </div>
                                </div>
                    </div>
                    
                    <div class="box-footer">
                    </div>
				</div>
            </div>
			
			<div class="col-md-12">
			    <div class="box box-danger">
                    <div class="box-header">
					    <h3 class="box-title">Registrations</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="clr"></div>
                        <table width="100%" class="table table-bordered table-striped" id="data-table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Mobile Number</th>
                                    <th>User Type</th>
                                    <th>Business Name</th>
                                    <th>Email Address</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($registrations as $key => $registration) {?>
                                    <tr>
                                        <td><?php echo ++ $key;?></td>
                                        <td><?php echo $registration->mobile_no;?></td>
                                        <td><?php echo $registration->user_type_str;?></td>
                                        <td><?php echo (!empty($registration->business_name)) ? $registration->business_name : 'N/A';?></td>
                                        <td><?php echo $registration->email_id;?></td>
                                        <td><?php echo $registration->current_rating;?></td>
                                        <td>
										    <?php if ($registration->status == 1) {
                                                echo 'Active';
											}
											else if ($registration->status == 0) {
												echo 'In Active';
											}?>
                                        </td>
                                        <td class="td_action">
                                            <a href="<?php echo BASE_URL . 'page/registration/edit.php?id=' . $registration->user_id;?>"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                            <a onclick="return confirm('Are you sure, You want to delete this registration?')" href="<?php echo BASE_URL . 'page/registration/delete.php?id=' . $registration->user_id;?>"><i class="fa fa-trash-o"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="box-footer clearfix no-border"></div>
                </div>
            </div>
        </div>
    </section>
</aside>

<?php
require_once(BASE_PATH . 'page/templates/footer.php');
}
catch (Exception $e) {
	show_error($e);
}
?>