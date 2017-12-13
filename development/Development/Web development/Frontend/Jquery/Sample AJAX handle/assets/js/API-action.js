$(document).ready(function () {


	// Get user account API action 

    	$(document).on("click", ".get_user_btn", function(){		
		myAPI.get_all_user('student');
	});


	// Add user account API action 

    	$(document).on("click", ".add_user_btn", function(){		
		var name= $('.name').val();
		var role= $('.role').val();
		myAPI.add_user_account(name,role);
	});



	// Edit user account API action 

    	$(document).on("click", ".edit_user_btn", function(){		
		var pass = $('.pass').val();
		var email = $('.email').val();
		myAPI.update_user_account(pass,email)
	});



	// Delete user account API action 

    	$(document).on("click", ".delete_user_btn", function(){		
	    	swal({
	  	 	  title: " Are you sure you want to remove this subject?"	,  
			  type: 'warning',
		      	  showCancelButton: true,
		 	  confirmButtonText: 'Confirm',
			  showLoaderOnConfirm: true,
			  allowOutsideClick: false
		  }).then(function (){
			  myAPI.delete_user_account();
   		 });
	});

});

