<?php
require_once("auth.php");
include("database_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Project Lock & Unlock Panel</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap.min.css" rel="stylesheet" />
	<link rel="icon" href="icon.png" type="image/ico" sizes="16x16">
	<script src="jquery.min.js"></script>
	<script src="bootstrap.bundle.min.js"></script>
	<script src="save_data.js"></script>
</head>
<body>

<div class="container mt-3">

	<center>
		<h3 style="background-color:#f7f7f7;"><img src="icon.png" width="50" /> Project Lock & Unlock Panel</h3>
	</center> 
	
	<p>
		Welcome! <b><?php print (isset($_SESSION['APANEL_SESS_OPERATOR_NAME'])) ? $_SESSION['APANEL_SESS_OPERATOR_NAME']: ''; ?></b> | <a href="logout.php" style="color:red;">Logout</a>
	</p>
	
	<!-- All Project Lock / Unlock -->
	<div class="shadow-lg p-3 mb-2 bg-body rounded">
		<b class="text-danger"># All Project Lock / Unlock</b>
		<table class="table table-sm table-bordered border-primary">
			<thead>
				<tr>
					<th class="text-center">Project Mode</th>
					<th class="text-center">Session Time</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>	
				<tr>
					<td class="text-center align-middle">
						<select id="all_project_mode">
							<option value="">Select Project Mode</option>
							<option value="Lock">Lock</option>
							<option value="Unlock">Unlock</option>
						</select>
					</td>
					<td class="text-center align-middle">
						<input type="datetime-local" id="all_project_session_time" value="" min="<?php print date("Y-m-d\TH:i"); ?>" max="<?php print date("Y-m-d\T23:00"); ?>" />
					</td>
					<td class="text-center align-middle"><input type="button" id="all_project_action" onclick="fn_save_data('All','all_project_mode','all_project_session_time','all_project_action','otp')" value="Save" /></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<!-- Project Wise Lock / Unlock -->
	<div class="shadow-lg p-3 mb-2 bg-body rounded">
		<b class="text-danger"># Project Wise Lock / Unlock</b>
		<table class="table table-sm table-bordered border-primary">
			<thead>
				<tr>
					<th class="text-center">Project Name</th>
					<th class="text-center">Project Mode</th>
					<th class="text-center">Session Time</th>
					<th class="text-center">Last Update</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>

<?php
$sql = $connect->prepare("SELECT * FROM `access_panel` WHERE project_name='Sun' ");
$sql->execute();
$fetch = $sql->fetch(PDO::FETCH_ASSOC);
?>	
				<tr>
					<td class="text-left align-middle"><b>SUN</b></td>
					<td class="text-center align-middle">
						<select id="project1_mode">
							<option value="">Select Project Mode</option>
							<option <?php print ($fetch['project_mode']=='Lock') ? "selected" : ""; ?> value="Lock">Lock</option>
							<option <?php print ($fetch['project_mode']=='Unlock') ? "selected" : ""; ?> value="Unlock">Unlock</option>
						</select>
					</td>
					<td class="text-center align-middle">
						<input type="datetime-local" id="project1_session_time" value="<?php print (!empty($fetch['project_session_time'])) ? date("Y-m-d\TH:i",strtotime($fetch['project_session_time'])) : ''; ?>" min="<?php print date("Y-m-d\TH:i"); ?>" max="<?php print date("Y-m-d\T23:00"); ?>" />
					</td>
					<td class="text-center align-middle"><?php print $fetch['last_update']; ?></td>
					<td class="text-center align-middle"><input type="button" id="project1_action" onclick="fn_save_data('Sun','project1_mode','project1_session_time','project1_action','otp')" value="Save" /></td>
				</tr>
			
<?php
$sql = $connect->prepare("SELECT * FROM `access_panel` WHERE project_name='Fresh' ");
$sql->execute();
$fetch = $sql->fetch(PDO::FETCH_ASSOC);
?>			
			
				<tr>
					<td class="text-left align-middle"><b>FRESH</b></td>
					<td class="text-center align-middle">
						<select id="project2_mode">
							<option value="">Select Project Mode</option>
							<option <?php print ($fetch['project_mode']=='Lock') ? "selected" : ""; ?> value="Lock">Lock</option>
							<option <?php print ($fetch['project_mode']=='Unlock') ? "selected" : ""; ?> value="Unlock">Unlock</option>
						</select>
					</td>
					<td class="text-center align-middle">
						<input type="datetime-local" id="project2_session_time" value="<?php print (!empty($fetch['project_session_time'])) ? date("Y-m-d\TH:i",strtotime($fetch['project_session_time'])) : ''; ?>" min="<?php print date("Y-m-d\TH:i"); ?>" max="<?php print date("Y-m-d\T23:00"); ?>" />
					</td>
					<td class="text-center align-middle"><?php print $fetch['last_update']; ?></td>
					<td class="text-center align-middle"><input type="button" id="project2_action" onclick="fn_save_data('Fresh','project2_mode','project2_session_time','project2_action','otp')" value="Save" /></td>
				</tr>
				
<?php
$sql = $connect->prepare("SELECT * FROM `access_panel` WHERE project_name='Danish' ");
$sql->execute();
$fetch = $sql->fetch(PDO::FETCH_ASSOC);
?>
				
				<tr>
					<td class="text-left align-middle"><b>DANISH</b></td>
					<td class="text-center align-middle">
						<select id="project3_mode">
							<option value="">Select Project Mode</option>
							<option <?php print ($fetch['project_mode']=='Lock') ? "selected" : ""; ?> value="Lock">Lock</option>
							<option <?php print ($fetch['project_mode']=='Unlock') ? "selected" : ""; ?> value="Unlock">Unlock</option>
						</select>
					</td>
					<td class="text-center align-middle">
						<input type="datetime-local" id="project3_session_time" value="<?php print (!empty($fetch['project_session_time'])) ? date("Y-m-d\TH:i",strtotime($fetch['project_session_time'])) : ''; ?>" min="<?php print date("Y-m-d\TH:i"); ?>" max="<?php print date("Y-m-d\T23:00"); ?>" />
					</td>
					<td class="text-center align-middle"><?php print $fetch['last_update']; ?></td>
					<td class="text-center align-middle"><input type="button" id="project3_action" onclick="fn_save_data('Danish','project3_mode','project3_session_time','project3_action','otp')" value="Save" /></td>
				</tr>
				
<?php
$sql = $connect->prepare("SELECT * FROM `access_panel` WHERE project_name='SSInt' ");
$sql->execute();
$fetch = $sql->fetch(PDO::FETCH_ASSOC);
?>			
				
				<tr>
					<td class="text-left align-middle"><b>S.S. INT.</b></td>
					<td class="text-center align-middle">
						<select id="project4_mode">
							<option value="">Select Project Mode</option>
							<option <?php print ($fetch['project_mode']=='Lock') ? "selected" : ""; ?> value="Lock">Lock</option>
							<option <?php print ($fetch['project_mode']=='Unlock') ? "selected" : ""; ?> value="Unlock">Unlock</option>
						</select>
					</td>
					<td class="text-center align-middle">
						<input type="datetime-local" id="project4_session_time" value="<?php print (!empty($fetch['project_session_time'])) ? date("Y-m-d\TH:i",strtotime($fetch['project_session_time'])) : ''; ?>" min="<?php print date("Y-m-d\TH:i"); ?>" max="<?php print date("Y-m-d\T23:00"); ?>" />
					</td>
					<td class="text-center align-middle"><?php print $fetch['last_update']; ?></td>
					<td class="text-center align-middle"><input type="button" id="project4_action" onclick="fn_save_data('SSInt','project4_mode','project4_session_time','project4_action','otp')" value="Save" /></td>
				</tr>
				
<?php
$sql = $connect->prepare("SELECT * FROM `access_panel` WHERE project_name='RBB' ");
$sql->execute();
$fetch = $sql->fetch(PDO::FETCH_ASSOC);
?>			
				
				<tr>
					<td class="text-left align-middle"><b>RBB</b></td>
					<td class="text-center align-middle">
						<select id="project5_mode">
							<option value="">Select Project Mode</option>
							<option <?php print ($fetch['project_mode']=='Lock') ? "selected" : ""; ?> value="Lock">Lock</option>
							<option <?php print ($fetch['project_mode']=='Unlock') ? "selected" : ""; ?> value="Unlock">Unlock</option>
						</select>
					</td>
					<td class="text-center align-middle">
						<input type="datetime-local" id="project5_session_time" value="<?php print (!empty($fetch['project_session_time'])) ? date("Y-m-d\TH:i",strtotime($fetch['project_session_time'])) : ''; ?>" min="<?php print date("Y-m-d\TH:i"); ?>" max="<?php print date("Y-m-d\T23:00"); ?>" />
					</td>
					<td class="text-center align-middle"><?php print $fetch['last_update']; ?></td>
					<td class="text-center align-middle"><input type="button" id="project5_action" onclick="fn_save_data('RBB','project5_mode','project5_session_time','project5_action','otp')" value="Save" /></td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- / END -->
	
	<center>
		<p style="background-color:#f7f7f7;">
			<i class="text-danger">Developed by</i> <a class="underlineHover" href="mailto:rifatjaker@gmail.com">@rifatjaker@gmail.com</a>
		</p>
	</center>
</div>
<!-- /container -->


<!-- Modal of setup verification -->
<div class="modal fade" id="setup_vcode_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<p class="modal-title" id="exampleModalLongTitle">
					<b><font color="red">Enter OTP - Contact: <?php print $admin_phone['phone']; ?></font></b>
				</p>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col">
						<input required type="text" class="form-control form-control-sm" id="setup_final_vcode" onkeypress="return isNumberKey(event)" onfocus="this.select()" maxlength="4" autocomplete="off" />
						<input type="hidden" id="project_name" />
						<input type="hidden" id="project_mode" />
						<input type="hidden" id="project_session_time" />
						<input type="hidden" id="project_action" />
					</div>
				</div>	
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-sm btn-primary" id="setup_vc_Submit" onclick="fn_save_data(project_name.value,'project_mode','project_session_time','project_action','final_entry')" value="Final Data" />
			</div>
		</div>
	</div>
</div>

</body>
</html>