function fn_save_data(project_name,project_mode,project_session_time,project_action,process_status){
	
	// html data
	var project_mode = $("#"+project_mode).val();
	var project_session_time = $("#"+project_session_time).val();
	var setup_final_vcode = $("#setup_final_vcode").val();
	
	//form validation
	if(project_name==''){
		alert("Error! Project name is missing.");
		return false;
	}
	
	if(project_mode==''){
		alert("Error! Project mode is missing.");
		return false;
	}
	
	if(project_session_time==''){
		alert("Error! Session time is missing.");
		return false;
	}
	
	// check verification
	if(process_status=='final_entry'){
		
		// checking vcode
		if(setup_final_vcode==''){
			alert("Enter - Verification Code");
			$("#setup_final_vcode").focus();
			return false;
		}
	}
	
	// before response
	$("#"+project_action).prop("disabled",true);
	$("#setup_vc_Submit").prop("disabled",true);
	
	//use ajax to run the check
	$.post("action_data.php", {process_status: process_status, project_name: project_name, project_mode: project_mode, project_session_time: project_session_time, setup_final_vcode: setup_final_vcode}, function(result){
		
		if(result == 1){
		  
			$("#setup_vcode_modal").modal('show');
			
			// set submitted value
			$("#project_name").val(project_name);
			$("#project_mode").val(project_mode);
			$("#project_session_time").val(project_session_time);
			$("#project_action").val(project_action);
			// end
			
			$("#"+project_action).prop("disabled",false);
			$("#setup_vc_Submit").prop("disabled",false);

		}else if(result=='invalid_otp'){
			
			alert("Sorry !! Invalid Verification Code. Contact With Admin.");
			$("#setup_final_vcode").focus();
			$("#"+project_action).prop("disabled",false);
			$("#setup_vc_Submit").prop("disabled",false);
			
		}else if(result==2){
			
			alert("Success!!");
			window.location="home.php";
			
		}else{
			
			alert(result);
			$("#"+project_action).prop("disabled",false);
			$("#setup_vc_Submit").prop("disabled",false);
		}	
	});
}