function fn_login_data(process_status){
	
	// get html value
	var email = $("#email").val();
	var password1 = $("#password").val();
	var login_final_vcode = $("#login_final_vcode").val();
	
	// check verification
	if(process_status=='final_entry'){
		
		// checking vcode
		if(login_final_vcode==''){
			alert("Enter - Verification Code");
			$("#login_final_vcode").focus();
			return false;
		}
	}
	// end
	
	// Checking for blank fields.
	if(process_status=='primary_entry' && (email =='' || password1 =='')){
		
		(email == '') ? $('input[type="text"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"}) : '';
		(password1 == '') ? $('input[type="password"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"}) : '';
		alert("Please fill all fields...!!!!!!");
		return false;
		
	}else{
		
		// before response
		$("#login").val('Sending OTP...');
		$("#login").prop("disabled", true);
		
		// send to server
		$.post("login.php",{ process_status: process_status, email1: email, password1: password1, login_final_vcode: login_final_vcode }, function(data) {
			
			if(data=='Invalid Email') {
				
				$('input[type="text"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
				$('input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
				alert(data);
				$("#login").val('Log In');
				$("#login").prop("disabled", false);
				return false;
				
			}else if(data=='Email or Password is wrong'){
				
				$('input[type="text"],input[type="password"]').css({"border":"2px solid red","box-shadow":"0 0 3px red"});
				alert(data);
				$("#login").val('Log In');
				$("#login").prop("disabled", false);
				return false;
				
			}else if(data=='Primary Logged in'){
				
				$("#login_vcode_modal").modal('show');
				$("#login").val('Log In');
				$("#login").prop("disabled", false);
				
			}else if(data=='invalid_otp'){
				
				alert("Sorry !! Invalid Verification Code. Contact With Admin.");
				$("#login_final_vcode").focus();
				$("#login").val('Log In');
				$("#login").prop("disabled", false);
				return false;
				
			}else if(data=='Successfully Logged in'){
				
				$("form")[0].reset();
				$('input[type="text"],input[type="password"]').css({"border":"2px solid #00F5FF","box-shadow":"0 0 5px #00F5FF"});
				$("#login").val('Redirecting Please Wait...');
				$("#login").prop("disabled", false);
				window.location="home.php";
				
			}else{
				
				alert(data);
				$("#login").val('Log In');
				$("#login").prop("disabled", false);
			}
			
		});
	}
}
//end