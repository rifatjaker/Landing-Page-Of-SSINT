<!DOCTYPE html>
<html lang="en">
<head>
<title>PROJECT ACCESS CONTROL :: USER LOGIN</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap.min.css" rel="stylesheet" />
<link href="all.min.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="icon.png" type="image/ico" sizes="16x16" />
<style>
body {
	background: #dfd9d9 !important;
}
.card {
	border: 1px solid #28a745;
	padding: 18px;
	max-width: 40rem;
}
</style>
</head>
<body>
<div class="container mt-3">
	<div class="card mx-auto border-info mb-3">
		<div class="card-header">
			<h5><img src="icon.png" width="50" /> PROJECT ACCESS CONTROL :: USER LOGIN</h5>
		</div>	
		<div class="card-body">
			<form action="#" class="was-validated">
				<div class="mb-3 mt-3">
					<label for="uname" class="form-label">Username:</label>
					<input type="text" class="form-control" id="email" placeholder="Enter username" name="uname" required>
					<div class="valid-feedback">Valid.</div>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<div class="mb-3">
					<label for="pwd" class="form-label">Password:</label>
					<input type="password" class="form-control" id="password" placeholder="Enter password" name="pswd" required>
					<div class="valid-feedback">Valid.</div>
					<div class="invalid-feedback">Please fill out this field.</div>
				</div>
				<button type="button" class="btn btn-primary" onclick="fn_login_data('primary_entry')">Login</button>
			</form>
		</div>
	</div>
	<!-- /card-->
</div>
<!-- /container-->

<!-- Modal of login verification -->
<div class="modal fade" id="login_vcode_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content text-center">
			<div class="modal-header">
				<p class="modal-title" id="exampleModalLongTitle"><b>Please Enter an OTP From Your Mobile</b></p>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-sm-12">
						<input required type="text" class="form-control form-control-sm" id="login_final_vcode" onkeypress="return isNumberKey(event)" onfocus="this.select()" maxlength="4" autocomplete="off" autofocus />
					</div>
				</div>	
				<div class="row mt-3">	
					<div class="form-group col-sm-12">
						<input type="button" class="btn btn-sm btn-danger" id="login_vc_Submit" onclick="fn_login_data('final_entry')" value="Confirm Login" />
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
<!-- END Modal -->

<script src="jquery.min.js"></script>
<script src="bootstrap.bundle.min.js"></script>
<script src="login.js"></script>

<script>
// allow number only in textbox
function isNumberKey(key) {
	
	//getting key code of pressed key
	var keycode = (key.which) ? key.which : key.keyCode;
	
	//comparing pressed keycodes
	if (keycode > 31 && (keycode < 48 || keycode > 57) && keycode != 46) {
		alert(" You can enter only characters 0 to 9 ");
		return false;
	}else{ 
		return true;
	}
	  
}
</script>

</body>
</html>